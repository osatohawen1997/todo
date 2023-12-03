<?php
include 'connect.php';

$del_error = 0;

if(isset($_GET['deleteid'])){

    $id = $_GET['deleteid'];

    $sql = "DELETE FROM `task` WHERE `id` = '$id'";
    $result = mysqli_query($connect, $sql);
    if($result){
        header('location: dashboard.php');
    }else{
        $del_error = 1;
    }
}
?>