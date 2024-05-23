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

        
    <title>Login</title>   
</head>
<body>

    <?php 
    //Unset all the server side variables

    session_start();

    $_SESSION["user"]="";
    $_SESSION["usertype"]="";
    
   

    //import database
    include("connection.php");

    



    if($_POST){

        $email=$_POST['useremail'];
        $password=$_POST['userpassword'];
        
        $error='<label for="promter" class="form-label"></label>';

        $result= $database->query("select * from webuser where email='$email'");
        if($result->num_rows==1){
            $utype=$result->fetch_assoc()['usertype'];


            if ($utype == 'p') {
                // To check if patient
                $checker = $database->prepare("SELECT ppassword FROM patient WHERE pemail = ?");
                $checker->bind_param('s', $email);
                $checker->execute();
                $result = $checker->get_result();
                
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['ppassword'])) {
                        // Patient dashboard
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'p';
                        header('location: pindex.php');
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } 
            
            } elseif ($utype == 'a') {
                // To check for admin
                $checker = $database->prepare("SELECT apassword FROM admin WHERE aemail = ?");
                $checker->bind_param('s', $email);
                $checker->execute();
                $result = $checker->get_result();
                
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['apassword'])) {
                        // Admin dashboard
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'a';
                        header('location: admin/index.php');
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                }
            
            } elseif ($utype == 'd') {
                // To check for doctor
                $checker = $database->prepare("SELECT docpassword FROM doctor WHERE docemail = ?");
                $checker->bind_param('s', $email);
                $checker->execute();
                $result = $checker->get_result();
                
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['docpassword'])) {
                        // Doctor dashboard
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'd';
                        header('location: doctor/index.php');
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } 
            }
            
          
            
        }else{
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
        }






        
    }else{
        $error='<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?>



<body class="simple-page">
	<div id="back-to-home">
		<a href="index.php" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn">APS</i></a>
	</div>
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			
				<span style="color: white"><i class="fa fa-gg"></i></span>
				<span style="color: white">Appointment system</span>
			
		</div><!-- logo -->

		<div class="simple-page-form animated flipInY" id="login-form">
            <h4 class="form-title m-b-xl text-center">Sign In With Your Account</h4>
            <form method="post" name="login">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Registered Email ID" required="true" name="useremail">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="userpassword" required="true">
                </div>
                <input type="submit" class="btn btn-primary" name="login" value="Sign IN">
            </form>
            
            <a href="signup.php">Signup/Registration</a>
        </div>
        <!-- #login-form -->

        <div class="simple-page-footer">
            <p>
                <a href="signup.php">FORGOT YOUR PASSWORD ?</a>
            </p>
        </div>
        <!-- .simple-page-footer -->

    </div>
    <!-- .simple-page-wrap -->
</body>
</html>



   