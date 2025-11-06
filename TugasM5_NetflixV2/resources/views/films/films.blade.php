
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="film-body pt-5">
    <nav class="navbar bg-black fixed-top">
        <div class="container w-75">
            <a class="navbar-brand" href="#">
            <img src="{{ url('asset_tugas/logo.png') }}" alt="Netflix" width="90" height="50">
            </a>
            <div>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <a href="{{ url('/films') }}" class="btn btn-outline-light" for="btnradio1">All</a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <a href="{{ url('/films/serial') }}" class="btn btn-outline-light" for="btnradio2">Series</a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <a href="{{ url('/films/movies') }}" class="btn btn-outline-light" for="btnradio3">Movies</a>
                </div>
                <a href="{{ url('/reviews') }}" class="btn btn-danger fw-bold ms-2">Reviews</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid text-white mt-5">
        <div><i class="bi bi-funnel-fill"></i> Filter by Genre:
            <a href="{{ url('/films') }}" class="btn btn-sm {{ $selected_genre == 'All' ? 'btn-danger' : 'btn-outline-light' }}">All Genres</a>
            <a href="{{ url('/films/aksi') }}" class="btn btn-sm {{ $selected_genre == 'Aksi' ? 'btn-danger' : 'btn-outline-light' }}">Aksi</a>
            <a href="{{ url('/films/animasi') }}" class="btn btn-sm {{ $selected_genre == 'Animasi' ? 'btn-danger' : 'btn-outline-light' }}">Animasi</a>
            <a href="{{ url('/films/biografi') }}" class="btn btn-sm {{ $selected_genre == 'Biografi' ? 'btn-danger' : 'btn-outline-light' }}">Biografi</a>
            <a href="{{ url('/films/drama') }}" class="btn btn-sm {{ $selected_genre == 'Drama' ? 'btn-danger' : 'btn-outline-light' }}">Drama</a>
            <a href="{{ url('/films/fantasi') }}" class="btn btn-sm {{ $selected_genre == 'Fantasi' ? 'btn-danger' : 'btn-outline-light' }}">Fantasi</a>
            <a href="{{ url('/films/horror') }}" class="btn btn-sm {{ $selected_genre == 'Horror' ? 'btn-danger' : 'btn-outline-light' }}">Horror</a>
            <a href="{{ url('/films/keluarga') }}" class="btn btn-sm {{ $selected_genre == 'Keluarga' ? 'btn-danger' : 'btn-outline-light' }}">Keluarga</a>
            <a href="{{ url('/films/komedi') }}" class="btn btn-sm {{ $selected_genre == 'Komedi' ? 'btn-danger' : 'btn-outline-light' }}">Komedi</a>
            <a href="{{ url('/films/misteri') }}" class="btn btn-sm {{ $selected_genre == 'Misteri' ? 'btn-danger' : 'btn-outline-light' }}">Misteri</a>
            <a href="{{ url('/films/musik') }}" class="btn btn-sm {{ $selected_genre == 'Musik' ? 'btn-danger' : 'btn-outline-light' }}">Musik</a>
            <a href="{{ url('/films/petualangan') }}" class="btn btn-sm {{ $selected_genre == 'Petualangan' ? 'btn-danger' : 'btn-outline-light' }}">Petualangan</a>
            <a href="{{ url('/films/romantis') }}" class="btn btn-sm {{ $selected_genre == 'Romantis' ? 'btn-danger' : 'btn-outline-light' }}">Romantis</a>
            <a href="{{ url('/films/sejarah') }}" class="btn btn-sm {{ $selected_genre == 'Sejarah' ? 'btn-danger' : 'btn-outline-light' }}">Sejarah</a>
            <a href="{{ url('/films/thriller') }}" class="btn btn-sm {{ $selected_genre == 'Thriller' ? 'btn-danger' : 'btn-outline-light' }}">Thriller</a>
        </div>

        <span class="badge bg-dark mt-3 py-2 px-3"><i class="bi bi-film"></i> Showing {{ count($films) }} results</span>

        <div class="row mt-3">
            @foreach ($films as $k => $v)
                <div class="col-3 mb-3">
                    <div class="card h-100 position-relative rounded-3 bg-black text-white" style="width: 24rem;">
                        <div class="img-bg rounded-3 pb-1">
                            <img src="<?= $v["image"]?>" class="card-img-top rounded-3" alt="...">
                        </div>
                        <h4 class="position-absolute top-0 start-0 m-1"><span class="badge <?php if ($v["type"] == "Movie") echo "text-bg-info"; else echo "text-bg-warning"?>"><?=$v["type"] ?></span></h4>
                        <h4 class="position-absolute top-0 end-0 m-1"><span class="badge <?php if ($v["age_rating"] == "13+") echo 'text-bg-warning'; else if ($v["age_rating"] == "17+") echo 'text-bg-danger'; else echo 'text-bg-success'?>"><?= $v["age_rating"]?></span></h4>
                        <div class="card-body">
                            <h5 class="card-title text-danger fw-bold"><?= $v["title"]?></h5>
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Released: <span class="text-light fw-bold"><?= $v["release_year"]?></span></small>
                                <span>
                                    <?php
                                        for ($i=1; $i <= 5; $i++) {
                                            if ($i <= $v["rating"]){
                                                echo "<i class='bi bi-star-fill' style='color: yellow;'></i>";
                                                continue;
                                            }

                                            else if ($i - 1 < $v["rating"]){
                                                echo "<i class='bi bi-star-half' style='color: yellow;'></i>";
                                                continue;
                                            }

                                            echo "<i class='bi bi-star' style='color: yellow;'></i>";
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small class="fw-bold">Duration:
                                    <?php if ($v["type"] == "Movie"):?>
                                        <span class="badge" style="background-color: #212529; border: 1px solid white;"><?= $v["duration"]?> min</span></small>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #212529; border: 1px solid white;"><?= $v["seasons"]?> seasons</span></small>
                                    <?php endif;?>
                                <div>
                                    <small class="fw-bold">Languages:
                                        <?php foreach ($v["languages"] as $key): ?>
                                            <span class="badge bg-info text-black"><?= $key?></span>
                                        <?php endforeach; ?>
                                    </small>
                                </div>
                            </div>
                            <small class="fw-bold"><span class="me-2">Genre: </span>
                                <?php foreach ($v["genre"] as $key): ?>
                                    <span class="badge bg-secondary"><?=$key?></span>
                                <?php endforeach; ?>
                            </small><br>

                            <small>
                                <span class="fw-bold">
                                    Starring: <br>
                                </span>
                                <?php
                                $last = $v["cast"][count($v["cast"]) - 1];
                                foreach ($v["cast"] as $k => $v2) {
                                    echo $v2["name"] . " as " . $v2["role"];
                                    echo $last !== $v2 ? ', ' : ' ';
                                }

                                ?>
                            </small>
                        </div>
                    </div>

                </div>

            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
