<?php
require_once ('includes/db.php');
require_once ('includes/common.php');
require_once ('includes/process_pay.php');

use Process\process AS initiate;

// If form was not submitted
if (empty($_POST['for'])){
    if (isset($_SESSION['ref'])){
        unset ($_SESSION['ref']);
    }
    
    header("HTTP/1.0 403 Forbidden");
    die("You are not allowed to access this file");
}


// FORM HAS BEEN SUBMITTED, BUT PAYMENT HAS NOT BEEN INITIATED
$make_pay = new initiate($link);

$_SESSION['ref'] = $make_pay->ref; //Store ref number in session

try {
    // Process Paystack payment if amount is more than 0
    if ($make_pay->amount > 0){
        $destination = $make_pay->process_pay();
    }
} catch (\Throwable $th) {
    //throw $th;
    echo "Error: ".$th;
    exit();
} finally {
    
    // Proceed to payment, if amount is more than zero
    if ($make_pay->amount > 0){
        if (!$make_pay->add_db($link)){ // Add to DB
            echo "There is already a similar registration with this coupon code. Kindly try without a coupon or send us a mail at contact@seonigeria.com for further enquiries. Thank you.";
            exit();
        }

        // If it is not an agent, filling this form
        if (empty($_SESSION['proxy'])){
            header ("Location: ".$destination); // Redirect user to payment
        }
        // ELse, proceed to page below to view and send user payment information
        
        
    } else { // If the course is free
        $make_pay->add_db($link, "`status` = 'paid',"); 
        //echo "Seen";
        $make_pay->send_payment_email();

    }
}

// Only proceed beyond here when payment is confirmed or amount is 0
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-7718160-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-7718160-1');
    </script>    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank you</title>
</head>
<body>
    <div>
        <?php
        if (!empty($destination)){
            echo "Payment Link: <strong>".$destination."</strong>";
        } elseif ($make_pay->amount == 0) {
            echo '
            <div>
                <img src="images/success.gif" alt="Registration Successful" class="img-responsive" width="100%">
            </div>
            <div>
              Your Free registration was successful <a href="mobile-business-training.php" class="btn btn-info" target="_top">Continue</a>
            </div>';
        } else {
            echo "seen";
        }
        ?>
    </div>
</body>
</html>