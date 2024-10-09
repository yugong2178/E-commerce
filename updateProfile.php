<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "database/config.php";
 
// Define variables and initialize with empty values
$new_username = $new_email = $new_phone = $new_password = $confirm_password = "";
$new_username_err = $new_email_err = $new_phone_err = $new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Validate username
    if(empty(trim($_POST["new_username"]))){
        $new_username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_new_username = trim($_POST["new_username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $new_username_err = "This username is already taken.";
                } else{
                    $new_username = trim($_POST["new_username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }


    // validate email address   
    if (empty(trim($_POST['new_email'])))
    {
        $new_email_err = 'Email is required!';
    } else{
        $new_email = trim($_POST['new_email']);
        // check if the email address is well-formed
        if(!filter_var($new_email, FILTER_VALIDATE_EMAIL))
        {
            $new_email_err = 'Invalid email format!';
        }
    }

     //validate phoneNumber
     if (empty(trim($_POST['new_phone'])))
    {
        $new__phone_err = 'Phone number is required!';
    }else{
        $new_phone = trim($_POST['new_phone']);
        if(!preg_match('/^[0-9]{10}$/', $new_phone))
        {
            $new_phone_err = 'Invalid phone number!';
        }
    }


        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET username = ?, email = ?, phone = ?, password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_new_username, $param_new_email, $param_new_phone, $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
	    $param_new_email = $new_email;
	    $param_new_username = $new_username;
	    $param_new_phone = $new_phone;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Profile updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
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
<br><br>
    <div class="wrapper">
        <br><br><br><br>
        <h9>Update Profile</h9>
	<br><br>
        <h5><p>Please fill out this form to update your profile.</p></h5>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
	    <h6><div class="form-group <?php echo (!empty($new_username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label><br>
                <input type="text" name="new_username" class="form-control" value="<?php echo $new_username; ?>">
                <span class="help-block"><?php echo $new_username_err; ?></span>
            </div>
	    </h6>  
	    <h6><div class="form-group <?php echo (!empty($new_email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label><br>
                <input type="text" name="new_email" class="form-control" value="<?php echo $new_email; ?>">
                <span class="help-block"><?php echo $new_email_err; ?></span>
            </div>   
	    </h6>
	    <h6><div class="form-group <?php echo (!empty($new_phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone Number</label><br>
                <input type="text" name="new_phone" class="form-control" value="<?php echo $new_phone; ?>">
                <span class="help-block"><?php echo $new_phone_err; ?></span>
            </div>   
	    </h6>  
            <h6><div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label><br>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
	    </h6>
            <h6><div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label><br>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
	    </h6>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>   
    <?php include('include/footer.php'); ?> 
</body>
</html>