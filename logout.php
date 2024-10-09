<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <link rel="stylesheet" href="style/style.css">
    <style>
  h5{
	font-size : 17px;
    }
  h6{
	 font-size: 20px;
	
  }
  h7{
	 font-size: 30px;
	 text-decoration-line: underline;
	
  }

  h9{
		  font-size: 45px;
}
  h10{
	  font-size: 30px;
  text-decoration-line: underline;
  }
  
h11{
	 
  text-decoration-line: underline;
  }
    </style>
	 <?php include('include/navigation.php'); ?>

</head>
<body>
<br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<h9><center>Are you sure you want to log out ?</center></h9>
<br>
 	<a href="yesLogOut.php" class="btn btn-warning"><h5>Yes</h5></a>
        &nbsp;&nbsp;&nbsp;<a href="noLogout.php" class="btn btn-danger"><h5>No</h5></a>
        <?php include('include/footer.php'); ?>
</body>

</html>
