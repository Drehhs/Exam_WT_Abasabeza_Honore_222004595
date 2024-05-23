<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_GET){
        //import database and get id to be deleted
        include("../connection.php");
        $id=$_GET["id"];
        
        $sql= $database->query("delete from appointment where appoid='$id';");
        //$sql= $database->query("delete from doctor where docemail='$email';");
        //print_r($email);
        header("location: appointment.php");
    }


?>