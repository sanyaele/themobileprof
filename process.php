<?php
require_once ('includes/db.php');
require_once ('includes/common.php');
require_once ('includes/process_pay.php');

use Process\process AS initiate;
use Process\verify AS confirm;

if (empty($_SESSION['ref'])){
    // FORM HAS BEEN SUBMITTED, BUT PAYMENT HAS NOT BEEN INITIATED
    $make_pay = new initiate;

    try {
        // Process Paystack payment if amount is more than 0
        if (!empty($make_pay->amount)){
            $destination = $make_pay->process_pay();
            $paid = "";
        } else {
            $paid = "`status` = 'paid',";
        }
        
    } catch (\Throwable $th) {
        //throw $th;
        echo "Error: ".$th;
        exit();
    } finally {
        // Add to database
        $make_pay->add_db($link, $paid); 

        // Proceed to payment, if amount is more than zero
        if (!empty($make_pay->amount)){
            // If an agent is filling this form
            if (!empty($_SESSION['agent'])){
                // Display Payment URL, and send user payment information
                echo "Payment Link: <strong>".$destination."</strong>";
                exit();
            } else {
                header ("Location: ".$destination); // Redirect user to payment
            }
            
        } else {
            unset ($_SESSION['ref']);
        }
    }


} else {
    // PAYMENT HAS BEEN INITIATED, VERIFY THE PAYMENT
    $verify_pay = new confirm;

    if (!($verify_pay->confirm())){
        echo "Thank you. We will verify your payment and get back to you as soon as possible";
        unset ($_SESSION['ref']);
        exit();
    }
    unset ($_SESSION['ref']);
}


// Only proceed beyond here when payment is confirmed or amount is 0
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank you</title>
</head>
<body>
    <div>
        <img src="images/success.gif" alt="Transfer Successful" class="img-responsive" width="100%">
    </div>
    <div>
      Your registration was successful <a href="mobile-business-training.php" class="btn btn-info" target="_top">Continue</a>
    </div>
</body>
</html>