<?php
include 'connect.php';

$f_error = 0;
$u_error = 0;
$error = 0;
$e_error = 0;
$p_error = 0;
$c_error = 0;
$success = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $fullname = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['cpassword'];

    if(empty($_POST['full_name'])){
        $f_error = 1;
    }elseif(empty($_POST['username'])){
        $u_error = 1;
    }elseif(empty($_POST['email'])){
        $e_error = 1;
    }elseif(empty($_POST['password'])){
        $p_error = 1;
    }elseif($password !== $confirm){
        $c_error = 1;
    }else{

        $sql = "SELECT `username`, `email` FROM `register` WHERE (`username`, `email`) = ('$username', '$email')";

        $result = mysqli_query($connect, $sql);

        if($result){
            $num = mysqli_num_rows($result);

            if($num > 0){
                    
                $error = 1;

            }else{

                $hashed = password_hash($password, PASSWORD_DEFAULT);


                $sql_insert = "INSERT INTO `register` (`full_name`, `username`, `email`, `password`) VALUES ('$fullname', '$username', '$email', '$hashed')";
    
                $result_insert = mysqli_query($connect, $sql_insert);

                if($result_insert){

                    $success = 1;
    
                }else{
                    die(mysqli_error($connect));
                }

            }
  
        }
    }
}
?>
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
    <link rel="stylesheet" href="Custom-css/signup.css">
    <title>TODO</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 img-container">
                <img src="image/vecteezy_3d-calendar-marked-date-for-important-day-in-purple_7503104-removebg-preview.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 form px-5">
                <div class="form-wrapper bg-light rounded-2 py-4 px-3 text-center">
                    <?php
                    if($c_error){
                        echo"<div class='alert alert-danger text-start'><i class='fa fa-times-circle text-danger'></i> Confirm password doesn't match</div>";
                    }
                    ?>

                    <?php
                    if($error){
                        
                        echo"<div class='alert alert-danger text-start'><i class='fa fa-times-circle text-danger'></i> Username or Email already exist</div>";

                    }
                    ?>

                    <?php
                    if($success){
                        
                        echo"<div class='alert alert-success text-start'><i class='fa fa-check-circle text-success'></i> Registered successfully <a href='login.php'>Login</a></div>";
                    }
                    ?>
                    <form method="post">
                        <div class="input-group align-items-center justify-content-center gap-2 ps-2 border rounded mb-4">
                            <label><i class="fa far fa-user fs-5"></i></label>
                            <input type="text" name="full_name" class="form-control bg-transparent border-0" placeholder="Enter Your Full Name" autocomplete="off">

                            <?php
                                if($f_error){
                                    echo"<i class='fa fa-times-circle text-danger me-2'></i>";
                                }
                            ?>
                        </div>

                        <div class="input-group align-items-center gap-2 border ps-2 rounded mb-4">
                            <label for=""><i class="fa fas fa-at fs-5"></i></label>
                            <input type="text" name="username" class="form-control bg-transparent border-0" placeholder="Enter Your Username" autocomplete="off">
                            <?php
                            if($u_error){
                                echo"<i class='fa fa-times-circle text-danger me-2'></i>";
                            }
                            ?>
                        </div>

                        <div class="input-group align-items-center gap-2 border ps-2 rounded mb-4">
                            <label for=""><i class="fa far fa-envelope fs-5"></i></label>
                            <input type="email" name="email" class="form-control bg-transparent border-0" placeholder="Enter Your Email" autocomplete="off">
                            <?php
                            if($e_error){
                                echo"<i class='fa fa-times-circle text-danger me-2'></i>";
                            }
                            ?>
                        </div>

                        <div class="input-group align-items-center gap-2 border ps-2 rounded mb-4">
                            <label for=""><i class="fa fas fa-lock fs-5"></i></label>
                            <input type="password" name="password" class="form-control bg-transparent border-0" placeholder="Enter Your Password" autocomplete="off">
                            <?php
                            if($p_error){
                                echo"<i class='fa fa-times-circle text-danger me-2'></i>";
                            }
                            ?>
                        </div>

                        <div class="input-group align-items-center gap-2 border ps-2 rounded mb-4">
                            <label for=""><i class="fa fas fa-check-circle fs-5"></i></label>
                            <input type="password" name="cpassword" class="form-control bg-transparent border-0" placeholder="Confirm Your Password" autocomplete="off">
                        </div>

                        <button type="submit" class="btn signup text-light fw-bold rounded-0 px-3 py-2 mb-4">SIGN UP</button>
                        <p>Already have an account <a href="login.php" class="text-decoration-none">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <!-- Bootstrap JS -->
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>