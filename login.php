<?php
session_start();
?>

<?php
include 'connect.php';

$f_error = 0;
$p_error = 0;
$error = 0;
$num_error = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];


    if(empty($_POST['username'])){
        $f_error = 1;
    }elseif(empty($_POST['password'])){
        $p_error = 1;
    }else{
        $sql = "SELECT `username`, `password` FROM `register` WHERE (`username`) = ('$username')";
    
        $result = mysqli_query($connect, $sql);
        if($result){
            $num = mysqli_fetch_assoc($result);
            if($num > 0){
               
                $_SESSION['username'] = $num['username'];
                $hashedPassword = $num['password'];

                if(password_verify($password,$hashedPassword)){
                    header('location: dashboard.php');

                }else{
                    $error = 1;
                }

                
            }else{
                $error = 1;
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
            <div class="col-md-6 px-5 form">
                <div class="form-wrapper bg-light rounded-2 py-4 px-3 text-center">
                    <?php
                    if($error){
                        echo"<div class='alert alert-danger text-start'><i class='fa fa-times-circle text-danger'></i> Invalid credential</div>";
                    }
                    ?>

                    <?php
                    if($f_error){
                        echo"<div class='alert alert-danger text-start'><i class='fa fa-times-circle text-danger'></i> Username is required</div>";
                    }
                    ?>

                    <?php
                    if($p_error){
                        echo"<div class='alert alert-danger text-start'><i class='fa fa-times-circle text-danger'></i> Password is required</div>";
                    }
                    ?>

                    <?php
                    if($num_error){
                        echo"<div class='alert alert-danger text-start'><i class='fa fa-times-circle text-danger'></i> No record found!</div>";
                    }
                    ?>
                    <form method="post">

                        <div class="input-group align-items-center gap-2 border ps-2 rounded mb-4">
                            <label for=""><i class="fa fas fa-at fs-5"></i></label>
                            <input type="text" name="username" class="form-control bg-transparent border-0" placeholder="Enter Your Username" autocomplete="off">
                        </div>

                        <div class="input-group align-items-center gap-2 border ps-2 rounded mb-2">
                            <label for=""><i class="fa fas fa-lock fs-5"></i></label>
                            <input type="password" name="password" class="form-control bg-transparent border-0" placeholder="Enter Your Password" autocomplete="off">
                        </div>
                        <div class="text-start mb-4">
                            <a href="reset.php" class="text-decoration-none"><small>Forgot password ?</small></a>
                            <p>Create an account <a href="signup.php" class="text-decoration-none">Sign up</a></p>
                        </div>


                        <button type="submit" class="btn signup text-light fw-bold rounded-0 px-3 py-2">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <!-- Bootstrap JS -->
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>