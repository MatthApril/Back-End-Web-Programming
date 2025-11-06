<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="d-flex flex-column justify-content-center align-items-center">
    <nav class="navbar bg-dark fixed-top">
        <div class="container w-75">
            <a class="navbar-brand" href="#">
            <img src="<?php echo e(url('asset_tugas/logo.png')); ?>" alt="Netflix" width="90" height="50">
            </a>
            <div>
                <div class="btn-group " role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                    <a  href="english.php" class="btn btn-outline-light" for="btnradio1">English</a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" checked>
                    <a class="btn btn-outline-light" for="btnradio2">Bahasa Indonesia</a>
                </div>
                <button class="btn btn-danger fw-bold ms-2">Masuk</button>
            </div>
        </div>
    </nav>
    <div class="home-container container-fluid d-flex flex-column justify-content-center align-items-center text-center text-white">
        <h1 class="text-center">Welcome to the Home Page</h1>
        <p class="lead">This is a simple home page served by Laravel.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH D:\Files Kuliah\INF_Semester_3\Backend Web Programming\TugasM5\resources\views/home.blade.php ENDPATH**/ ?>