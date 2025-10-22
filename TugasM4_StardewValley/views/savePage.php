<?php 
    require_once '../connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="home-con container text-center d-flex flex-column justify-content-center align-items-center">
        <h2 class="light-green">Stardew Valley</h2>

        <form action="createPage.php" method="post">
            <button class="myBtn mt-2 mb-4" type="submit">
                <i class="bi bi-leaf-fill"></i><span> NEW SAVE</span>
            </button>
        </form>

        <div class="inner-save dark-green container d-flex flex-column justify-content-center align-items-center gap-3">
            <b>Load Save</b>

            <div class="d-flex flex-column gap-3" id="save-list">
                <!-- <i class="bi bi-inbox-fill"></i>
    
                <div class="save-text">
                    <span>No save files found</span> <br>
                    <small>Create your first save to get started</small>
                </div> -->
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

    <!-- <script src="../assets/js/script.js"></script> -->
    <script>
        function getData() {
            $.ajax({
                url: "controls/getSaves.php",
                method: "POST",
                dataType: "json",
                data: {
                    bentukData: 'json' // parameter untuk menandakan kita mau data dalam bentuk json
                },
                success: function(response) {
                    console.log(response);

                    let saveList = $('#save-list');
                    saveList.empty();

                    var data = response.data;

                    if (data.length === 0) {
                        saveList.append(`
                            <i class="bi bi-inbox-fill"></i>
                            <div class="save-text">
                                <span>No save files found</span> <br>
                                <small>Create your first save to get started</small>
                            </div>
                        `);
                    } else {
                        data.forEach(function(save){
                            saveList.append(
                                `
                                <div class="save-box d-flex justify-content-between">
                                    <div class="text-start">
                                        <b>${save.name}</b> <br>
                                        <small class="opacity-75">${save.farm_name} Farm</small>
                                    </div>

                                    <div class="text-start">
                                        <span class="fw-bold">Day ${save.day}</span> <br>
                                        <span class="fw-bold">Gold ${save.gold}</span>
                                    </div>

                                    <div class="d-flex gap-2"> 
                                        <form action="controls/checkForm.php" method="post">
                                            <input type="hidden" name="id" value="${save.id}">
                                            <button class="btn btn-primary" name="load-save"><i class="bi bi-play-fill"></i> Load</button>
                                        </form>
                                        <button class="btn btn-danger" id="delete-save" data-id="${save.id}"><i class="bi bi-trash3-fill"></i> Delete</button>
                                    </div>
                                </div>
                                `
                            );
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                }
            })
        }
        $(document).ready(function(){
            getData();

            setInterval(function() {
                getData();
            }, 1000);

            $(document).on('click', '#delete-save', function(){
                var id = $(this).data('id');

                $.ajax({
                    url: 'controls/deleteSave.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response){
                        var res = JSON.parse(response);

                        if (res.status === 'success'){
                            $('#success-message').html(res.message);
                            $('#successToast').fadeIn().delay(3000).fadeOut(function(){
                                $('#success-message').html('');
                            });

                        } else {
                            $('#error-message').html(res.message);
                            $('#validationToast').fadeIn().delay(3000).fadeOut(function(){
                                $('#error-message').html('');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error in deleting save:', error);
                    }
                })
            })
        });
    </script>
    
    <!-- <script src="../assets/js/script.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>