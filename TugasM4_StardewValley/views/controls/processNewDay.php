<?php
    require_once '../../connect.php';

    try {
        $saveId = $_POST['save_id'];

        if (isset($saveId)) {
            $stmt = $conn->prepare("SELECT * FROM saves WHERE id = :id");
            $stmt->execute(['id' => $saveId]);
            $save = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $conn->prepare("
                SELECT SUM(sb.amount * c.sell_price) as total_earned
                FROM shipping_bin sb
                JOIN crops c ON c.id = sb.crop_id
                WHERE sb.save_id = :save_id
            ");
            $stmt->execute(['save_id' => $saveId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalEarned = $result['total_earned'] ?? 0;

            $newDay = $save['day'] + 1;
            $newGold = $save['gold'] + $totalEarned;

            $stmt = $conn->prepare("
                UPDATE saves 
                SET day = :day, gold = :gold
                WHERE id = :id
            ");
            $stmt->execute([
                'day' => $newDay,
                'gold' => $newGold,
                'id' => $saveId
            ]);

            $_SESSION['save']['day'] = $newDay;
            $_SESSION['save']['gold'] = $newGold;

            $stmt = $conn->prepare("DELETE FROM shipping_bin WHERE save_id = :save_id");
            $stmt->execute(['save_id' => $saveId]);

            // Only increment days_planted if the crop was watered
            $stmt = $conn->prepare("
                UPDATE plots 
                SET days_planted = CASE 
                    WHEN crop_id IS NOT NULL AND is_watered = 1 THEN days_planted + 1 
                    ELSE days_planted 
                END,
                is_watered = 0
                WHERE save_id = :save_id
            ");
            $stmt->execute(['save_id' => $saveId]);

            // Don't auto-harvest - let the player harvest manually
            // Remove this entire section to prevent auto-harvesting
            
            echo json_encode([
                'status' => 'success',
                'message' => 'New day started successfully!',
                'earned' => $totalEarned,
                'newDay' => $newDay,
                'newGold' => $newGold
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to process new day: ' . $e->getMessage()
        ]);
    }
?>