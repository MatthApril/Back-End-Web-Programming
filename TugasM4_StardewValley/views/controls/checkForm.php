<?php 
    require_once '../../connect.php';

    if (isset($_POST["load-save"])){
        $id = $_POST['id'];

        $stmt = $conn->prepare("SELECT * FROM saves WHERE id = :id");
        $stmt->execute([
            ":id" => $id
        ]);

        $_SESSION['save'] = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Location: ../mainPage.php");
        exit;
    }
    header("Location: savePage.php");
    exit;

?>