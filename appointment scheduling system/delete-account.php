<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php
//check sessions 

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: login.php");
    }
    

    //import database
    include("connection.php");
    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];

    
    if($_GET){
        //import database and get the patient details to be deleted 
        include("connection.php");
        $id=$_GET["id"];
        $sqlmain= "select * from patient where pid=?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result001 = $stmt->get_result();
        $email=($result001->fetch_assoc())["pemail"];

        $sqlmain= "delete from webuser where email=?;";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();


        $sqlmain= "delete from patient where pemail=?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();

        //logout location
        header("location: logout.php");
    }


?>