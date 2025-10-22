<?php
    require_once '../../connect.php';

    try {
        $saveId = $_POST['save_id'];
        $plotId = $_POST['plot_id'];

        if (isset($saveId) && isset($plotId)) {
            // Get plot data
            $stmt = $conn->prepare("
                SELECT p.*, c.growth_time 
                FROM plots p
                JOIN crops c ON c.id = p.crop_id
                WHERE p.plot_id = :plot_id AND p.save_id = :save_id
            ");
            $stmt->execute([
                'plot_id' => $plotId,
                'save_id' => $saveId
            ]);
            $plot = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$plot || $plot['crop_id'] === null) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No crop to harvest!'
                ]);
                exit;
            }

            if ($plot['days_planted'] < $plot['growth_time']) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Crop is not ready to harvest yet!'
                ]);
                exit;
            }

            // Add crop to inventory
            $stmt = $conn->prepare("
                INSERT INTO inventories (save_id, crop_id, type, amount)
                VALUES (:save_id, :crop_id, 'crop', 1)
                ON DUPLICATE KEY UPDATE amount = amount + 1
            ");
            $stmt->execute([
                'save_id' => $saveId,
                'crop_id' => $plot['crop_id']
            ]);

            // Reset plot
            $stmt = $conn->prepare("
                UPDATE plots 
                SET crop_id = NULL, days_planted = 0, is_watered = 0
                WHERE plot_id = :plot_id AND save_id = :save_id
            ");
            $stmt->execute([
                'plot_id' => $plotId,
                'save_id' => $saveId
            ]);

            echo json_encode([
                'status' => 'success',
                'message' => 'Crop harvested successfully!'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to harvest crop: ' . $e->getMessage()
        ]);
    }
?>