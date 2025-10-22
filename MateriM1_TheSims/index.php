<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require_once "data.php" ?>

    <nav class="navbar bg-body-black">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="asset_materi/logo.png" alt="Bootstrap" width="90" height="45">
            </a>
        </div>
    </nav>
    <div class="container-fluid">
        <?php foreach ($games as $key => $s): ?>
            <div class="mycard card mb-3" style="width: 100%;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <div class="gamecar card" style="width: 18rem;">
                                <img src="<?= $s["img"]?>" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $s["title"] ?></h5>
                                    <p class="card-text">Genre: <?= $s["genre"] ?></p>
                                    <p class="card-text">Release Date: <?= $s["release_date"]?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <?php foreach ($s["reviews"] as $key => $ss): ?>
                                <div class="detailcar card mb-3" style="width: 100%;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2 ">
                                                <?php if ($ss["type"] == "Recommended"):?>
                                                    <button class="btn btn-primary"><i class="bi bi-hand-thumbs-up"></i><?= $ss["type"]?></button>
                                                <?php endif;?>
                                                <?php if ($ss["type"] == "Not Recommended"):?>
                                                    <button class="btn btn-danger"><i class="bi bi-hand-thumbs-down"></i><?= $ss["type"]?></button>
                                                <?php endif;?>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="card-title"><?= $ss["user"]?></h5>
                                                <p class="card-text"><?= $ss["comment"]?></p>
                                            </div>
                                            <div class="col-2">
                                                <p class="card-text text-success"><?= $ss["votes"]["helpful"]?> find this helpful</p>
                                                <p class="card-text text-danger"><?= $ss["votes"]["not_helpful"]?> find this not helpful</p>
                                            </div>
                                            <div class="col-2">
                                                <p class="card-text text-warning"><?= $ss["votes"]["funny"]?> find this funny</p>
                                                <p class="card-text"><?= $ss["votes"]["award"]?> gave this an award</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>