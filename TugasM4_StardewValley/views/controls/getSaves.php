<?php 
    require_once '../../connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['bentukData'] === 'json') {
    
        try {
            $stmt = $conn->prepare("SELECT * FROM saves");
            $stmt->execute();

            $saves = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                "status" => "success",
                "message" => "Saves fetched successfully",
                "data" => $saves
            ]);
        } catch (PDOException $th) {
            echo json_encode([
                "status" => "error",
                "message" => "Error: " . $th->getMessage(),
                "data" => []
            ]);
        }
    }
?>