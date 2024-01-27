<?php
session_start();

$username = 0;
$user_error = 0;

if(isset($_SESSION['username'])){

    $username = 1;

}else{
    $user_error = 1;
}
?>

<?php

include 'connect.php';


$add = 0;
$error = 0;
$title_error= 0;
$description_error = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $title = $_POST['title'];
    $description = $_POST['description'];

    #This is to allow single quote ('') when a user input a statement...

    $title_escape = mysqli_real_escape_string($connect, $title);
    $description_escape = mysqli_real_escape_string($connect, $description);

    if(empty($_POST['title'])){
        $title_error = 1;

    }elseif(empty($_POST['description'])){

        $description_error = 1;
    }else{  
        $sql = "INSERT INTO `task` (`title`, `description`) VALUES ('$title_escape', '$description_escape')";

        $result = mysqli_query($connect, $sql);
        if($result){
            $add = 1;
            
        }else{
            $error = 1;
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
    <link rel="stylesheet" href="Custom-css/dashboard.css">
    <title>Add task</title>
</head>
<body>

    <style>
        body{
            height: 100vh;
            overflow: hidden;
        }

        .loader{
            height: 4rem;
            width: 4rem;
            border-radius: 50%;
            border: 5px solid red;
            border-left: 0px;
            border-bottom: 0px;
            animation: rotate 1s forwards infinite;
        }

        @keyframes rotate {
            0%{
                transform: rotate(0deg);
            }

            100%{
                transform: rotate(360deg);
            }
        }

        @media (max-width: 767.98px) {
            .loader-wrapper{
                display: none;
            }

            .content{
                margin-top: .5rem;
                display: block !important;
            }
        }
    </style>

    <div class="container-fluid loader-wrapper" style="height: 100vh;">
        <?php
        echo"<script>";
        echo" if(window.innerWidth > 768){";

        echo'setTimeout(function(){
            window.location.href = "dashboard.php";}, 10000);';

        echo "}";
        echo"</script>";
        ?>
        <div class="row align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-md-12 text-center">
                <p>Oops! can't view page on large screen. Redirecting...</p>

                <div class="loader m-auto"></div>
            </div>
        </div>
    </div>

    <div class="content d-none">
        <div class="nav-section z-index-5 border-bottom py-2 d-flex position-fixed top-0 w-100  start-0" style=" z-index: +99999;">
            <span class="fs-5 d-flex align-items-center ms-4">
                <i class="fa far fa-user-circle fs-4"></i> 
                <small class="ms-1">Welcome <?php 
                if($username){
    
                    echo $_SESSION['username'];
                }
                ?>
                
                <?php 
                if($user_error){
    
                    header('location: login.php');
                }
                ?>
                </small>
            </span>
            <span class="ms-auto me-3 dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fas fa-ellipsis-v btn fs-5"></i>
            </span>
            <div class="dropdown-menu text-center">
                <a href="logout.php" class="dropdown-item"><i class="fa fas fa-power-off"></i> Log out</a>
            </div>
        </div>
    
        <div class="container-fluid">
            <div class="row pt-5 wrapper">
    
            <div class="col-md-12 add-task position-relative">
                <div class="sub-nav position-absolute w-100 start-0 text-center pt-2">
                        <p class="fs-5">ADD A TASK</p>
                    </div>
    
                    <div class="form-wrapper">
                        
                        <?php
                        if($add){
                            echo"<div class='alert alert-success'><i class='fa fa-check'></i> Task Added Successfully</div>";
                        }
                        ?>
    
                        <?php
                        if($error){
                            echo"<div class='alert alert-danger'><i class='fa fa-times'></i> </div>";
                        }
                        ?>
    
                        <?php
    
                        if($title_error){
                            echo"<div class='alert alert-danger'><i class='fa fa-times-circle'></i> Title Field is required</div>";
                        }
                        ?>
    
                        <?php
                        if($description_error){
                            echo"<div class='alert alert-danger'><i class='fa fa-times-circle'></i> Description field is empty</div>";
                        }
                        ?>
    
                        <form method="post">
                            <label>Title:</label>
                            <input type="text" name="title" class="form-control mt-2">
    
                            <label class="mt-4">Description:</label>
                            <textarea name="description" cols="30" rows="10" class="form-control mt-2"></textarea>
    
                            <button type="submit" class="btn btn-danger fw-bold w-100 mt-3"><i class="fa fa-plus"></i> ADD</button>
                        </form>
                    </div>
                </div>
    
            </div>
            <a href="dashboard.php" class="btn btn-danger add_new bottom-0 add_new position-fixed px-3 rounded-0 end-0 mb-5 me-3 py-2">
                <i class="fa fa-home"></i> 
            </a>
        </div>
    </div>
    

    






    <!-- Bootstrap JS -->
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>