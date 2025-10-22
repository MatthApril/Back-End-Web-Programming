<?php
    
    require_once '../../connect.php';

    try {
        $saveId = $_POST['save_id'];
        $cropName = $_POST['crop_name'];

        if (isset($saveId) && isset($cropName)) {
            $stmt = $conn->prepare("
                SELECT id FROM crops WHERE LOWER(crop_name) = LOWER(:crop_name)
            ");
            $stmt->execute(['crop_name' => $cropName]);
            $crop = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($crop) {
                $stmt = $conn->prepare("
                    INSERT INTO inventories (save_id, crop_id, type, amount)
                    VALUES (:save_id, :crop_id, 'crop', (SELECT amount FROM shipping_bin WHERE save_id = :save_id AND crop_id = :crop_id))
                    ON DUPLICATE KEY UPDATE amount = amount + (SELECT amount FROM shipping_bin WHERE save_id = :save_id AND crop_id = :crop_id)
                ");
                $stmt->execute([
                    'save_id' => $saveId,
                    'crop_id' => $crop['id']
                ]);
                $stmt = $conn->prepare("
                    DELETE FROM shipping_bin 
                    WHERE save_id = :save_id AND crop_id = :crop_id
                ");
                $stmt->execute([
                    'save_id' => $saveId,
                    'crop_id' => $crop['id']
                ]);
                
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Crop removed from shipping bin successfully.'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Crop not found.'
                ]);
            }
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to remove crop: ' . $e->getMessage()
        ]);
    }
?>