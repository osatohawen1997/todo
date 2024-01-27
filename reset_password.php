<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=PT+Sans&family=Poppins:wght@300;400;600&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap link -->
    <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Custom-css/reset.css">
    <title>TODO</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 img-container">
                <img src="image/istockphoto-1394116913-612x612-removebg-preview.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 px-5 form">
                <div class="form-wrapper bg-light rounded-2 py-5 px-3 text-center">
                    <h3 class="mb-4">RESET PASSWORD</h3>

                    <?php
                    if($success){
                        echo"<div class='alert alert-success text-start mb-3'><i class='fa fa-check-circle text-success'></i> Password Has Been Updated Successfully</div>";
                    }
                    ?>

                    <?php
                    if($error){
                        echo"<div class='alert alert-danger text-start mb-3'><i class='fa fa-times-circle text-danger'></i> Confirm Password Does Not Match</div>";
                    }
                    ?>

                    <?php
                    if($failed){
                        echo"<div class='alert alert-danger text-start mb-3'><i class='fa fa-times-circle text-danger'></i> Error While Resetting Password</div>";
                    }
                    ?>

                    <?php
                    if($empty_error){
                        echo"<div class='alert alert-danger text-start mb-3'><i class='fa fa-times-circle text-danger'></i> Input Field Is Empty!</div>";
                    }
                    ?>

                    <?php
                    if($confirm_error){
                        echo"<div class='alert alert-danger text-start mb-3'><i class='fa fa-times-circle text-danger'></i> Confirm Input Field Is Empty!</div>";
                    }
                    ?>
                    

                    <form method="post">

                        <div class="input-group align-items-center gap-2 border ps-2 rounded mb-4">
                            <label for=""><i class="fa fas fa-lock fs-5"></i></label>
                            <input type="password" name="new_password" class="form-control bg-transparent border-0" placeholder="Enter New Password" autocomplete="off">
                        </div>

                        <div class="input-group align-items-center gap-2 border ps-2 rounded mb-4">
                            <label for=""><i class="fa fas fa-check-circle fs-5"></i></label>
                            <input type="password" name="confirm_password" class="form-control bg-transparent border-0" placeholder="Confirm Password" autocomplete="off">
                        </div>

                        <button type="submit" class="btn signup text-light fw-bold rounded-0 mb-4 px-3 py-2">RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>






    <!-- Bootstrap JS -->
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>