<?php 
    function logoutAdmin() {
        session_start();
        unset($_SESSION['admin']);
        // session_unset();
        // session_destroy();
        // setcookie("auth", "", time() - 3600);
        header('location: login.php');
        exit;
    }
    function alert($message){
        echo "<script>alert('$message');</script>";
    }
?>