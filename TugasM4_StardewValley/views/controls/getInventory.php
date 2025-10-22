<?php 
    require_once '../../connect.php';

    try {
        $id = $_POST['id'];
        
        $stmt = $conn->prepare("
            SELECT c.crop_name, i.amount, c.color, c.growth_time, c.buy_price, c.sell_price, i.crop_id
            FROM inventories i
            JOIN crops c ON c.id = i.crop_id
            WHERE i.save_id = :id AND i.type = 'seed'
        ");
        $stmt->execute([
            ":id" => $id
        ]);
        $seeds = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("
            SELECT c.crop_name, i.amount, c.color, c.growth_time, c.buy_price, c.sell_price, i.crop_id
            FROM inventories i
            JOIN crops c ON c.id = i.crop_id
            WHERE i.save_id = :id AND i.type = 'crop'
        ");
        $stmt->execute([
            ":id" => $id
        ]);
        $crops = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'message' => "Plots loaded succcessfully",
            'seeds' => $seeds,
            'crops' => $crops
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage(),
            'seeds' => [],
            'crops' => [],
        ]);
    }
?>