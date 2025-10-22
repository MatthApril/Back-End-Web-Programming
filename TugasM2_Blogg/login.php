<?php
    session_start();

    if (isset($_SESSION['user']) || isset($_COOKIE['auth'])) {
        header('location: home.php?blog=mine');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh;">

    <div class="d-flex flex-column align-items-center justify-content-center shadow" style="padding: 50px; border-radius: 10px; width: 500px;">
        <h1 class="mb-4">Login</h1>
        <form action="cekForm.php" method="post">
                <table cellpadding="5" class="mb-3">
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" name="usn" id="usn" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input type="password" name="pass" id="pass" required></td>
                    </tr>
                </table>
                <input type="checkbox" name="remember" id="remember"> Remember Me <br>
                
                <div class="text-center mt-4">
                    <input class="btn btn-primary" type="submit" value="Login" name="btnLogin">
                </div>
            </form>
            <div class="mt-3">
                Belum punya akun? <a href="register.php">Register di sini</a>
        </div>
        <?php 
            if (isset($_SESSION['error'])) {
                echo "<p style='color: red;'>".$_SESSION['error']."</p>";
                unset($_SESSION['error']);
            }
        ?>
    </div>
    


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>