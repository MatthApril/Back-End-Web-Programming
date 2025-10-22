<?php
    require_once '../../connect.php';

    try {
        $id = $_POST['id'];
        
        $stmt = $conn->prepare("
            SELECT p.*, c.crop_name, c.color, c.growth_time
            FROM plots p
            LEFT JOIN crops c ON c.id = p.crop_id
            WHERE p.save_id = :id
            ORDER BY p.plot_position
        ");
        $stmt->execute([":id" => $id]);
        $plots = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'message' => "Plots loaded successfully",
            'data' => $plots
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage(),
            'data' => []
        ]);
    }
?>