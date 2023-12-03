<?php

include 'connect.php';
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

<?php
$update_success = 0;
$update_error = 0;


if(isset($_POST['ld']) && isset($_POST['title']) && isset($_POST['description'])){

    $id = $_POST['id'];
    $title_ii = $_POST['title'];
    $description_ii = $_POST['description'];
    
    
    $sql_iii = "SELECT * FROM `task` WHERE `id` = '$id'";
    
    $result_iii = mysqli_query($connect, $sql_iii);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result_iii);
        while($row){
            
            $id = $row['id'];
            $title_ii = $row['title'];
            $description_ii = $row['description'];

            $sql_iv = "UPDATE `task` SET `title` = '$title_ii', `description` = '$description_ii' WHERE id = '$id' ";
        
            $result_iv = mysqli_query($connect,$sql_iv);
            if($result_iv){
                $update_success = 1;
            }else{
                $update_error = 1;
            }
        }
            
    }else{
        die(mysqli_error($connect));
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
    <title>DASHBOARD</title>
</head>
<body>
    <style>
        body{
            overflow-y: hidden;
        }

        .container-fluid .wrapper{
            height: 100vh !important;
        }

        .container-fluid .wrapper{
            margin-top: 3rem;
        }

        .container-fluid .wrapper .task .listing{
            padding-bottom: 4rem;
        }

        @media (max-width: 767.98px) {
            body{
                overflow: auto;
            }

            .container-fluid .wrapper{
                height: 100% !important;
            }
            
            .container-fluid .wrapper .task{
                overflow-y: scroll;
            }

            .container-fluid .wrapper .task .listing{
                padding-bottom: 2rem !important;
            }
            
            .container-fluid .wrapper .task .sub-nav{
                position: fixed !important;
            }

            .add-task{
                display: none !important;
            }

            .add_new{
                display: block !important;
            }
        }

        @media (max-width: 767.98px) {

        }


    </style>


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
    <div class="container-fluid border">
        <div class="row wrapper">
            <div class="col-md-8 position-relative task px-3 bg-light" style="height: 100vh;" id="task">
                <div class="sub-nav shadow text-center position-absolute start-0 w-100 pt-2">
                    <p class="fs-5">MY TASK</p>
                </div>

                <div class="listing">
                    
                    <!-- THIS IS A FUNCTIONALITY IN OTHER TO DELETE A TASK FROM THE LIST -->


                    <?php
                    include 'delete.php';
                    ?>

                    <?php
                    if($del_error){
                        echo"<div class='alert alert-dark w-25'>Error while performing operation!</div>";
                    }
                    ?>

                    <?php

                    $sql_ii = "SELECT * FROM `task`";
                    $result_ii = mysqli_query($connect, $sql_ii);
                    if($result_ii){
                        while($row = mysqli_fetch_assoc($result_ii)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];

                            echo'<div class="description d-flex align-items-center position-relative justify-content-center rounded-2">
                            <span class="px-1 position-absolute tag start-0 bg-warning rounded-start-2"></span>
                            <div class="note py-3 px-2 mx-2">
                                <label class="fw-bold">Title:</label> '.$title.'
                            
                                <div class="description-wrapper mt-2">
                                    <label>Description:</label> '.$description.'
                                </div>
                            </div>
                            <div class="icons d-flex">
                                <a href="edit.php?editid='.$id.'" class="text-decoration-none btn">
                                    <i class="fa far fa-edit fs-5"></i>
                                </a>
                                <a href="delete.php?deleteid='.$id.'" class="text-decoration-none btn">
                                    <i class="fa far fa-trash-alt text-danger fs-5"></i>
                                </a>
                            </div>
                            </div>';
                        }
                    }else{
                        echo"<h3 class='text-secondary text-center mt-5'>NO TASK AVAILABLE</h3>";
                    }
                    ?>

                    <div class="total text-center mt-3">
                    <?php
                        $sql_count = "SELECT Count(*) as 'todo' FROM task";
                        $result_count = mysqli_query($connect, $sql_count);

                        if($result_count){
                            $row_count = mysqli_fetch_assoc($result_count);
                            if($row_count){
                                $todo = $row_count['todo'];

                                echo"<small class='text-secondary'>Total task: $todo</small>";

                            }


                        }else{
                            echo"<small class='text-secondary'>No Task Available</small>";
                        }

                    ?>
                    </div>

                </div>
                    
            </div>
            <div class="col-md-4 add-task border-start position-relative">
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
    </div>


    <a href="add.php" class="btn btn-danger add_new bottom-0 add_new position-fixed px-3 rounded-0 end-0 mb-5 me-3 d-none py-2">
        <i class="fa fa-plus"></i> 
    </a>

    <!-- Bootstrap JS -->
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>