<div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mb-5">
          <?php
          if((!isset($_GET['service']) || $_GET['service'] == "developers") || ($_GET['service'] != "developers" && $_GET['service'] != "business" )) {

           $courseTitle = "Code on Smartphones";
           $courseDiscuss = array("<p>You will get to know  all the neccesary apps, and how to configure them properly for a seemless web app development , in a mobile enviroment.</p>","<p>You will get to build a funtional web app, and deploy it, all from your smart phone, with guidiance from our learning facilitators and videos</p>");
           $images = array("mobile-phone.jpg","keyboard.png");
          }else if($_GET['service'] == "business"){
            $courseTitle = "Mobile Business Productivity Tools";
           $courseDiscuss = array('<div class="card-body">
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
         </div>','<div class="card-body">
         <p>
         It’s 5.04pm on Friday, everyone is rearing to leave the office to begin their TGIF, suddenly a client calls asking for the proposal for an urgent job. The other two staffs needed to work on the proposal are already out of the office, so Eze quickly creates a rough draft of the proposal on his Microsoft Word document on his office Laptop and stores it in Dropbox, he notifies his colleagues of the saved document, and they connect to Dropbox on their mobile phones, and edited sections of the proposal using the Microsoft Word App. 
         </p> <p>
         By 8pm, they are done with their editing and Eze reviews the documents and sends it to the client, eventually shutting the office door behind him by 8.15pm as he too heads home.
         </p> <p>
         #MobileBusinessProductivity</p>
       </div>');
           $images = array("presentation.jpeg","man-on-computer.jpeg");
          }
            ?>
            <div class="mb-5">
              <h3 class="text-black"><?php echo $courseTitle; ?> </h3>
              <p class="mb-4">
                <strong class="text-black mr-3">Schedule: </strong> MWF 9:30 - 11:00
              </p>
              <?php echo $courseDiscuss[0]; ?>
              <div class="row mb-4">
                <div class="col-md-6">
                  <img src="images/<?php echo $images[0]; ?>" alt="Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                  <img src="images/<?php echo $images[1]; ?>" alt="Image" class="img-fluid rounded">
                </div>
              </div>
              <?php echo $courseDiscuss[1]; ?>
              <p class="mt-4"><a href="#" class="btn btn-primary">Enroll</a></p>
            </div>

            <div class="pt-5">
            <h3 class="mb-5">Register For Class</h3>
            <?php
            if((!isset($_GET['service']) || $_GET['service'] == "developers") || ($_GET['service'] != "developers" && $_GET['service'] != "business" )) 
            include"mobile-dev-form.php";
            else if($_GET['service'] == "business")
            include"office-training-form.php"; 
            ?>

            </div>



          </div>
          <div class="col-lg-4 pl-lg-5">

<div class="mb-5 text-center border rounded course-instructor">
  <h3 class="mb-5 text-black text-uppercase h6 border-bottom pb-3">Instructor</h3>
  <div class="mb-4 text-center">
    <img src="images/ayaele.jpg" alt="Image" class="w-25 rounded-circle mb-4">  
    <h3 class="h5 text-black mb-4">Samuel Ayaele</h3>
    <p>Lorem ipsum dolor sit amet sectetur adipisicing elit. Ipsa porro expedita libero pariatur vero eos.</p>
  </div>
</div>
<?php 
if(isset($_GET['service']) && ($_GET['service'] == "developers" || $_GET['service'] == "business")){
?>
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
<?php } ?>

</div>
</div>
</div>
</div>
