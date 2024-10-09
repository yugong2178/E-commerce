
<?php

session_start();

// Define varibles and set to empty values
$addressErr = $cardErr = $cvvErr = '';
$address = $card = $cvv = '';

// check if form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // validate address
    if(empty($_POST['address']))
    {
        $addressErr = 'Address is required!';
    }

    else
    {
         $address = test_input($_POST['address']);
    }
    

    // validate card number
    if (empty($_POST['card']))
    {
        $cardErr = 'Card number is required!';
    }

    else
    {
        $card = test_input($_POST['card']);
        if(!preg_match('/^[0-9]{16}$/', $card))
        {
            $cardErr = 'Invalid card number!';
        }
    }

        // validate cvv number
        if (empty($_POST['cvv']))
        {
            $cvvErr = 'CVV is required!';
        }
    
        else
        {
            $cvv = test_input($_POST['cvv']);
            if(!preg_match('/^[0-9]{3}$/', $cvv))
            {
                $cvvErr = 'Invalid cvv number!';
            }
        }

    // Check if there is any errors
    if (empty($addressErr) && empty($cardErr) && empty($cvvErr) )
    {
        header("Location: paymentSuccessful.php");
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
<!DOCTYPE html>
<html>
<head>
    <title> Payment Form </title>
	 <?php include('include/navigation.php'); ?>
     <link rel="stylesheet" href="style/paymentstyle.css">
    <link rel="stylesheet" href="style/style.css">
	  
</head>
<body>


<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="paymentForm">
 <div>
    <div class="container">
        <h1>Confirm Your Payment</h1>
        <div class="first-row">
            <div class="card-num">
                <h3>Card Number</h3>
                <div class="input-field">
                        <input type="text" name='card' id='card' placeholder="################" value='<?php echo htmlspecialchars($card); ?>' />
                </div><span class='error'><?php echo $cardErr; ?></span>
            </div>
            <div class="cvv">
                <h3>CVV</h3>
                <div class="input-field">
                    <input type="password" name='cvv' id='cvv' placeholder="xxx" value='<?php echo htmlspecialchars($cvv); ?>' />
                </div><span class='error'><?php echo $cvvErr; ?></span>
            </div>
        </div>
        <div class="second-row">
            <div class="addressr">
                <h3>Address</h3>
                <div class="input-field">
                        <input type="text" name='address' id='address' value='<?php echo htmlspecialchars($address); ?>'>
                </div><span class='error'><?php echo $addressErr; ?></span>
            </div>
        <div class="third-row">
            <br><br>
            <h3>Expiry Date</h3>
            <div class="selection">
                <div class="date">
                    <select name="months" id="months">
                        <option value="Jan">Jan</option>
                        <option value="Feb">Feb</option>
                        <option value="Mar">Mar</option>
                        <option value="Apr">Apr</option>
                        <option value="May">May</option>
                        <option value="Jun">Jun</option>
                        <option value="Jul">Jul</option>
                        <option value="Aug">Aug</option>
                        <option value="Sep">Sep</option>
                        <option value="Oct">Oct</option>
                        <option value="Nov">Nov</option>
                        <option value="Dec">Dec</option>
                    </select>
                    <select name="years" id="years">
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
                <div class="cards">
                    <img src="img/mastercard.png" alt="">
                    <img src="img/visa.png" alt="">
                </div>
            </div>
        </div>
        <br>
        <button type='submit' name='submit' id='submit'>Confirm</button>
    </div>
</div>
</form>

</div>
</body>
   <?php include('include/footer.php'); ?>
</html>