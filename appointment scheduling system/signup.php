<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/core.css">
	<link rel="stylesheet" href="css/misc-pages.css">
        
    <title>Sign Up</title>
    
</head>
<body>

<?php

//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

 //import database
 include("connection.php");

//CATCH THE FORM DATA
if($_POST){

    $result= $database->query("select * from webuser");

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $name=$fname." ".$lname;
    $address=$_POST['address'];
    $nic=$_POST['nic'];
    $dob=$_POST['dob'];
    $email=$_POST['newemail'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    
    if ($newpassword==$cpassword){
        $sqlmain= "select * from webuser where email=?;";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows==1){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{
            //insert new user into db and hashing password

            $password = password_hash($newpassword, PASSWORD_DEFAULT);
            $database->query("insert into patient(pemail,pname,ppassword, paddress, pnic,pdob,ptel) values('$email','$name','$password','$address','$nic','$dob','$tele');");
            $database->query("insert into webuser values('$email','p')");

            //starting session and redirecting patient
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: pindex.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
    }



    
}

?>

<body class="simple-page">
    <div id="back-to-home" >
		<a href="../index.php" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn">APS</i></a>
	</div>
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			
				<span style="color: white"><i class="fa fa-gg"></i></span>
				<span style="color: white">Appointment Scheduling system</span>
			
		</div><!-- logo -->

		<div class="simple-page-form animated flipInY" id="login-form">
            <h4 class="form-title m-b-xl text-center">Sign Up With Your DAMS Account</h4>

            <!-- the form to create account starts here -->
            <form action="" method="post">
                <div class="form-group">
                    <input id="fname" type="text" class="form-control" placeholder="First Name" name="fname" required="true">
                </div>
                <div class="form-group">
                    <input id="fname" type="text" class="form-control" placeholder="Last Name" name="lname" required="true">
                </div>
                <div class="form-group">
                    <input id="fname" type="text" class="form-control" placeholder="Address" name="address" required="true">
                </div>
                <div class="form-group">
                    <input id="fname" type="text" class="form-control" placeholder="National ID Number" name="nic" required="true">
                </div>
                <div class="form-group">
                    <input id="fname" type="date" class="form-control" placeholder="Date Of Birth" name="dob" required="true">
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control" placeholder="Email" name="newemail" required="true">
                </div>
                <div class="form-group">
                    <input id="mobno" type="tel" class="form-control" placeholder="Mobile" name="tele" maxlength="10" pattern="[0-9]+" required="true">
                </div>
                
                <div class="form-group">
                    <input id="password" type="password" class="form-control" placeholder="Password" name="newpassword" required="true">
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control" placeholder="Comfirm Password" name="cpassword" required="true">
                </div>
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </form>
        </div><!-- #login-form -->
        
        <div class="simple-page-footer">
            <p>
                <small>Do you have an account ?</small>
                <a href="login.php">SIGN IN</a>
            </p>
        </div>
    </div><!-- .simple-page-wrap -->
</body>
</html>

