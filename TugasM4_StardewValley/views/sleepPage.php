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
    <title>Sleep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/palette.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> 
</head>
<body>
    <div class="home-con container text-center d-flex flex-column justify-content-center align-items-center gap-3">
        <h4 class="light-green">Here's what you sold today</h4>

        <div class="dark-green container d-flex flex-column justify-content-center align-items-center gap-1">
          
          <div id="sales-report" class="w-100">
            <div class="save-text">
                    <b><i class="bi bi-receipt"></i> Sales Report</b>
                    <span>No Items Sold</span> <br>
                    <small>Your shipping bin was empty today. Try harvesting some crops tomorrow!</small>
                </div>
            </div>

            <div id="total-earned" class="w-100" style="display: none;">
                <div class="total-earned p-3 rounded-2 d-flex justify-content-between align-items-center">
                    <b class="fs-5">Total Earned:</b>
                    <b class="fs-5"><i class="bi bi-coin"></i> <span id="total-gold">0g</span></b>
                </div>
            </div>
        </div>

        <button class="myBtn mt-2" id="continue-day">
            <i class="bi bi-moon-stars-fill"></i><span> Continue to New Day</span>
        </button>
    </div>

    <script>
        function getSalesReport(){
            $.ajax({
                url: 'controls/getShippingBin.php',
                method: 'POST',
                data: {
                    id: <?= json_encode($save['id']) ?>
                },
                dataType: 'json',
                success: function(response){
                    if (response.status === 'success'){
                        $('#sales-report').empty();
                        
                        var crops = response.crops;
                        var totalEarned = 0;

                        if (crops.length > 0) {
                            $('#sales-report').append('<b ><i class="bi bi-receipt"></i> Sales Report</b>');
                            crops.forEach(crop => {
                                var itemTotal = crop.amount * crop.sell_price;
                                totalEarned += itemTotal;

                                var row = `
                                    <div class="my-2 d-flex justify-content-between align-items-center rounded-2 p-3" style="background: #ffffff;">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="crop-frame px-2 py-2 bi bi-leaf-fill rounded-2 border border-2 border-secondary" style="background: ${crop.color}; "></i>
                                            <div class="text-start">
                                                <b>${crop.crop_name}</b><br>
                                                <small>${crop.amount} x ${crop.sell_price}g each</small>
                                            </div>
                                        </div>
                                        <b class="dark-green">${itemTotal}g</b>
                                    </div>
                                `;
                                $('#sales-report').append(row);
                            });

                            $('#total-gold').text(totalEarned + 'g');
                            $('#total-earned').show();
                        } else {
                            $('#sales-report').html(`
                                <div class="save-text">
                                    <span class="fw-bold">No Items Sold</span> <br>
                                    <small>Your shipping bin was empty today. Try harvesting some crops tomorrow!</small>
                                </div>
                            `);
                            $('#total-earned').hide();
                        }
                    }
                },
                error: function(xhr, status, error){
                    console.error('Error fetching sales report:', error);
                }
            });
        }

        $(document).ready(function(){
            getSalesReport();

            $(document).on('click', '#continue-day', function(){
                $.ajax({
                    url: 'controls/processNewDay.php',
                    method: 'POST',
                    data: {
                        save_id: <?= json_encode($save['id']) ?>
                    },
                    dataType: 'json',
                    success: function(response){
                        if (response.status === 'success'){
                            window.location.href = 'mainPage.php';
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error processing new day:', error);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>