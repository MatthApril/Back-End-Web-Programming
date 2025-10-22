<?php 
    session_start();

    if (isset($_POST['btnRegist'])) {
        $name = $_POST['name'];
        $username = $_POST['usn'];
        $password = $_POST['pass'];
        $cpassword = $_POST['cpass'];

        if ($password !== $cpassword) {
            $_SESSION['error'] = "Password tidak sama";
            header('location: register.php');
            exit;
        }

        if (!isset($_COOKIE['users'])) {
            $users = [];
        } else {
            $users = unserialize($_COOKIE['users']);
            foreach ($users as $user) {
                if ($user['username'] === $username) {
                    $_SESSION['error'] = "Username sudah terdaftar";
                    header('location: register.php');
                    exit;
                }
            }
        }
        $users[] = [
            "name" => $name,
            "username" => $username,
            "password" => $password,
            "blogs" => []
        ];
        setcookie("users", serialize($users), time() + 3600);

        echo "<script>alert('Berhasil register');</script>";
        header('location: login.php');
        exit;
    } else if (isset($_POST['btnLogin'])) {
        $username = $_POST['usn'];
        $password = $_POST['pass'];

        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['admin'] = true;
            // DATA DUMMY
            // $bloggs = isset($_COOKIE['bloggs']) ? unserialize($_COOKIE['bloggs']) : [];
            // $bloggs[] = [
            //     "title" => "Sample Blog Post",
            //     "content" => "This is a sample blog post content.",
            //     "author" => "Admin",
            //     "up" => [],
            //     "comments" => []
            // ];

            // setcookie("bloggs", serialize($bloggs), time() + 3600);
            header('location: admin.php?view=all_bloggs');
            exit;
        }

        $found = false;

        if (isset($_COOKIE['users'])) {
            $user_data = unserialize($_COOKIE['users']);
            if (is_array($user_data)) {
                foreach ($user_data as $user) {
                    if ($user['username'] === $username) {
                        $found = true;
                        if ($user['password'] === $password) {
                            if (isset($_POST['remember'])) {
                                setcookie("auth", serialize($user), time() + 3600);
                            } else {
                                $_SESSION['user'] = $user;
                            }

                            header('location: home.php?blog=mine');
                            exit;
                        } else {
                            $_SESSION['error'] = "Password salah";
                            break;
                        }
                    }
                }
            }
        }

        if ($found == false) {
            $_SESSION['error'] = "User tidak ditemukan";
        }
    
    header('location: login.php');
    exit;
}


?>