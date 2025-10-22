<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php 
        include_once "function.php";
    ?>
    <nav class="myNav navbar fixed-top">
        <div class="container">
            <a class="navbar-brand">
                <img src="asset_tugas/logo.png" alt="Logo" width="100" height="55" class="d-inline-block">
            </a>
            <div>
                <div class="btn-group " role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <a class="btn btn-outline-light" for="btnradio1">English</a>
    
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <a href="indo.php" class="btn btn-outline-light" for="btnradio2">Bahasa Indonesia</a>
                </div>
                <button class="btn btn-danger fw-bold ms-2">Sign In</button>
            </div>
        </div>
    </nav>
    <div class="myContain container-fluid text-light d-flex justify-content-center align-content-center align-items-center">
        <div class="row d-flex justify-content-center align-content-center align-items-center text-center">
            <div class="col-7">
                <h1 class="fw-bold" style="font-size: 60px;">Unlimited movies, TV shows, and more</h1>
                <h6 class="mt-4">Starts at IDR 54,000. Cancel anytime</h6>
                <p class="mt-5">Ready to watch? Enter your email to create or restart your membership.</p>
                <div class="container-fluid">
                    <form class="d-flex justify-content-center">
                        <input class="myForm form-control me-2 bg-transparent border-secondary " type="text" placeholder="Email Address" aria-label="Search"/>
                        <a href="listfilm.php" class="btn btn-danger py-2 px-3" type="submit" style="white-space: nowrap;">Get Started ></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= 
        footer();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>