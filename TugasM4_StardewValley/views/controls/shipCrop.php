<?php
    require_once '../../connect.php';

    try {
        $saveId = $_POST['save_id'];
        $cropId = $_POST['crop_id'];
        $amount = $_POST['amount'];

        if (isset($saveId) && isset($cropId) && isset($amount)) {
            // Get current inventory amount
            $stmt = $conn->prepare("
                SELECT amount FROM inventories  
                WHERE save_id = :save_id AND crop_id = :crop_id AND type = 'crop'
            ");
            $stmt->execute([
                'save_id' => $saveId,
                'crop_id' => $cropId
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No crops available to ship.'
                ]);
                exit;
            }

            $quantity = ($amount === 'one') ? 1 : $result['amount'];

            // Add to shipping bin
            $stmt = $conn->prepare("
                INSERT INTO shipping_bin (save_id, crop_id, amount) 
                VALUES (:save_id, :crop_id, :quantity)
                ON DUPLICATE KEY UPDATE amount = amount + :quantity
            ");
            $stmt->execute([
                'save_id' => $saveId,
                'crop_id' => $cropId,
                'quantity' => $quantity
            ]);

            // Update inventory
            $newAmount = $result['amount'] - $quantity;
            
            if ($newAmount <= 0) {
                // Delete if no crops left
                $stmt = $conn->prepare("
                    DELETE FROM inventories 
                    WHERE save_id = :save_id AND crop_id = :crop_id AND type = 'crop'
                ");
                $stmt->execute([
                    'save_id' => $saveId,
                    'crop_id' => $cropId
                ]);
            } else {
                // Update amount
                $stmt = $conn->prepare("
                    UPDATE inventories 
                    SET amount = :amount
                    WHERE save_id = :save_id AND crop_id = :crop_id AND type = 'crop'
                ");
                $stmt->execute([
                    'amount' => $newAmount,
                    'save_id' => $saveId,
                    'crop_id' => $cropId
                ]);
            }
                
            echo json_encode([
                'status' => 'success',
                'message' => 'Crop shipped successfully.'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to ship crop: ' . $e->getMessage()
        ]);
    }
?>