<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Save</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="create-con container d-flex flex-column gap-3">
        <form action="savePage.php" method="post">
            <button class="menu-btn btn btn-outline-success fw-semibold" type="submit"><i class="bi bi-arrow-left"></i> Back to Menu</button>
        </form>
        <div class="text-center d-flex flex-column justify-content-center align-items-center">
            <h3 class="light-green">Create New Save</h3>
            <p class="dark-green fw-semibold">Start your farming adventure!</p>
        </div>
        <div class="inner-create-save dark-green container">
            <div class=" d-flex flex-column gap-2">
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold"><i class="bi bi-person-fill"></i> Character Name</label>
                <input type="text" class="form-control create-input" id="name" placeholder="Enter your character's name" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="farm-name" class="form-label fw-semibold"><i class="bi bi-leaf-fill"></i> Farm Name</label>
                <input type="text" class="form-control create-input" id="farm-name" placeholder="Name your farm"  autocomplete="off">
            </div>
                <div class="d-flex justify-content-center">
                    <button class="myBtn" id="create-save"><i class="bi bi-plus-circle-fill me-1"></i> Create Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Error & Success Toasts -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="validationToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Please fill all fields!
                </div>
            </div>
        </div>
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Save successfully created!
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="../assets/js/script.js"></script> -->
    <script>

        
        $(document).ready(function(){
            $(document).on('click', '#create-save', function() {
                var n = $('#name').val();
                var f = $('#farm-name').val();

                if (n === '' || f === ''){
                    $('#validationToast').fadeIn().delay(3000).fadeOut();
                } else {
                    $.ajax({
                        url: 'controls/createSave.php',
                        method: 'POST',
                        data: {
                            name: n,
                            farmName: f
                        },
                        success: function(response){
                            var res = JSON.parse(response);

                            if (res.status === 'success'){
                                $('#successToast').fadeIn().delay(3000).fadeOut();

                                $('#name').val('');
                                $('#farm-name').val('');

                                getData();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error adding item:', error);
                        }
                    })
                }
            })
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>