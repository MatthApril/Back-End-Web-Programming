<?php 

    require_once '../../connect.php';

    try {
        $id = $_POST['id'];
        
        $stmt = $conn->prepare("
            SELECT c.crop_name, sb.amount, c.color, c.sell_price
            FROM shipping_bin sb
            JOIN crops c ON c.id = sb.crop_id
            WHERE sb.save_id = :id
        ");
        $stmt->execute([
            ":id" => $id
        ]);
        $crops = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'message' => "Shipping bin loaded succcessfully",
            'crops' => $crops
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage(),
            'crops' => [],
        ]);
    }

?>