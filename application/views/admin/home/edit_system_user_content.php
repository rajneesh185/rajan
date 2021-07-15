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
        <h2>System Users <small>Create New System Users</small></h2>
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="cat" name="cat" required="required" class="form-control col-md-7 col-xs-12">
              <option value="">select user category</option> 
              <?php 
                  if($user_category){
                    foreach($user_category as $rs){?>
                  <option value="<?php echo $rs->id;?>" <?php if($rs->id == $system_user->user_category){ echo 'selected';}?>><?php echo $rs->title;?></option>
                  <?php }}?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="name" name="name" value="<?php echo $system_user->name;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="email" name="email" value="<?php echo $system_user->email;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Contact Number  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="contact_no" name="contact_no" value="<?php echo $system_user->contact_no;?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Address  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="address" name="address" value="<?php echo $system_user->address;?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">ABN Number <span class="required">*</span> 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="abn" name="abn" value="<?php echo $system_user->abn;?>" required="required" data-inputmask="'mask': '99 999 999 999'" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Allow Login <span class="required">*</span> 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select type="text" id="allow_login" name="allow_login" required="required" class="form-control col-md-7 col-xs-12">
                <?php if($system_user->allow_login==1){?>
                <option value="1">yes</option>
                <option value="0">no</option>
              <?php }else{?>
                <option value="0">no</option>
                <option value="1">yes</option>
              <?php }?>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Avatar
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="images" type="file" multiple="multiple" class="form-control col-md-7 col-xs-12" accept="image/*" /> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Username <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="username" name="username" value="<?php echo $system_user->un;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Set new Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password" id="new_password" name="new_password" value="" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 

