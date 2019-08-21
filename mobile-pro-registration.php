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



if (!empty($_REQUEST['day'])){
  $day = $_REQUEST['day'];
} else {
  $day = "Monday";
}


if (!empty($_GET['month'])){
  
  if ($_GET['month'] == 'this'){
    $month = date("F");
  } else {
    $month = $_GET['month'];
  }
  $ddates = \get_date_range($day, $month);
} else {
  $ddates = \get_date_range($day);
}


////////////////////////////////////////
// If an agent is registering for a user
if (!empty($_GET['agent'])){
  if ($agent_id = get_agent($link, $_GET['agent'])){
    $_SESSION['proxy'] = $_SESSION['agent'] = $agent_id;
  }
} else if (!empty($_GET['ref'])){  // If user is referred by an agent
  if ($agent_id = get_agent($link, "", $_GET['ref'])){
    $_SESSION['agent'] = $agent_id;
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

    <style>
    body {
      padding-top: 15px;
    }
    </style>

  </head>

  <body>

    <!-- Page Content -->
    <div class="container">

          <form action="process.php" method="post" target="pay_frame">
            <div class="row">
              <strong class="text-danger pl-4">* <span class="text-dark"><?php echo $seats; ?> seat(s) available</span> in <span class="text-muted"><?php echo $ddates['my']; ?></span> for <span class="text-muted"><?php echo $day; ?></span> Classes</strong>
            </div>
            <div class="row mt-2 mb-4">
              <div class="col-6">
                <select class="form-control form-control-lg bg-muted" name="day" id="day">
                  <option value="Monday" <?php echo ($day == "Monday") ? "selected" : ""; ?>>Mondays</option>
                  <option value="Tuesday" <?php echo ($day == "Tuesday") ? "selected" : ""; ?>>Tuesdays</option>
                  <option value="Wednesday" <?php echo ($day == "Wednesday") ? "selected" : ""; ?>>Wednesdays</option>
                  <option value="Thursday" <?php echo ($day == "Thursday") ? "selected" : ""; ?>>Thurdays</option>
                  <option value="Friday" <?php echo ($day == "Friday") ? "selected" : ""; ?>>Fridays</option>
                </select>
              </div>
              <div class="col-6">
                  <select name="seats" id="seats" class="form-control form-control-lg bg-muted">
                    <?php
                    if (!empty($seats)){
                      echo "<option value=\"1\">1 Seat</option>";

                      for ($i=2; $seats >= $i; $i++){
                        echo "<option value=\"$i\">$i Seats</option>";
                      }
                    } else {
                      echo "<option>No Seats</option>";
                    }
                    ?>
                  </select>
              </div>
              
            </div>
            <div class="row">
                <div class="cal-date col-6">
                    <div><input type="checkbox" name="week1" id="week1" value="week1" class="training_check" <?php echo !empty($coupon['week1']) ? "checked" : "checked"; ?>>I'm Interested</div>
                    
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
        
                <div class="cal-details col-6">
                    <div class="text-info"><strong>Documents:</strong> Covers office documents creation and editing using Google Docs / Microsoft Word and Working with PDFs</div>
                    <ul>
                      <li>Microsoft Word</li>
                      <li>Google Docs</li>
                    </ul>
                </div>
              
              </div>
              <!-- /.row -->

              <div class="row">

                <div class="cal-date col-6">
                    <div><input type="checkbox" name="week2" id="week2" value="week2" class="training_check" <?php echo !empty($coupon['week2']) ? "checked" : "checked"; ?>>I'm Interested</div>
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
        
                <div class="cal-details col-6">
                    <div class="text-info"><strong>Spreadsheets:</strong> Explains how to use Excel and Google Sheet to work with various Spreadsheets and Charts</div>
                    <ul>
                      <li>Microsoft Excel</li>
                      <li>Google Sheets </li>
                    </ul>
                </div>
        
              </div>
              <!-- /.row -->

              <div class="row">

                <div class="cal-date col-6">
                    <div><input type="checkbox" name="week3" id="week3" value="week3" class="training_check" <?php echo !empty($coupon['week3']) ? "checked" : "checked"; ?>>I'm Interested</div>
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
        
                <div class="cal-details col-6">
                    <div class="text-info"><strong>Presentations:</strong> Discusses how to create captivating Presentations and Demos on Powerpoint and Google Slides</div>
                    <ul>
                      <li>Microsoft Powerpoint</li>
                      <li>Google Slides</li>
                    </ul>
                </div>
        
              </div>
              <!-- /.row -->

              <div class="row">

                <div class="cal-date col-6">
                    <div><input type="checkbox" name="week4" id="week4" value="week4" class="training_check" <?php echo !empty($coupon['week4']) ? "checked" : "checked"; ?>>I'm Interested</div>
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
        
                <div class="cal-details col-6">
                    <div class="text-info"><strong>Cloud Storage & Document Sharing:</strong> Focuses on how teams can work on the same documents at the same time irrespective of their current location</div>
                    <ul>
                      <li>Google Drive</li>
                      <li>DropBox</li>
                      <li>Microsoft OneBox</li>

                      <li>File Sharing</li>
                    </ul>
                </div>
        
              </div>
              <div class="row ">
                <input name="firstname" placeholder="Firstname" onblur="this.placeholder = 'Firstname'" class="form-control m-1" required="" type="text" required>
                <input name="lastname" placeholder="Lastname" onblur="this.placeholder = 'Lastname'" class="form-control m-1" required="" type="text" required>
                <input name="email" placeholder="Email" onblur="this.placeholder = 'Email'" class="form-control m-1" required="" type="email" required>
                <input name="mobile" placeholder="Telephone" onblur="this.placeholder = 'Telephone'" class="form-control m-1" required="" type="text" required>
                <button type="submit" class="btn btn-primary form-control" data-toggle="modal" data-target="#payModal">Register for Class</button>

                <input type="hidden" name="for" id="for" value="Mobile Productivity Training">
                <input type="hidden" name="pg" id="pg" value="mobile-business-training">
                <input type="hidden" name="monthYear" id="monthYear" value="<?php echo $ddates['my']; ?>">
                <input type="hidden" name="coupon" id="coupon" value="<?php echo $_SESSION['coupon']; ?>">
                
              </div>
            <!-- /.row -->
            
            
          </form>


      
    </div>
    <!-- /.container -->



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#day').change(function() { 
          var day = $(this).children("option:selected").val();
          window.location.replace("mobile-pro-registration.php?day=" + day);
        });
      });
    </script>
  </body>

</html>
