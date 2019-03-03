<?php
require_once 'includes/db.php';
///////////////////////////////
session_start();
///////////////////////////////
$full_script = "";
foreach ($_POST as $key=>$value){
    $full_script .= "$key: $value\n\n ";
}
///////////////////////////////

function clean_for_payment(){
    $_SESSION['firstname'] = strip_tags(htmlspecialchars($_POST['firstname'],ENT_QUOTES));
    $_SESSION['lastname'] = strip_tags(htmlspecialchars($_POST['lastname'],ENT_QUOTES));
    $_SESSION['email'] = strip_tags(htmlspecialchars ($_POST['email'],ENT_QUOTES));
    $_SESSION['mobile'] = strip_tags(htmlspecialchars ($_POST['mobile'],ENT_QUOTES));
    $_SESSION['for'] = strip_tags(htmlspecialchars($_POST['for']));

    $_SESSION['amount'] = strip_tags(htmlspecialchars($_POST['amount']));
    
    // Create Transaction Reference
    if ($_POST['pg'] == 'pay_training'){
        $_SESSION['txref'] = "Business-Training-".rand(1000,9999);
    } elseif ($_POST['pg'] == 'pay_payment') {
        $_SESSION['txref'] = "Payment-".rand(1000,9999);
    } else {
        $_SESSION['txref'] = "Webpay-".rand(1000,9999);
    }
    
    
    return TRUE;   
}


function send_email ($full_script){
    // Create the email and send the message
    
    $to = 'contact@seonigeria.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $email_subject = "Payment for  ".$_SESSION['for'];
    $email_body = "Someone just sent payment for ".$_SESSION['for']."\n\n".
    "Here are the details:\n\n 
    Name: $_SESSION[firstname] $_SESSION[lastname] \n\n 
    Email: $_SESSION[email]\n\n 
    Phone: $_SESSION[mobile]\n\n 
    Amount: $_SESSION[amount]\n\n 
    Full POST: \n
        $full_script\n\n
    Transaction Reference: $_SESSION[txref]\n\n 
    Kindly reach out to the client to discuss further";
    $headers = "From: noreply@seonigeria.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    $headers .= "Reply-To: $_SESSION[email]";   
    
    if (mail($to,$email_subject,$email_body,$headers)){
        $cont['head'] = "Application Received";
        if ($_SESSION['for'] == "Domain name"){
            $cont['body'] = "We have received your application, kindly click on <strong>Pay Now</strong> to pay for your domain name (".$_POST['domain']."), we will purchase it within 24 working hours. And a Project manager will be assigned to your account, who will call you on $_SESSION[mobile], to collect the materials to commence work on your website and give you details on how to proceed";
        } else {
            $cont['body'] = "We have received your application, and a Team member will call you within 24 hours to commence integration. <br>
        Thank you.";
        }
        
    } else {
        $cont['head'] = "Error Processing Request";
        $cont['body'] = "There was an error sending this request. Kindly email or call us to notify of this error. <br>
        Thank you.";
    }

    return $cont;
}

function add_db ($link, $full_script){
    $sql = "INSERT INTO `logs` SET
    `email` = '$_SESSION[email]',
    `log` = '$full_script'";
    @mysqli_query($link, $sql);

    return TRUE;
}


if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['mobile']) && !empty($_POST['for']) && !empty($_POST['amount'])){
    clean_for_payment();

    //$mess = send_email ($full_script);
    add_db ($link, $full_script);
    // 
} else {
    if (!empty($_POST['pg'])){
        //print_r($_POST);
        header ("Location: ".$_POST['pg'].".html");
    } else {
        exit();
    }
    
}

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
    <title>Pay for  <?php echo $_SESSION['for']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
</head>

<body>

    

    <div class="container">
    <div class="row" style="height: 200px;"> 
        
    </div>

    <div class="row">    
            <h2>
                Payment for <strong> <?php echo $_SESSION['for']; ?> </strong> 
            </h2>
            <h3>Amount: <strong><?php echo number_format($_SESSION['amount'],2); ?></strong> </h3>

            <div class="col-lg-8 mt-4">
                <?php echo $mess['body']; ?>
            </div>
            
            <div class="col-lg-4 mt-4 justify-content-center">
                <form>
                    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                    <button type="button" onClick="payWithRave()" class="btn btn-danger pr-4 pl-4">Pay Now</button>
                </form>
            </div>
        </div>
        <div class="row">    
            <div class="col-lg-8 mt-4">
                Call +2348033954301 for further enquiries. <br>
                Thank you.
            </div>
        </div>
    </div>
    <script>
        const API_publicKey = "FLWPUBK-65d3d4cb47bdfc74aa58e7b6c1bfe2b3-X"; //FLWPUBK-65d3d4cb47bdfc74aa58e7b6c1bfe2b3-X

        function payWithRave() {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "<?php echo $_SESSION['email']; ?>",
                amount: <?php echo $_SESSION['amount']; ?>,
                customer_phone: "<?php echo $_SESSION['mobile']; ?>",
                currency: "NGN",
                payment_method: "both",
                txref: "<?php echo $_SESSION['txref'];?>",
                meta: [{
                    metaname: "Mobile Number",
                    metavalue: "<?php echo $_SESSION['mobile']; ?>"
                }],
                onclose: function() {},
                callback: function(response) {
                    var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
                    console.log("This is the response returned after a charge", response);
                    if (
                        response.tx.chargeResponseCode == "00" ||
                        response.tx.chargeResponseCode == "0"
                    ) {
                        // redirect to a success page
                    } else {
                        // redirect to a failure page.
                    }

                    x.close(); // use this to close the modal immediately after payment.
                }
            });
        }
    </script>
</body>
</html>
