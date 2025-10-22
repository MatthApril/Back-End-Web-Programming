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
    <title>Shipping Bin</title>
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
                <h2 class="light-green">Shipping Bin</h2>
                <span class="badge day-badge"></span>
                <span class="badge gold-badge"></span>
            </div>
            <a href="mainPage.php" class="exit-btn btn btn-success text-white"><i class="bi bi-arrow-left"></i> Back to Farm</a>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-between align-items-start">
                <div class="con peach-container col-5 text-center">
                    <b class="dark-green fs-5"><i class="bi bi-house-fill"></i> Your Crops</b>
                    <div class="crop-list mt-2">

                    </div>
                </div>
                <div class="con peach-container col-5 text-center">
                    <div class="d-flex flex-column justify-content-center gap-2">
                        <b class="dark-green fs-5"><i class="bi bi-truck"></i> Shipping Bin</b>
                        <div class="mb-2" id="shipping-list">
                            <small class="desc">Shipping bin is empty</small>
                        </div>
                    </div>
                    <div class="container rounded-2">
                        <div class="bin-container p-3 mt-2 mb-3 rounded-2 d-flex justify-content-between">
                            <b class="brown">Total Value: </b>
                            <b class="brown" id="total-value">0g</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="validationToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="error-message">
                    <!-- Error Message -->
                </div>
            </div>
        </div>
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="success-message">
                    <!-- Success Message -->
                </div>
            </div>
        </div>
    </div>
    
    <script>
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
        };
        function getInventory(){
            var id = <?= json_encode($save['id']) ?>;

            $.ajax({
            url: 'controls/getInventory.php',
            method: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response){
                $(".crop-list").empty();

                if (response.status === 'success'){
                    var crops = response.crops;

                    if (crops.length > 0){
                        crops.forEach(c => {
                            var row = `
                                <div class="lime-container container p-3 rounded-2 my-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="d-flex gap-2">
                                        <i class="crop-frame px-3 py-2 bi bi-leaf-fill rounded-2 border border-2 border-secondary" style="background: ${c['color']}; "></i>
                                        <div class="d-flex flex-column text-start">
                                            <b class="dark-green"> ${c['crop_name']} Seeds</b>            
                                            <small class="desc">Available: ${c['amount']}</small>
                                        </div>
                                        </div>
                                        <div class="text-end">
                                            <b class="brown">${c['sell_price']}g each</b>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row justify-content-center gap-2">
                                        <button id="ship-one" data-id="${c['crop_id']}" class="btn orange btn-danger btn-sm col fw-bold">Ship 1</button>
                                        <button id="ship-all" data-id="${c['crop_id']}" class="btn btn-danger btn-sm col fw-bold">Ship All</button>
                                        </div>
                                    </div>
                                    </div>
                            `;
                            $(".crop-list").append(row);
                        });
                    } else {
                        $(".crop-list").html('<small class="desc">No crops available</small>');

                    }
                }
            },
            error: function(xhr, status, error){
                console.error('Error loading data:', error);
            }
            });
        };
        function getShippingBin(){
            $.ajax({
                url: 'controls/getShippingBin.php',
                method: 'POST',
                data: {
                    id: <?= json_encode($save['id']) ?>
                },
                dataType: 'json',
                success: function(response){
                    if (response.status === 'success'){
                        $('#shipping-list').empty();
                        $('#total-value').text('0g');
                        
                        var crops = response.crops;
                        var totalValue = 0;

                        if (crops.length > 0) {
                            crops.forEach(crop => {
                                var itemTotal = crop.amount * crop.sell_price;
                                totalValue += itemTotal;

                                var row = `
                                <div class="container">
                                    <div class="bin-container py-2 px-3 mb-1 rounded-2 d-flex justify-content-between align-items-center">
                                        <div class="text-start">
                                            <b class="brown">${crop.crop_name}</b><br>
                                            <small class="brown">${crop.amount} x ${crop.sell_price}g = ${itemTotal}g</small>
                                        </div>
                                        <button class="btn btn-danger btn-sm" id="remove-crop" data-name="${crop.crop_name.toLowerCase()}">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                                `;
                                $('#shipping-list').append(row);
                            });

                            $('#total-value').text(totalValue + 'g');
                        } else {
                            $('#shipping-list').html('<small class="desc">Shipping bin is empty</small>');
                        }
                    }
                },
                error: function(xhr, status, error){
                    console.error('Error fetching shipping bin data:', error);
                }
            });
        };
        $(document).ready(function(){
            getCurrentSaveData();
            getInventory();
            getShippingBin();

            setInterval(function(){
                getCurrentSaveData();
                getInventory();
                getShippingBin();
            }, 5000);

            $(document).on('click', '#ship-one', function(){
                var cropId = $(this).data('id');
                var saveId = <?= json_encode($save['id']) ?>;

                $.ajax({
                    url: 'controls/shipCrop.php',
                    method: 'POST',
                    data: {
                        save_id: saveId,
                        crop_id: cropId,
                        amount: 'one'
                    },
                    dataType: 'json',
                    success: function(response){
                        if (response.status === 'success'){
                            getInventory();
                            getShippingBin();
                            getCurrentSaveData();

                            $('#success-message').text(response.message);
                            $('#successToast').fadeIn().delay(3000).fadeOut();
                        } else if (response.status === 'error'){
                            $('#error-message').text(response.message);
                            $('#validationToast').fadeIn().delay(3000).fadeOut();
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error shipping crop:', error);
                    }
                });
            });
            $(document).on('click', '#ship-all', function(){
                var cropId = $(this).data('id');
                var saveId = <?= json_encode($save['id']) ?>;

                $.ajax({
                    url: 'controls/shipCrop.php',
                    method: 'POST',
                    data: {
                        save_id: saveId,
                        crop_id: cropId,
                        amount: 'all'
                    },
                    dataType: 'json',
                    success: function(response){
                        if (response.status === 'success'){
                            getInventory();
                            getShippingBin();
                            getCurrentSaveData();

                            $('#success-message').text(response.message);
                            $('#successToast').fadeIn().delay(3000).fadeOut();
                        } else if (response.status === 'error'){
                            $('#error-message').text(response.message);
                            $('#validationToast').fadeIn().delay(3000).fadeOut();
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error shipping all crops:', error);
                    }
                });
            });

            $(document).on('click', '#remove-crop', function(){
                var cropName = $(this).data('name');
                var saveId = <?= json_encode($save['id']) ?>;

                $.ajax({
                    url: 'controls/removeShippedCrop.php',
                    method: 'POST',
                    data: {
                        save_id: saveId,
                        crop_name: cropName
                    },
                    dataType: 'json',
                    success: function(response){
                        if (response.status === 'success'){
                            getInventory();
                            getShippingBin();
                            getCurrentSaveData();
                            
                            $('#success-message').text(response.message);
                            $('#successToast').fadeIn().delay(3000).fadeOut();
                        } else if (response.status === 'error'){
                            $('#error-message').text(response.message);
                            $('#validationToast').fadeIn().delay(3000).fadeOut();
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error removing shipped crop:', error);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>