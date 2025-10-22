<?php 
    session_start();
    include_once 'functions.php';

    if (isset($_POST['btnChangePassword'])) {
        $user_id = $_GET['user_id'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            $_SESSION['error'] = "Password tidak sama";
            header("Location: admin.php?user_id_tochange=$user_id");
            exit;
        }

        if (isset($_COOKIE['users'])) {
            $users = unserialize($_COOKIE['users']);
            if (isset($users[$user_id])) {
                $users[$user_id]['password'] = $new_password;
                setcookie("users", serialize($users), time() + 3600);

                header("Location: admin.php?view=all_users");
                exit;
            }
        }
    } else {
        header("Location: admin.php?view=all_users");
        exit;
    }
?>