<?php 
    require_once '../connect.php'; 
    include_once '../functions.php'; 

    if (isset($_REQUEST["btnRegister"])){
        $name = $_POST['name'];
        $username = $_POST['usn'];
        $role = $_POST['role'] ?? null;
        $password = $_POST['pass'];
        $cpassword = $_POST['cpass'];

        if (empty($name) || empty($username) || empty($role) || empty($password) || empty($cpassword)){
            $_SESSION["error"] = "Semua field harus diisi";
            header("Location: register.php");
            exit;
        }

        else if ($password != $cpassword){
            $_SESSION["error"] = "Password dan Confirm Password harus sama";
            header("Location: register.php");
            exit;
        }

        else {
            $query = $conn->prepare('SELECT * from users where username = :usn');
            $query->execute(
                [
                    ':usn' => $username
                ]);
            $user = $query->fetch();
            if ($user){
                $_SESSION["error"] = "Username sudah terdaftar";
                header("Location: register.php");
                exit;
            } else {
                $query = $conn->prepare('INSERT INTO users (name, username, role, password) VALUES (:name, :usn, :role, :pass)');
                $query->execute(
                    [
                        ':name' => $name,
                        ':usn' => $username,
                        ':role' => $role,
                        ':pass' => $password
                    ]);
                header("Location: login.php");
                exit;
            }
        }

    } else if (isset($_REQUEST["btnLogin"])){
        $username = $_POST['usn'];
        $password = $_POST['pass'];

        if (empty($username) || empty($password)){
            $_SESSION["error"] = "Username dan Password harus diisi";
            header("Location: login.php");
            exit;
        }

        $query = $conn->prepare('SELECT * from users where username = :usn');
        $query->execute(
            [
                ':usn' => $username
            ]);
        $user = $query->fetch();
        if ($user){
            if ($user['password'] == $password){
                $_SESSION['user'] = $user;
                
                if ($user['role'] == "Teacher"){
                    header("Location: ../main/teacher.php?page=home");
                } 
                else if ($user['role'] == "Student"){
                    header("Location: ../main/student.php?page=home");
                }
                exit;
            }
            $_SESSION["error"] = "Password salah";
            header("Location: login.php");
            exit;
        } else {
            $_SESSION["error"] = "Username tidak terdaftar";
            header("Location: login.php");
            exit;
        }
        
    }
?>