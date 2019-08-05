
<form>
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
</form>