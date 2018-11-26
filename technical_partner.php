<?php
function process_form(){
    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email_address = strip_tags(htmlspecialchars($_POST['email']));
    $phone = strip_tags(htmlspecialchars($_POST['phone']));
    $business = strip_tags(htmlspecialchars($_POST['business']));
    $website = strip_tags(htmlspecialchars($_POST['website']));
    $products_services = strip_tags(htmlspecialchars($_POST['products_services']));
    $positive = strip_tags(htmlspecialchars($_POST['positive']));
    
    // Create the email and send the message
    $to = 'contact@seonigeria.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $email_subject = "Application as Technical Partner:  $business";
    $email_body = "Someone just sent you a request for Technical Partnership.\n\n"."Here are the details:\n\n Name: $name\n\n Email: $email_address\n\n Phone: $phone\n\n business:\n$message\n\n website: $name\n\n Products/Services: $email_address\n\n Would your business work with Online Payments?: $positive";
    $headers = "From: noreply@seonigeria.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    $headers .= "Reply-To: $email_address";   
    
    if (mail($to,$email_subject,$email_body,$headers)){
        $cont['head'] = "Application Received";
        $cont['body'] = "We have received your application, and the development team will be reviewing it. We will get back to you as soon as possible on $email_address or $phone. <br>
        Thank you";
    } else {
        $cont['head'] = "Error Processing Request";
        $cont['body'] = "There was an error sending this request. Kindly email or call us to notify of this error. <br>
        Thank you.";
    }


    


    return $cont;   
}

$process = FALSE;
// Check for empty fields

if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['business'])      ||
   empty($_POST['website'])     ||
   empty($_POST['products_services'])     ||
   empty($_POST['positive'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
        $cont['head'] = "Incomplete Application";
        $cont['body'] = "You are required to fill out all the fields in the application form. Kindly, complete your application and try again. <br>
        Thank you.";
        $process = FALSE;
   } else {
       $cont = process_form();
       $process = TRUE;
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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
    if (!$process){
    ?>
        <meta http-equiv="refresh" content="5; url=index.html">
    <?php
    }
    ?>

    <title>About SEO Nigeria and GoldenSteps Enterprises</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <link href='//fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">SEONigeria.com</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="website-design-nigeria.html">Website Design</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search-engine-optimization-nigeria.html">Search Engine Optimization</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="training.html">Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Technical Partnership
      </h1>


      <!-- Intro Content -->
      <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="assets/partnership.jpeg" alt="Partnership">
        </div>
        <div class="col-lg-6">
          <h2><?php echo $cont['head'];?></h2>
          <p><?php echo $cont['body'];?></p>
          
        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; SEONigeria.com 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
