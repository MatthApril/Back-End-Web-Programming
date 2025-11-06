<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="home-body d-flex flex-column justify-content-center align-items-center">
    <nav class="navbar bg-black fixed-top">
        <div class="container w-75">
            <a class="navbar-brand" href="#">
            <img src="{{ url('asset_tugas/logo.png') }}" alt="Netflix" width="90" height="50">
            </a>
            <div>
                <div class="btn-group " role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <a href="{{ url('/english') }}" class="btn btn-outline-light" for="btnradio1">English</a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" >
                    <a href="{{ url('/indonesia') }}" class="btn btn-outline-light" for="btnradio2">Bahasa Indonesia</a>
                </div>
                <a href="{{ url('/films') }}" class="btn btn-danger fw-bold ms-2">Masuk</a>
            </div>
        </div>
    </nav>
    <div class="home-container container-fluid d-flex flex-column justify-content-center align-items-center text-center text-white w-50 gap-3">
        <div>
            <h1 class="fw-bold" style="font-size: 60px">Unlimited movies, TV shows, and more</h1>
            <p class="fw-semibold">Starts at IDR 54,000. Cancel anytime</p>
        </div>
        <div class="d-flex flex-column gap-3">
            <small>Ready to watch? Enter your email to create or restart your membership.</small>
            <form class="d-flex justify-content-center">
                <input class="myForm form-control me-2 bg-transparent border-secondary " type="text" placeholder="Email Address" aria-label="Search"/>
                <a href="{{ url('/films') }}" class="btn btn-danger py-2 px-3" type="submit" style="white-space: nowrap;">Get Started ></a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
