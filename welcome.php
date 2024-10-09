<?php
// Initialize the session
session_start();

require_once("database/config.php");

$username =$_SESSION["username"];
$email = mysqli_query($link, "SELECT email FROM users WHERE username = '$username'");
$phone = mysqli_query($link, "SELECT phone FROM users WHERE username = '$username'");

if ($email && $phone) {
    // Fetch the actual values from the query results
    $email_row = mysqli_fetch_assoc($email);
    $phone_row = mysqli_fetch_assoc($phone);

 
        $_SESSION["email"] = $email_row['email'];
        $_SESSION["phone"] = $phone_row['phone']; 
}
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
        body{ font: 14px sans-serif; }
    </style>
        </style>
    <link rel="stylesheet" href="style/style.css">
    <style>


  h9{
	  font-size: 45px;
	  text-align: center;
  }

	</style>
 <?php include('include/navigation.php'); ?>

</head>

<body>

    <div class="page-header">
        <br><br><br><br>
	<h9>&nbsp;&nbsp;Account</h9>
	<br><br>
        <h1>&nbsp;&nbsp;Username: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> </h1>
	<h1>&nbsp;&nbsp;Email: <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b> </h1>
	<h1>&nbsp;&nbsp;Phone Number: <b><?php echo htmlspecialchars($_SESSION["phone"]); ?></b></h1>
    </div>
    	
        <p>
        &nbsp;&nbsp; <a href="updateProfile.php" class="btn btn-warning">Update Your Profile</a>
       &nbsp;&nbsp;&nbsp; <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>

        <?php include('include/footer.php'); ?>
    </body>
</html>