<?php
require_once ('includes/db.php');
require_once ('includes/common.php');
require_once ('includes/process_pay.php');

use Process\verify AS confirm;


if (!empty($_GET['ref'])){
    // PAYMENT HAS BEEN INITIATED, VERIFY THE PAYMENT
    $verify_pay = new confirm($link, $_GET['ref']);

    if (!$verify_pay->confirm()){ // If payment could not be verified
        echo "Thank you. We will verify your payment and get back to you as soon as possible";
        exit();
    }
} else {
    header("HTTP/1.0 403 Forbidden");
    die("You are not allowed to access this file");
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
        <img src="images/success.gif" alt="Transfer Successful" class="img-responsive" width="100%">
    </div>
    <div>
      Your registration was successful <a href="mobile-business-training.php" class="btn btn-info" target="_top">Continue</a>
    </div>
</body>
</html>