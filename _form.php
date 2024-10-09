<?php
// Define varibles and set to empty values
$nameErr = $emailErr = $phoneErr = $enquiryErr = $messageErr = '';
$name = $email = $phone = $enquiry = $message = '';

// check if form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // validate name
    if(empty($_POST['name']))
    {
        $nameErr = 'Name is required!';
    }

    else
    {
        $name = test_input($_POST['name']);
        
        // Check if name contains only letters and whitespace
        if(!preg_match('/^[a-zA-Z ]*$/', $name))
        {
            $nameErr = 'Only letters and white space allowed!';
        }
    }

    // validate email address
    if (empty($_POST['email']))
    {
        $emailErr = 'Email is required!';
    }

    else
    {
        $email = test_input($_POST['email']);
        // check if the email address is well-formed
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $emailErr = 'Invalid email format!';
        }
    }

    // validate phone number
    if (empty($_POST['phone']))
    {
        $phoneErr = 'Phone number is required!';
    }

    else
    {
        $phone = test_input($_POST['phone']);
        if(!preg_match('/^[0-9]{10}$/', $phone))
        {
            $phoneErr = 'Invalid phone number!';
        }
    }

    // validate enquiry
    if (empty($_POST['enquiry']))
    {
        $enquiryErr = 'Enquiry type is required!';
    }

    else
    {
        $enquiry = test_input($_POST['enquiry']);
    }

    // validate message (if it is filled in or not)
    if (empty($_POST['message']))
    {
        $messageErr = 'Message is required!';
    }

    else
    {
        $message = test_input($_POST['message']);
    }

    // Check if there is any errors
    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($enquiryErr) && empty($messageErr))
    {
        header("Location: thank-you.php");
        exit();
    }
}

// function to sanitise input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<h1>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="contactForm">
    <div id='nameInput'> <!--each div tag is used to print the textbox section (name field, email field, phone field etc)-->
        <label for='name'>Name:</label>
        <input type='text' name='name' value='<?php echo htmlspecialchars($name); ?>'> <!--htmlspecialchars is to convert some predefined characters to HTML entities-->
        <span class='error'><?php echo $nameErr; ?></span>
    </div>
<br>
    <div id='emailInput'>
        <label for='email'>Email:</label>
        <input type='text' name='email' id='email' value='<?php echo htmlspecialchars($email); ?>'>
        <span class='error'><?php echo $emailErr; ?></span> <!--span tag is an inline container used to mark up a part of a text, or a part of a document.-->
    </div>
<br>
    <div id='phoneInput'>
        <label for='phone'>Phone:</label>
        <input type='tel' name='phone' id='phone' value='<?php echo htmlspecialchars($phone); ?>'>
        <span class='error'><?php echo $phoneErr; ?></span>
    </div>
<br>
    <div id='enquiryInput'>
        <label for='enquiry'>Enquiry Type:</label>
        <select name='enquiry' id='enquiry'>
            <option value='' <?php if(empty($enquiry)) echo 'selected="selected"'; ?>>--Select Enquiry Type--</option>
            <option value='General Enquiry' <?php if($enquiry == 'General Enquiry') echo 'selected="selected"'; ?>>General Enquiry</option>
            <option value='Technical Support' <?php if($enquiry == 'Technical Support') echo 'selected="selected"'; ?>>Technical Support</option>
            <option value='Sales' <?php if($enquiry == 'Sales') echo 'selected="selected"'; ?>>Sales</option>
            <option value='Complaint' <?php if($enquiry == 'Complaint') echo 'selected="selected"'; ?>>Complaint</option>
        </select>
        <span class='error'><?php echo $enquiryErr; ?></span>
    </div>
<br>
    <div id='messageInput'>
        <label for='message'>Message:</label>
        <textarea name='message' id='message'><?php echo htmlspecialchars($message); ?></textarea>
        <span class='error'><?php echo $messageErr; ?></span>
    </div>
<br>
    <button type='submit' name='submit' id='submit' >Submit</button>
</form>
</h1>