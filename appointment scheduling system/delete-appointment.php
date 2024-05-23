<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php
//check sessions

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: login.php");
        }

    }else{
        header("location: login.php");
    }
    
    
    if($_GET){
        //import database
        include("connection.php");
        $id=$_GET["id"];

        //delete random appointment from table
        $sql= $database->query("delete from appointment where appoid='$id';");
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        
        //go to
        header("location: appointment.php");
    }


?>