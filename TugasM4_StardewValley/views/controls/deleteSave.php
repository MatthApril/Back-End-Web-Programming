<?php 
    require_once '../../connect.php';

    $id = $_POST["id"];

    try {
        $stmt = $conn->prepare("DELETE FROM plots WHERE save_id = :id");
        $stmt->execute([
            ':id' => $id
        ]);

        $stmt = $conn->prepare("DELETE FROM shipping_bin WHERE save_id = :id");
        $stmt->execute([
            ':id' => $id
        ]);

        $stmt = $conn->prepare("DELETE FROM inventories WHERE save_id = :id");
        $stmt->execute([
            ':id' => $id
        ]);

        $stmt = $conn->prepare("DELETE FROM saves WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);        
        echo json_encode([
            "status" => "success",
            "message" => "Succesfully Deleted!"
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Error: " . $e->getMessage()
        ]);
    }
?>