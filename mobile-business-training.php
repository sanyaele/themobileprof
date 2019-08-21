<?php 

require_once ('includes/db.php');
require_once ('includes/common.php');
require_once ('includes/training.php');
///////////////////////////////////////
use Training\coupon AS couponClass;
use Training\getSeats AS getSeatNum;
///////////////////////////////////////
// Set Course ID
$_SESSION['course'] = 1;
///////////////////////////////////////



if (!empty($_GET['day'])){
  $day = $_GET['day'];
} else {
  $day = "Monday";
}
$ddates = \get_date_range($day);

////////////////////////////////////////
// If an agent is registering for a user
if (!empty($_GET['agent'])){
  if ($agent_id = get_agent($link, $_GET['agent'])){
    $_SESSION['proxy'] = $_SESSION['agent'] = $agent_id;
  }
} else if (!empty($_GET['ref'])){ // If user is referred by an agent
  if ($agent_id = get_agent($link, "", $_GET['ref'])){
    $_SESSION['referrer'] = $agent_id;
  }
}

////////////////////////////////////////
if (!empty($_GET['coupon'])){
  $_SESSION['coupon'] = $_GET['coupon'];
}

if (!empty($_SESSION['coupon'])){
  $discount = new couponClass($_SESSION['coupon']);
  $coupon = $discount->get_coupon($link);
}
////////////////////////////////////////
// Get number of remaining seats
$seatsClass = new getSeatNum;

$seats = maxSeats - intval($seatsClass->seats($link, $day, $ddates['my']));

// Force maximum number of seats if coupon covers less seats
if (!empty($coupon['seats']) && $seats > $coupon['seats']){
  $seats = $coupon['seats'];
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
    <meta name="author" content="Samuel Anyaele">

    <title>Mobile Business Productivity Training</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <link href='//fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" type="image/x-icon" href="assets/favicon.png">

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
    <div class="container pb-5">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Mobile Business Productivity 
        <small>Training</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="training.html">Training</a>
        </li>
        <li class="breadcrumb-item active">Mobile Business Productivity</li>
      </ol>

      <!-- Portfolio Item Row -->
      <div class="row">

        <div class="col-md-8">
          <img class="img-fluid" src="assets/website-design.png" alt="Mobile Productivity Training">

          <div class="row">
            <h2 class="ml-5">Benefits of the Course</h2>
            <ul class="hidlist">
              <li><i class="fa fa-check-square text-primary"></i>Learn how to edit Documents on your Mobile phone using Microsoft Word or Google Docs</li>
              <li><i class="fa fa-check-square text-primary"></i>
Collaborate with your Team mates on office documents from your mobile devices anywhere you are</li>
              <li><i class="fa fa-check-square text-primary"></i>Find productive use of your time in Lagos traffic</li>
              <li><i class="fa fa-check-square text-primary"></i>Be ready for business emergencies, have the tools required to respond to your customers requests immediately</li>
              <li><i class="fa fa-check-square text-primary"></i>Learn how to work with Cloud computing to make documents easy to share and backup</li>
              <li><i class="fa fa-check-square text-primary"></i>Develop and share Presentations from your phone even while on your way to the meeting</li>
              <li><i class="fa fa-check-square text-primary"></i>Master Excel and how to work with Spreadsheets from your Smartphone</li>
              <li><i class="fa fa-check-square text-primary"></i>Convert your documents to PDF on the go</li>
              <li><i class="fa fa-check-square text-primary"></i>And so many other benefits of using your Mobile phone efficiently with Cloud services</li>
            </ul>
          </div>

          <!-- Related Projects Row -->
      <h3 class="my-4" id="heading">Curriculum Calendar for <strong><?php echo $ddates['my']; ?></strong></h3>

      <form action="process.php" method="post" target="pay_frame">
        <div class="row">
          <strong class="text-danger pl-4">* <span class="text-dark"><?php echo $seats; ?> seat(s) available</span> in <span class="text-muted"><?php echo $ddates['my']; ?></span> for <span class="text-muted"><?php echo $day; ?></span> Classes</strong>
        </div>
        <div class="row mt-3 mb-5">
          <div class="col-md-6 col-sm-6">
            Select your Preferred Training Days 
            <select class="form-control form-control-lg bg-primary text-white" name="day" id="day">
              <option value="Monday" <?php echo ($day == "Monday") ? "selected" : ""; ?>>Mondays</option>
              <option value="Tuesday" <?php echo ($day == "Tuesday") ? "selected" : ""; ?>>Tuesdays</option>
              <option value="Wednesday" <?php echo ($day == "Wednesday") ? "selected" : ""; ?>>Wednesdays</option>
              <option value="Thursday" <?php echo ($day == "Thursday") ? "selected" : ""; ?>>Thurdays</option>
              <option value="Friday" <?php echo ($day == "Friday") ? "selected" : ""; ?>>Fridays</option>
            </select>
          </div>
          <div class="col-md-6 col-sm-6">
              Select how many seats you want to pay forfor
              <select name="seats" id="seats" class="form-control form-control-lg bg-primary text-white">
                <?php
                if (!empty($seats)){
                  echo "<option value=\"1\">1 Seat</option>";

                  for ($i=2; $seats >= $i; $i++){
                    echo "<option value=\"$i\">$i Seats</option>";
                  }
                }
                ?>
              </select>
          </div>
          
        </div>
        <div class="row">
          <div class="cal-date col-md-5 col-sm-6">
              <div><input type="checkbox" name="week1" id="week1" value="week1" class="training_check" <?php echo !empty($coupon['week1']) ? "checked" : ""; ?>>Week 1</div>
              
              <p><?php echo $ddates['first']; ?></p>
              <?php
                if (!empty($coupon['week1'])){
              ?>
                <div class="font-weight-bold"> <s class="text-danger">N6,250</s> <span class="text-primary">Free</span></div>
              <?php
              } else {
              ?>
                <div class="text-primary font-weight-bold">N6,250</div>

              <?php
              }
              ?>
          </div>
  
          <div class="cal-details col-md-7 col-sm-6">
              <div class="text-info">Documents:</div>
              <ul>
                <li>Microsoft Word</li>
                <li>Google Docs</li>
              </ul>
          </div>
        
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="cal-date col-md-5 col-sm-6">
              <div><input type="checkbox" name="week2" id="week2" value="week2" class="training_check" <?php echo !empty($coupon['week2']) ? "checked" : ""; ?>>Week 2</div>
              <p><?php echo $ddates['second'];?></p>
              <?php
                if (!empty($coupon['week2'])){
              ?>
                <div class="font-weight-bold"> <s class="text-danger">N6,250</s> <span class="text-primary">Free</span></div>
              <?php
              } else {
              ?>
                <div class="text-primary font-weight-bold">N6,250</div>

              <?php
              }
              ?>
          </div>
  
          <div class="cal-details col-md-7 col-sm-6">
              <div class="text-info">Spreadsheets:</div>
              <ul>
                <li>Microsoft Excel</li>
                <li>Google Sheets </li>
              </ul>
          </div>
  
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="cal-date col-md-5 col-sm-6">
              <div><input type="checkbox" name="week3" id="week3" value="week3" class="training_check" <?php echo !empty($coupon['week3']) ? "checked" : ""; ?>>Week 3</div>
              <p><?php echo $ddates['third'];?></p>
              <?php
                if (!empty($coupon['week3'])){
              ?>
                <div class="font-weight-bold"> <s class="text-danger">N6,250</s> <span class="text-primary">Free</span></div>
              <?php
              } else {
              ?>
                <div class="text-primary font-weight-bold">N6,250</div>

              <?php
              }
              ?>
          </div>
  
          <div class="cal-details col-md-7 col-sm-6">
              <div class="text-info">Presentations:</div>
              <ul>
                <li>Microsoft Powerpoint</li>
                <li>Google Slides</li>
              </ul>
          </div>
  
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="cal-date col-md-5 col-sm-6">
              <div><input type="checkbox" name="week4" id="week4" value="week4" class="training_check" <?php echo !empty($coupon['week4']) ? "checked" : ""; ?>>Week 4</div>
              <p><?php echo $ddates['fourth'];?></p>
              <?php
                if (!empty($coupon['week4'])){
              ?>
                <div class="font-weight-bold"> <s class="text-danger">N6,250</s> <span class="text-primary">Free</span></div>
              <?php
              } else {
              ?>
                <div class="text-primary font-weight-bold">N6,250</div>

              <?php
              }
              ?>
          </div>
  
          <div class="cal-details col-md-7 col-sm-6">
              <div class="text-info">Cloud Storage, File Transfer and PDFs:</div>
              <ul>
                <li>Cloud: Google Drive Collaboration</li>
                <li>Cloud: DropBox</li>
                <li>Cloud: Microsoft OneBox</li>

                <li>File Transfer: Xender and OTP Flash</li>
                <li>PDF: Foxit</li>
              </ul>
          </div>
  
        </div>
        <div class="row">
          <div class="col-md-5 col-sm-6">
            <div class="form-group">
                <input name="firstname" placeholder="Firstname" onblur="this.placeholder = 'Firstname'" class="form-control" required="" type="text" required>
            </div>
            <div class="form-group">
                <input name="lastname" placeholder="Lastname" onblur="this.placeholder = 'Lastname'" class="form-control" required="" type="text" required>
            </div>
            <div class="form-group">
                <input name="email" placeholder="Email" onblur="this.placeholder = 'Email'" class="form-control" required="" type="email" required>
            </div>
            <div class="form-group">
                <input name="mobile" placeholder="Telephone" onblur="this.placeholder = 'Telephone'" class="form-control" required="" type="text" required>
            </div>  
            <div class="form-group">
              <input type="hidden" name="for" id="for" value="Mobile Productivity Training">
              <input type="hidden" name="pg" id="pg" value="mobile-business-training">
              <input type="hidden" name="monthYear" id="monthYear" value="<?php echo $ddates['my']; ?>">
              <input type="hidden" name="coupon" id="coupon" value="<?php echo $_SESSION['coupon']; ?>">
              <button type="submit" class="btn btn-primary form-control" data-toggle="modal" data-target="#payModal">Register for Class</button>
            </div>
            
          </div>
        
        </div>
        
        <!-- /.row -->
      </form>

        </div>

        <div class="col-md-4">
          <h3 class="my-3">Intensive Business Productivity Training</h3>
          <p>The mobile Productivity Tool for businesses is a business Tech training program offered by SEONigeria.com that enables workers to be more productive by combining the flexibility of their mobile devices with the power of Cloud Computing. This increases work efficiency and reduces man hour wastes to the barest minimums, and ensures that work progresses whether project team members are in the office or on the Go.</p>
          <div class="card">
            <h3 class="card-header">Training Details</h3>
            <div class="card-body">
              <div class="display-3 text-dark">N25,000</div>
              <del class="display-4 text-muted">N40,000</del>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">3 Thorborn Avenue, Sabo, Yaba</li>
              <li class="list-group-item">Fee covers Training, Training materials and Certificate of Completion</li>
              <!-- <li class="list-group-item"> -->
                  <!-- <iframe src="pay_training.html" frameborder="0" width="100%" height="500" name="payframe"></iframe> -->
                <!-- <a href="https://rave.flutterwave.com/pay/seonigeria-business-training-discount" class="btn btn-primary">Grab 20% Discount on First 10 Seats!</a> -->
              <!-- </li> -->
            </ul>
          </div>
          <div class="card mt-3 stories">
            <img src="images/presentation.jpeg" alt="Office Presentation" class="img-fluid">
            <div class="card-body">
              <p> Mabel is heading to a meeting with two of her colleagues, this Prospect had been referred to them by their biggest Client. The light rain was pattering on her side of the car window, as the Uber cab they are riding slowly makes its way through a slightly flooded street in a section of Lekki with a few portholes littered throughout the length of the street. Why the construction crew has not finished repairing this road beats Mabel, they have been stuck on “repairing” this road since beginning of the year, now the rainy season is here, who knows how much longer this was going to take?
              </p> <p>
              “Juliet, did you copy the Powerpoint presentation from the computer?” Mabel asks.
              </p> <p>
              Juliet who was sitting on the passenger side beside the driver abruptly turns to look at Mabel with an enquiring look on her face, as she responds “I thought you already copied it”.
              </p> <p>
              “What?!” Mabel glared at Juliet “How could you have forgotten to copy the presentation? Something we developed on your desktop?” Mabel screamed, “What do we do now? If we head back to the office, we will definitely be late for the meeting, yet we cannot enter that meeting without a presentation”
              </p> <p>
              “I have the figures we used in the presentation stored on my Google Drive, it syncs on this phone too” Ada chips in, joining the conversation. The other two colleagues looked at her, suddenly realising that all is not lost … yet! Quickly whipping out her phone from her leather hand bag, Mabel opens up the Microsoft Powerpoint App, scrolls through the theme options, selects one with a beautiful blue rich background, and starts creating a new presentation. “Ada please send me the figures, thank you”, still glaring at Juliet “Send me the new logo, and while you’re at it, go to pexels.com and look for appropriate free pictures I’ll include in this slide, and please be snappy about it”
              </p> <p>
              “You’re such a nice man, thanks for giving us 5 more minutes in your car to finish our presentation. I’ll definitely rate you 5 stars”, Mabel waves slightly at the smiling Uber driver as he makes his way out of the close. The rain has stopped momentarily, but the clouds still look heavy, maybe it will rain again, who knows? …
              </p> <p>
              #MobileBusinessProductivity</p>
            </div>
          </div>


          <div class="card mt-3 stories">
            <img src="images/man-on-computer.jpeg" alt="Working on Computer" class="img-fluid">
            <div class="card-body">
              <p>
              It’s 5.04pm on Friday, everyone is rearing to leave the office to begin their TGIF, suddenly a client calls asking for the proposal for an urgent job. The other two staffs needed to work on the proposal are already out of the office, so Eze quickly creates a rough draft of the proposal on his Microsoft Word document on his office Laptop and stores it in Dropbox, he notifies his colleagues of the saved document, and they connect to Dropbox on their mobile phones, and edited sections of the proposal using the Microsoft Word App. 
              </p> <p>
              By 8pm, they are done with their editing and Eze reviews the documents and sends it to the client, eventually shutting the office door behind him by 8.15pm as he too heads home.
              </p> <p>
              #MobileBusinessProductivity</p>
            </div>
          </div>
          
        </div>

      </div>
      <!-- /.row -->

      
    </div>
    <!-- /.container -->

    <!-- Pay Modal-->
    <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="payModalLabel">Pay for Training</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          <iframe src="" name="pay_frame" frameborder="0"></iframe>
          </div>
          
        </div>
      </div>
    </div>

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
    <script>
      $(document).ready(function(){
        $('#day').change(function() { 
          var day = $(this).children("option:selected").val();
          window.location.replace("mobile-business-training.php?day=" + day + "#heading");
        });
      });
    </script>
  </body>

</html>
