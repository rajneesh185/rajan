<?php
$key = $this->config->item('openssl_key');
function en($data,$key){
    $Openssl_security = new Openssl_security;
    return $Openssl_security->e($data, $key); 
}

if($system_user->allow_login==1){
$allow_login = 0;
}else{
$allow_login = 1;
}
  
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>System Users <small>Activate/Deactivate Users</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>home/update_system_user_status/<?php echo en($system_user->id,$this->config->item('openssl_key'),$allow_login);?>/<?php echo $allow_login;  ?>" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

          
          
          
          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Are you sure want to<?php if($system_user->allow_login==0){?>
               Activate
              <?php }else{?>
                Deactivate
              <?php }?>   
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12"></div>
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

