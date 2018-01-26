<?php session_start();
    if(isset($_SESSION['userAdded']))
    {   
        unset($_SESSION['userAdded']);  
        header('location: index.php');
        exit();
    }
?>