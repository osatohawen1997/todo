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

        .container-fluid .wrapper .task .listing{
            padding-bottom: 4rem;
        }


        @media (max-width: 767.98px) {
            body{
                overflow: scroll;
            }

            .container-fluid .wrapper{
                height: 100% !important;
            }
            
            .container-fluid .wrapper .task .listing{
                padding-bottom: 0rem !important;
            }
            
            .container-fluid .wrapper .task .sub-nav{
                position: fixed !important;
            }

            .task{
                display: none !important;
            }

            .edit_task{
                display: block !important;
                
            }

            .form-wrapper{
                margin-top: 4rem !important;
                padding-left: 2rem !important;
                padding-right: 2rem !important;
            }
        }

        @media (max-width: 575.98px) {
            .form-wrapper{
                padding-left: .5rem !important;
                padding-right: .5rem !important;
            }
        }

    </style>


    <div class="nav-section z-index-5 border-bottom py-2 d-flex" style=" z-index: +99999;">
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

                </div>
                    
            </div>
            <div class="col-md-4 edit-task text-center position-relative">
                <div class="sub-nav position-absolute w-100 start-0 text-center pt-2">
                    <p class="fs-5">EDIT TASK</p>
                </div>

                <div class="form-wrapper mt-5">

                    <?php

                    if(isset($_GET['editid'])){
                        
                        $id = $_GET['editid'];
                    

                        $sql = "SELECT * FROM `task` WHERE `id` = '$id'";
                        $result = mysqli_query($connect, $sql);

                        if($result){
                            while($row =  mysqli_fetch_assoc($result)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                


                                echo"<form method='post'class='text-start'>
                                    <label>Title:</label>
                                    <input type='text' name='title' class='form-control mt-2' value='$title'>

                                    <label class='mt-4 text-start'>Description:</label>
                                    <textarea name='description' cols='30' rows='10' class='form-control mt-2'>$description</textarea>

                                    <button type='submit' class='btn btn-danger fw-bold w-100 mt-3'><i class='fa fa-edit'></i> EDIT</button>

                                </form>";

                                
                            }
                            
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                
                                $title = $_POST['title'];
                                $description = $_POST['description'];
                                $title_escape = mysqli_real_escape_string($connect, $title);
                                $description_escape = mysqli_real_escape_string($connect, $description);
                                

                                $sql_edit = "UPDATE `task` SET  `title` = '$title_escape', `description`= '$description_escape' WHERE `id` = '$id'";
            
                                $result_edit = mysqli_query($connect, $sql_edit);
                        
                        
                                if($result_edit){
                                    echo"<div class='mt-2 alert alert-success'>Updated successfully!</div>";
                                   
                                    header("Location: dashboard.php");
                                    
                                }else{
                                    echo"<div class='mt-2 alert alert-danger'>Update was not successful. Try again</div>"; 
                                }

                            }
                            
                        }else{
                            echo"<div class='alert alert-dark'>No record found!</div>";

                            exit();
                        }
                        
                        
                    }

                    ?>
                </div>
                <a href="dashboard.php" class="text-decoration-none">Back to homepage</a>
            </div>
        </div> 
    </div>


    <a href="dashboard.php" class="btn btn-danger edit_new bottom-0 add_new position-fixed px-3 rounded-0 end-0 mb-5 me-3 d-none py-2">
        <i class="fa fa-home"></i> 
    </a>

    <!-- Bootstrap JS -->
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
