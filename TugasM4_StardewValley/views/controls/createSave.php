<?php 
    require_once '../../connect.php';

    $name = $_POST["name"];
    $farmName = $_POST["farmName"];

    try {
        $stmt = $conn->prepare("
            insert into saves (name, farm_name, day, gold)
            values (:name, :farmName, :day, :gold)
        ");
        $stmt->execute([
            ':name' => $name,
            ':farmName' => $farmName,
            ':day' => 1,
            ':gold' => 500
        ]);

        $saveId = $conn->lastInsertId();

        for ($i=1; $i <= 9; $i++) { 
            $stmt = $conn->prepare("
                insert into plots (save_id, days_planted, is_watered, plot_position)
                values (:saveid, :days, :iswatered, :plotpos)
            ");
            $stmt->execute([
                ':saveid' => $saveId,
                ':days' => 0,
                ':iswatered' => false,
                ':plotpos' => $i
            ]);
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'A new save was added! 9 plots successfully generated'
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
?>