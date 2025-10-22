<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="bodyFilm">
    <?php 
        require_once "data_tugas.php";
        include_once "function.php";
    ?>
    <nav class="myNav navbar">
        <div class="container">
            <a class="navbar-brand">
                <img src="asset_tugas/logo.png" alt="Logo" width="100" height="55" class="d-inline-block">
            </a>
            <div>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                    <a href="listfilm.php" class="btn btn-outline-light" for="btnradio1">All</a>
    
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <a href="series.php" class="btn btn-outline-light" for="btnradio2">Series</a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" checked>
                    <a href="#" class="btn btn-outline-light" for="btnradio3">Movies</a>
                </div>
            </div>
        </div>
    </nav> 
    <div class="container-fluid my-3">
        <div class="row gap-3">
            <?php foreach ($data as $k => $v):?>
                <?php if ($v["type"] == "Movie"):?> 
                <div class="col">
                    <div class="card h-100 position-relative rounded-3" style="width: 24rem;">
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
                                            if ($i > $v["rating"]){
                                                echo "<i class='bi bi-star' style='color: yellow;'></i>";
                                                continue;
                                            }

                                            else if ($i + 0.5 == $v["rating"]){
                                                echo "<i class='bi bi-star-half' style='color: yellow;'></i>";
                                                continue;
                                            }

                                            echo "<i class='bi bi-star-fill' style='color: yellow;'></i>";
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
                            <small class="fw-bold">Genre: 
                                <?php foreach ($v["genre"] as $key): ?>
                                    <span class="badge bg-secondary"><?=$key?></span>
                                <?php endforeach; ?>
                            </small><br>

                            <small>
                                <span class="fw-bold">
                                    Starring: <br>
                                </span>
                                <?php foreach ($v["cast"] as $k => $v2):?>
                                    <?= $v2["name"]?> as <?= $v2["role"]?>
                                <?php endforeach;?>
                            </small>
                        </div>
                    </div>  
                </div>
                <?php endif;?> 
            <?php endforeach; ?>
        </div>
    </div>
    <?= 
        footer()
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>