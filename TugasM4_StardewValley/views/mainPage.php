<?php 
    require_once '../connect.php';

    if (!isset($_SESSION['save'])) {
        header('Location: savePage.php');
        exit;
    }
    $save = $_SESSION['save'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/palette.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container d-flex flex-column gap-3 mt-3">
        <div class="header peach-container container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <h2 class="light-green"><?= $save['farm_name'] ?> Farm</h2>
                <span class="badge day-badge"></span>
                <span class="badge gold-badge"></span>
            </div>
            <form action="controls/logout.php">
                <button class="exit-btn btn btn-danger orange text-white"><i class="bi bi-x"></i> Exit Game</button>
            </form>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-between align-items-start">
                <div class="con peach-container col-5 text-center">
                    <b class="dark-green fs-5">Crop Fields</b>
                    <div class="plot-grid my-3" data-id="<?= $save['id'] ?>">
                        
                    </div>
                </div>
                <div class="con peach-container col-5 text-center">
                    <b class="dark-green fs-5">Inventory</b>

                    <div class="row mt-2 justify-content-between">
                        <div class="col">
                            <div class="lime-container p-2 rounded-2">
                                <b class="dark-green">Seeds</b>
                                <div id="inventory-seeds" class="mt-1">
                                    <small class="desc">No seeds available</small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="lime-container p-2 rounded-2">
                                <b class="dark-green">Crops</b>
                                <div id="inventory-crops" class="mt-1">
                                    <small class="desc">No crops available</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-3 mt-3">
                        <a href="shipPage.php" class="btn btn-success orange text-white fw-semibold py-2">Shipping Bin</a>
                        <a href="shopPage.php" class="btn btn-success blue text-white fw-semibold py-2">Shop</a>
                        <a href="sleepPage.php" class="btn btn-success purple text-white fw-semibold py-2">Sleep</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        var allPlots;
        var selectedSeedName = '';
        var selectedSeedId = '';

        function getCurrentSaveData() {
            $.ajax({
                url: 'controls/getCurrentSave.php',
                method: 'POST',
                data: {
                    id: <?= json_encode($save['id']) ?>
                },
                dataType: 'json',
                success: function(response){
                    if (response.status === 'success'){
                        $('.day-badge').text('Day ' + response.save.day);
                        $('.gold-badge').text('Gold: ' + response.save.gold);
                    }
                },
                error: function(xhr, status, error){
                    console.error('Error fetching current save data:', error);
                }
            });
        }
        
        function getPlotData(){
            var saveId = $('.plot-grid').data('id');
            $.ajax({
                url: 'controls/getPlots.php',
                method: 'POST',
                data: {
                    id: saveId
                },
                dataType: 'json',
                success: function(response){
                    $(".plot-grid").empty();

                    var plots = response.data;
                    allPlots = plots;

                    if (response.status === 'success'){
                        var newRow = $('<div class="row gap-2 justify-content-center"></div>');
                        plots.forEach(plot => {
                            var soil = plot.is_watered ? '#472305ff' : '#6d4309';
                            var plotContent = '';
                            
                            if (plot.crop_id) {
                                var maxDays = plot.growth_time;
                                var cropSize = 20 + ((Math.min(plot.days_planted / maxDays, 1)) * 60);
                                
                                var daysText = plot.days_planted < maxDays 
                                    ? `<small style="position: absolute; top: 5px; left: 5px; color: yellow; font-weight: bold; background: rgba(0,0,0,0.5); padding: 2px 6px; border-radius: 4px;">${plot.days_planted}/${maxDays}</small>` 
                                    : '';
                                
                                var harvestBtn = plot.days_planted >= maxDays 
                                    ? `<button class="light-brown btn btn-warning  btn-sm" id="harvest-crop" data-plot="${plot.plot_id}" style="position: absolute; bottom: 8px; left: 50%; transform: translateX(-50%);">Harvest</button>` 
                                    : '';
                                
                                var waterBtn = !plot.is_watered && plot.days_planted < maxDays 
                                    ? `<button class="btn btn-primary btn-sm" id="water-crop" data-plot="${plot.plot_id}" style="position: absolute; bottom: 8px; left: 50%; transform: translateX(-50%);"><i class="bi bi-droplet-fill"></i> Water</button>` 
                                    : '';
                                
                                plotContent = `
                                    ${daysText}
                                    <div class="d-flex flex-column justify-content-center align-items-center h-100">
                                        <div class="rounded-2 d-flex justify-content-center align-items-center" 
                                            style="width: ${cropSize}%; height: ${cropSize}%; background: ${plot.color};">
                                            <small class="fw-bold lighter-green">${plot.crop_name}</small>
                                        </div>
                                    </div>
                                    ${waterBtn}
                                    ${harvestBtn}
                                `;
                            } else {
                                // Empty plot - clickable for planting
                                plotContent = `
                                    <div class="d-flex justify-content-center align-items-center h-100 plant-plot" data-plot="${plot.plot_id}" style="cursor: pointer;"></div>
                                `;
                            }
                            
                            var row = `
                                <div class="plot-box col-4 rounded-2 position-relative" style="background:${soil}; transition: all 0.3s;">
                                    ${plotContent}
                                </div>
                            `;
                            $(newRow).append(row);
                        });
                        $('.plot-grid').append(newRow);
                    }
                },
                error: function(xhr, status, error){
                    console.error("Error fetching plot data:", error);
                }
            });
            
            $.ajax({
                url: 'controls/getInventory.php',
                method: 'post',
                data: {
                    id: saveId
                },
                dataType: 'json',
                success: function(response){
                    $("#inventory-crops").empty();
                    $("#inventory-seeds").empty();

                    if (response.status === 'success'){
                        var seeds = response.seeds;
                        var crops = response.crops;
                        
                        if (seeds.length > 0){
                            seeds.forEach(seed => {
                                var row = `
                                    <div class="item-container container rounded-2 my-2">
                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="fw-bold">${seed.crop_name} Seeds</small>
                                            <small class="fw-bold">x${seed.amount}</small>
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-sm btn-success fw-semibold plant-seed" 
                                                    data-name="${seed.crop_name}" 
                                                    data-id="${seed.crop_id}">
                                                <i class="bi bi-leaf-fill"></i> Plant
                                            </button> 
                                        </div>
                                    </div>
                                `;
                                $('#inventory-seeds').append(row);
                            })
                        } else {
                            $("#inventory-seeds").append(
                                '<small class="desc">No seeds available</small>'
                            );
                        }

                        if (crops.length > 0){
                            crops.forEach(crop => {
                                var row = `
                                    <div class="item-container container rounded-2 my-2">
                                        <div class="d-flex justify-content-between">
                                            <small class="fw-bold">${crop.crop_name}</small>
                                            <small class="fw-bold">x${crop.amount}</small>
                                        </div> 
                                    </div>
                                `;
                                $('#inventory-crops').append(row);
                            });
                        } else {
                            $("#inventory-crops").append(
                                '<small class="desc">No crops available</small>'
                            );
                        }
                    }
                },
                error: function(xhr, status, error){
                    console.error('Error loading data:', error);
                }
            })
        }

        $(document).ready(function(){
            getPlotData();
            getCurrentSaveData();

            setInterval(function(){
                getPlotData(); 
                getCurrentSaveData();
            }, 5000);

            // Plant seed button click
            $(document).on('click', '.plant-seed', function(){
                selectedSeedName = $(this).data('name');
                selectedSeedId = $(this).data('id');
                
                $('.plant-plot').css('cursor', 'pointer');
                $('.plant-plot').parent().addClass('border border-success border-3');
                $('.plant-plot').parent().css('box-shadow', '0 0 15px rgba(106, 168, 79, 0.6)');
                
                alert(`Click on an empty plot to plant ${selectedSeedName}`);
            });

            $(document).on('click', '.plant-plot', function(){
                if (selectedSeedId === '') {
                    alert('Please select a seed first!');
                    return;
                }

                var plotId = $(this).data('plot');
                var saveId = <?= json_encode($save['id']) ?>;

                $.ajax({
                    url: 'controls/plantSeed.php',
                    method: 'POST',
                    data: {
                        save_id: saveId,
                        plot_id: plotId,
                        crop_id: selectedSeedId
                    },
                    dataType: 'json',
                    success: function(response){
                        if (response.status === 'success'){
                            selectedSeedName = '';
                            selectedSeedId = '';
                            
                            $('.plot-box').removeClass('border border-success border-3');
                            $('.plot-box').css('box-shadow', '');
                            
                            getPlotData();
                            getCurrentSaveData();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error planting seed:', error);
                    }
                });
            });

            // Water crop
            $(document).on('click', '#water-crop', function(){
                var plotId = $(this).data('plot');
                var saveId = <?= json_encode($save['id']) ?>;

                $.ajax({
                    url: 'controls/waterCrop.php',
                    method: 'POST',
                    data: {
                        save_id: saveId,
                        plot_id: plotId
                    },
                    dataType: 'json',
                    success: function(response){
                        if (response.status === 'success'){
                            getPlotData();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error watering crop:', error);
                    }
                });
            });

            // Harvest crop
            $(document).on('click', '#harvest-crop', function(){
                var plotId = $(this).data('plot');
                var saveId = <?= json_encode($save['id']) ?>;

                $.ajax({
                    url: 'controls/harvestCrop.php',
                    method: 'POST',
                    data: {
                        save_id: saveId,
                        plot_id: plotId
                    },
                    dataType: 'json',
                    success: function(response){
                        if (response.status === 'success'){
                            getPlotData();
                            getCurrentSaveData();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error harvesting crop:', error);
                    }
                });
            });
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>