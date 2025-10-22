<?php 
  require_once '../connect.php';

  if (!isset($_SESSION['save'])) {
      header('Location: savePage.php');
      exit;
  }
  $save = $_SESSION['save'];

  $stmt = $conn->prepare("SELECT * FROM crops");
  $stmt->execute();
  
  $allCrops = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/palette.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container mt-3">
    <div class="header peach-container container-fluid d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-2">
        <h2 class="light-green"><i class="bi bi-shop-window"></i> Pierre's General Store</h2>
        <span class="badge day-badge"></span>
        <span class="badge gold-badge"></span>
      </div>
      <a href="mainPage.php" class="exit-btn btn btn-success text-white"><i class="bi bi-arrow-left"></i> Back to Farm</a>
    </div>
    <div class="container mt-3">
      <div class="row d-flex justify-content-between align-items-start">
          <div class="con peach-container col-5 text-center">
              <b class="dark-green fs-5"><i class="bi bi-leaf-fill"></i> Seeds for Sale</b>
              <div class="">
                  <?php foreach ($allCrops as $c){ ?>
                    <div class="lime-container container p-3 rounded-2 my-3">
                      <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex gap-2">
                          <i class="crop-frame px-3 py-2 bi bi-leaf-fill rounded-2 border border-2 border-secondary" style="background: <?= $c['color']?>; "></i>
                          <div class="d-flex flex-column text-start">
                            <b class="dark-green"><?= $c['crop_name'] ?> Seeds</b>            
                            <small class="desc">Grows in <?= $c['growth_time'] ?> days</small>
                          </div>
                        </div>
                        <div class="d-flex flex-column text-end">
                          <b class="brown"><?= $c['buy_price'] ?>g</b>
                          <small class="desc">Sells for <?= $c['sell_price'] ?></small>
                        </div>
                      </div>
                      <div class="container">
                        <div class="row justify-content-center gap-2">
                          <button id="buy-1-<?= strtolower($c['crop_name']) ?>" class="btn btn-success btn-sm col"><i class="bi bi-cart-fill"></i> Buy 1</button>
                          <button id="buy-5-<?= strtolower($c['crop_name']) ?>" class="btn btn-primary btn-sm col"><i class="bi bi-basket-fill"></i> Buy 5</button>
                        </div>
                      </div>
                    </div>
                    
                  <?php } ?>
              </div>
          </div>
          <div class="con peach-container col-5 text-center" id="inventory-box" data-id="<?= $save['id'] ?>">
              <b class="dark-green fs-5">Your Inventory</b>
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
      function getInventory(){
        var id = $('#inventory-box').data('id');
        $.ajax({
          url: 'controls/getInventory.php',
          method: 'POST',
          data: {
            id: id
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
                          <div class="d-flex justify-content-between">
                              <small class="fw-bold">${seed.crop_name} Seeds</small>
                              <small class="fw-bold">x${seed.amount}</small>
                          </div>
                      </div>
                    `;
                    $('#inventory-seeds').append(row);
                  });
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
                      </div>`;
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
        });
      };
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
      $(document).ready(function(){
            getInventory();
            getCurrentSaveData();

            setInterval(function(){
                getInventory(); 
                getCurrentSaveData();
            }, 1000)

            $(document).on('click', '[id^="buy-"]', function(){
                var idParts = this.id.split('-');
                var quantity = parseInt(idParts[1]);
                var cropName = idParts.slice(2).join('-');

                $.ajax({
                    url: 'controls/buyItem.php',
                    method: 'POST',
                    data: {
                        crop_name: cropName,
                        quantity: quantity,
                        save_id: <?= $save['id'] ?>
                    },
                    success: function(response){
                        var res = JSON.parse(response);

                        if (res.status === 'success'){
                            $('#success-message').text(res.message);
                            $('#successToast').fadeIn().delay(3000).fadeOut();

                            $('.badge.gold-badge').text('Gold: ' + (<?= $save['gold'] ?> - (quantity * res.totalPrice)));
                            
                            getInventory();
                            getCurrentSaveData();
                        } else {
                            $('#error-message').text(res.message);
                            $('#validationToast').fadeIn().delay(3000).fadeOut();
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error buying item:', error);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>