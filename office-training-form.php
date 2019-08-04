<form action="process.php" method="post" target="pay_frame">
        <div class="row">
          <strong class="text-danger pl-4">* <span class="text-dark">10 seat(s) available</span> in <span class="text-muted">September 2019</span> for <span class="text-muted">Monday</span> Classes</strong>
        </div>
        <div class="row mt-3 mb-5">
          <div class="col-md-6 col-sm-6">
            Select your Preferred Training Days 
            <select class="form-control form-control-lg bg-primary text-white" name="day" id="day">
              <option value="Monday" selected="">Mondays</option>
              <option value="Tuesday">Tuesdays</option>
              <option value="Wednesday">Wednesdays</option>
              <option value="Thursday">Thurdays</option>
              <option value="Friday">Fridays</option>
            </select>
          </div>
          <div class="col-md-6 col-sm-6">
              Select how many seats you want to pay forfor
              <select name="seats" id="seats" class="form-control form-control-lg bg-primary text-white">
                <option value="1">1 Seat</option><option value="2">2 Seats</option><option value="3">3 Seats</option><option value="4">4 Seats</option><option value="5">5 Seats</option><option value="6">6 Seats</option><option value="7">7 Seats</option><option value="8">8 Seats</option><option value="9">9 Seats</option><option value="10">10 Seats</option>              </select>
          </div>
          
        </div>
        <div class="row">
          <div class="cal-date col-md-5 col-sm-6">
              <div><input type="checkbox" name="week1" id="week1" value="week1" class="training_check">Week 1</div>
              
              <p>Monday 9th September, 2019</p>
                              <div class="text-primary font-weight-bold">N6,250</div>

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
              <div><input type="checkbox" name="week2" id="week2" value="week2" class="training_check">Week 2</div>
              <p>Monday 16th September, 2019</p>
                              <div class="text-primary font-weight-bold">N6,250</div>

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
              <div><input type="checkbox" name="week3" id="week3" value="week3" class="training_check">Week 3</div>
              <p>Monday 23rd September, 2019</p>
                              <div class="text-primary font-weight-bold">N6,250</div>

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
              <div><input type="checkbox" name="week4" id="week4" value="week4" class="training_check">Week 4</div>
              <p>Monday 30th September, 2019</p>
                              <div class="text-primary font-weight-bold">N6,250</div>

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
                <input name="firstname" placeholder="Firstname" onblur="this.placeholder = 'Firstname'" class="form-control" required="" type="text">
            </div>
            <div class="form-group">
                <input name="lastname" placeholder="Lastname" onblur="this.placeholder = 'Lastname'" class="form-control" required="" type="text">
            </div>
            <div class="form-group">
                <input name="email" placeholder="Email" onblur="this.placeholder = 'Email'" class="form-control" required="" type="email">
            </div>
            <div class="form-group">
                <input name="mobile" placeholder="Telephone" onblur="this.placeholder = 'Telephone'" class="form-control" required="" type="text">
            </div>  
            <div class="form-group">
              <input type="hidden" name="for" id="for" value="Mobile Productivity Training">
              <input type="hidden" name="pg" id="pg" value="mobile-business-training">
              <input type="hidden" name="monthYear" id="monthYear" value="September 2019">
              <input type="hidden" name="coupon" id="coupon" value="">
              <button type="submit" class="btn btn-primary form-control" data-toggle="modal" data-target="#payModal">Register for Class</button>
            </div>
            
          </div>
        
        </div>
        
        <!-- /.row -->
      </form>