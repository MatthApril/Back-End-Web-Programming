<?php 
    require_once '../../connect.php';

    try {
        $crop_name = $_POST['crop_name'];
        $quantity = $_POST['quantity'];
        $save_id = $_POST['save_id'];

        $stmt = $conn->prepare("SELECT * FROM saves WHERE id = :id");
        $stmt->execute([':id' => $save_id]);
        $save = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("
            SELECT id, buy_price
            FROM crops
            WHERE crop_name = :crop_name
        ");
        $stmt->execute([
            ':crop_name' => $crop_name
        ]);

        $crop = $stmt->fetch(PDO::FETCH_ASSOC);

        $totalPrice = $crop['buy_price'] * $quantity;

        if ($save['gold'] < $totalPrice){
            echo json_encode([
                'status' => 'error',
                'message' => "Not enough gold to complete purchase",
            ]);
            exit;
        } else {
            $newGoldAmount = $save['gold'] - $totalPrice;
            $_SESSION['save']['gold'] = $newGoldAmount;

            $stmt = $conn->prepare("
                UPDATE saves
                SET gold = :gold
                WHERE id = :id
            ");
            $stmt->execute([
                ':gold' => $newGoldAmount,
                ':id' => $save['id']
            ]);
            $stmt = $conn->prepare("
                INSERT INTO inventories (save_id, crop_id, type, amount)
                VALUES (:save_id, :crop_id, 'seed', :amount)
                ON DUPLICATE KEY UPDATE amount = amount + :amount
            ");
            $stmt->execute([
                ':save_id' => $save['id'],
                ':crop_id' => $crop['id'],
                ':amount' => $quantity
            ]);
        }

        echo json_encode([
            'status' => 'success',
            'message' => "Purchase successful",
            'newGold' => $newGoldAmount
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
?>