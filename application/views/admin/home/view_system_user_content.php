<?php
$key = $this->config->item('openssl_key');
function en($data,$key){
    $Openssl_security = new Openssl_security;
    return $Openssl_security->e($data, $key); 
}  
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2><?php 
                  if($user_category){
                    foreach($user_category as $rs){  if($rs->id == $system_user->user_category){ echo $rs->title;}    }}?> Profile <small>information</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>home/update_system_user/<?php echo en($system_user->id,$this->config->item('openssl_key'));?>" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Avatar
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <img src="<?php if($system_user->avatar){  echo base_url();?>assets/uploaded_files/user/<?php echo $system_user->avatar;  }else{  echo base_url();?>assets/images/img.png<?php }?>" class="img-responsive avatar-view" alt="Avatar">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Name  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly="readonly" type="text" id="name" name="name" value="<?php echo $system_user->name;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Email  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly="readonly" type="text" id="email" name="email" value="<?php echo $system_user->email;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Contact Number  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly="readonly" type="text" id="contact_no" name="contact_no" value="<?php echo $system_user->contact_no;?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Address  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly="readonly" type="text" id="address" name="address" value="<?php echo $system_user->address;?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

           
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>  
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 

