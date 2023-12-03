<?php

include 'connect.php';

$update_success = 0;
$update_error = 0;
$id_error = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $title_escape = mysqli_real_escape_string($connect, $title);
    $description_escape = mysqli_real_escape_string($connect, $description);

    $sql = "SELECT * FROM `task` WHERE `id` = '$id'";
    $result = mysqli_query($connect, $sql);

    if($result){

        $sql_edit = "UPDATE `task` SET  `title` = '$title_escape', `description`= '$description_escape' WHERE `id` = '$id'";
        
        $result_edit = mysqli_query($connect, $sql_edit);


        if($result_edit){
            $update_success = 1;
            header("location: edit.php");
        }else{
            $update_error = 1;
            header("location: edit.php");
            
        }
    }else{

        $id_error = 1;
    }
    

}

?>