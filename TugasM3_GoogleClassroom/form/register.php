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
    <div class="myCon container-fluid d-flex flex-column align-items-center justify-content-center gap-3">
        <h1>Google Classroom</h1>
    
        <h3>Register</h3>
    
        <form action="cekForm.php" method="post">
            <table cellpadding="5">
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><input type="text" name="name" id="name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="usn" id="usn"></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>:</td>
                    <td class="d-flex gap-3">
                        <input type="radio" id="teacher" name="role" value="Teacher">
                        <label for="teacher">Teacher</label>
                        <input type="radio" id="student" name="role" value="Student">
                        <label for="student">Student</label>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="pass" id="pass"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>:</td>
                    <td><input type="password" name="cpass" id="cpass"></td>
                </tr>
            </table>
            <div class="mt-3 text-center">
                <input class="btn btn-primary" type="submit" value="Register" name="btnRegister"> <br> <br>
                <span>Sudah punya akun? <a href="login.php">Login</a></span> <br>
            </div>
        </form>
        
        <?php errorMessage(); ?>
    

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-5sE5c5F5s5E5c5F5s5E5c5F5s5E5c5F5s5E5c5F5s5E5c5F5s5E5c5F5s5E5c5F5" crossorigin="anonymous"></script>

</body>
</html>