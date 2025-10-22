<?php 
    require_once '../connect.php'; 
    include_once '../functions.php'; 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="myCon d-flex flex-column align-items-center justify-content-center gap-3">
        <h1>Google Classroom</h1>
    
        <h3>Login</h3>
    
        <form action="cekForm.php" method="post" class="text-center">
            <table cellpadding="5">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="usn" id="usn" ></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="pass" id="pass"></td>
                </tr>
            </table>

            <div class="mt-3 text-center">
                <input class="btn btn-primary" type="submit" value="Login" name="btnLogin"> <br> <br>
                <span>Belum punya akun? <a href="register.php">Register</a></span>

            </div>
            
        </form>
        <?php errorMessage(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-5sE5c5F5s5E5c5F5s5E5c5F5s5E5c5F5s5E5c5F5s5E5c5F5s5E5c5F5s5E5c5F5" crossorigin="anonymous"></script>
</body>
</html>