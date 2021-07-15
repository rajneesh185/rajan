<div class="row">

<div class="col-md-6 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-sliders"></i> User Roles <small>modules</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
          
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

      <!-- start accordion -->
      <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
      <form method="post" action="<?php echo base_url();?>home/save_user_roles/<?php echo $id;?>">
        <?php 
        if($user_roles){
          foreach ($user_roles as $rs) {
            $arr_user_roles[$rs->sub_menu_id]=1;
        }}

        if($department){
          foreach ($department as $rs) { 
            $arr_department[$rs->id] = $rs->title;
        }}

        if($designation){
          foreach ($designation as $rs) { 
            $arr_designation[$rs->id] = $rs->title; 
        }}

        if($main_menu){
          foreach ($main_menu as $rs) { ?>
        <div class="panel">
          <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion<?php echo $rs->id?>" href="#collapseOne<?php echo $rs->id?>" aria-expanded="true" aria-controls="collapseOne">
            <h4 class="panel-title"><?php echo $rs->title?></h4>
          </a>
          <div id="collapseOne<?php echo $rs->id?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <?php 
                    if($sub_menu){
                    foreach ($sub_menu as $rs_sub) {
                      if($rs_sub->main_menu_id==$rs->id){
                    ?>
                  <div class="">
                  <label>
                    <input type="checkbox" name="user_role<?php echo $rs_sub->id;?>" value="<?php echo $rs->id;?>" class="js-switch" <?php if(isset($arr_user_roles[$rs_sub->id]) && $arr_user_roles[$rs_sub->id]){echo 'checked';}?> /> <?php echo $rs_sub->title;?>
                  </label>
                  </div>
                <?php }}}?>
            </div>
          </div>
        </div>
        <?php }}?> 
      
      </div>
      <!-- end of accordion -->

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success">Update</button>
            </div>
          </div>
      

    </div>
    </form>
  </div>
</div>


<div class="col-md-6 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-user"></i> <?php echo $employee->first_name.' '.$employee->last_name;?> <small>account</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>   
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
          <img class="img-responsive avatar-view" src="<?php echo base_url();?>assets/images/img.png" alt="Avatar" title="Change the avatar">
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <ul class="list-unstyled user_data">
            <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $employee->address;?>
            </li>

            <li>
              <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $arr_department[$employee->department_id];?>
            </li>

            <li>
              <i class="fa fa-star user-profile-icon"></i> <?php echo $arr_designation[$employee->designation_id];?>
            </li>

            <li class="m-top-xs">
              <i class="fa fa-google-plus user-profile-icon"></i> <?php echo $employee->email_address;?>
               
            </li>
          </ul>

        </div>
    </div>
  </div>
  
</div>
<div class="col-md-6 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Activities <small>Sessions</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
         
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="dashboard-widget-content">

        <ul class="list-unstyled timeline widget">
          
        <?php 
        if($audit_trail){
          foreach ($audit_trail as $rs) { 
        ?>
          <li>
            <div class="block">
              <div class="block_content">
                <h2 class="title">
                                  <a><?php echo $rs->module;?></a>
                              </h2>
                <div class="byline">
                  <span><?php echo date(datetimeformatc,strtotime($rs->dc));?></span> <!--by <a>Jane Smith</a>-->
                </div>
                <p class="excerpt"><?php echo $rs->description;?><!--<a>Read&nbsp;More</a>-->
                </p>
              </div>
            </div>
          </li> 
        <?php }}?>   
        </ul>
      </div>
    </div>
  </div>
</div>
</div>