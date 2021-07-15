<div class="col-md-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Home <small>Change Password</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
          
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <form method="post" action="<?php echo base_url();?>home/save_new_password" class="form-horizontal form-label-left input_mask" data-toggle="validator">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Current Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" id="current_password" name="current_password" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
           
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" id="new_password" name="new_password" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirm Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" id="confirm_password" name="confirm_password" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
 
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </div>
         
 
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
  $(".js-example-basic-single").select2();
});
</script>