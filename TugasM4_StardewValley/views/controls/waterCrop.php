<?php
    require_once '../../connect.php';

    try {
        $saveId = $_POST['save_id'];
        $plotId = $_POST['plot_id'];

        if (isset($saveId) && isset($plotId)) {
            $stmt = $conn->prepare("
                UPDATE plots 
                SET is_watered = 1
                WHERE plot_id = :plot_id AND save_id = :save_id
            ");
            $stmt->execute([
                'plot_id' => $plotId,
                'save_id' => $saveId
            ]);

            echo json_encode([
                'status' => 'success',
                'message' => 'Crop watered successfully!'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to water crop: ' . $e->getMessage()
        ]);
    }
?>