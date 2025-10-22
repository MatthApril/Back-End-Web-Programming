<?php
    require_once '../../connect.php';

    try {
        $saveId = $_POST['save_id'];
        $plotId = $_POST['plot_id'];
        $cropId = $_POST['crop_id'];

        if (isset($saveId) && isset($plotId) && isset($cropId)) {
            // Check if plot is empty
            $stmt = $conn->prepare("
                SELECT * FROM plots 
                WHERE plot_id = :plot_id AND save_id = :save_id
            ");
            $stmt->execute([
                'plot_id' => $plotId,
                'save_id' => $saveId
            ]);
            $plot = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($plot['crop_id'] !== null) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Plot is already occupied!'
                ]);
                exit;
            }

            // Check if user has seeds
            $stmt = $conn->prepare("
                SELECT * FROM inventories 
                WHERE save_id = :save_id AND crop_id = :crop_id AND type = 'seed'
            ");
            $stmt->execute([
                'save_id' => $saveId,
                'crop_id' => $cropId
            ]);
            $inventory = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$inventory || $inventory['amount'] <= 0) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No seeds available!'
                ]);
                exit;
            }

            // Plant seed on plot
            $stmt = $conn->prepare("
                UPDATE plots 
                SET crop_id = :crop_id, days_planted = 0, is_watered = 0
                WHERE plot_id = :plot_id AND save_id = :save_id
            ");
            $stmt->execute([
                'crop_id' => $cropId,
                'plot_id' => $plotId,
                'save_id' => $saveId
            ]);

            // Remove seed from inventory
            $newAmount = $inventory['amount'] - 1;
            
            if ($newAmount <= 0) {
                $stmt = $conn->prepare("
                    DELETE FROM inventories 
                    WHERE save_id = :save_id AND crop_id = :crop_id AND type = 'seed'
                ");
                $stmt->execute([
                    'save_id' => $saveId,
                    'crop_id' => $cropId
                ]);
            } else {
                $stmt = $conn->prepare("
                    UPDATE inventories 
                    SET amount = :amount
                    WHERE save_id = :save_id AND crop_id = :crop_id AND type = 'seed'
                ");
                $stmt->execute([
                    'amount' => $newAmount,
                    'save_id' => $saveId,
                    'crop_id' => $cropId
                ]);
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Seed planted successfully!'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to plant seed: ' . $e->getMessage()
        ]);
    }
?>