<?php 
    require_once '../../connect.php';

    try {
        $id = $_POST['id'];
        
        $stmt = $conn->prepare("
            SELECT *
            FROM saves
            WHERE id = :id
        ");
        $stmt->execute([
            ":id" => $id
        ]);
        $save = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'message' => "Save loaded succcessfully",
            'save' => $save
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage(),
            'save' => null,
        ]);
    }
?>