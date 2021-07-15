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
        <h2>Home <small>System Users</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <!--
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>  
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
           
          </li> 
          -->
          <li><a href="<?php echo base_url();?>home/add_system_users_content" class="load_modal_details" data-toggle="modal" data-target=".bs-example-modal-lg"  title="add new user"><i class="fa fa-plus"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          List of all user in the system.
        </p>
        <table id="datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Avatar</th>
              <th>User ID</th> 
              <th>Name</th>
              <th>Category</th>
              <th>Email</th>
              <th>Contact No.</th>
              <th>Address</th>
              <th>Allow Login</th>
              <th>Option</th>
            </tr>
          </thead>


          <tbody>
          <?php 

          if($user_category){
            foreach ($user_category as $rs) { 
              $arr_user_category[$rs->id] = $rs->title; 
          }}

          if($system_users){
          	foreach ($system_users as $rs) {   
              if($rs->super_admin != 1){
          ?>
            <tr>
              <td><img src="<?php if($rs->avatar){  echo base_url();?>assets/uploaded_files/user/<?php echo $rs->avatar;  }else{  echo base_url();?>assets/images/img.png<?php }?>" class="avatar" alt="Avatar"></td>
              <td><?php echo sprintf("%05d",$rs->id);?></td> 
              <td><?php echo $rs->name;?></td>
              <td><?php echo $arr_user_category[$rs->user_category];?></td>
              <td><?php echo $rs->email;?></td>
              <td><?php echo $rs->contact_no;?></td>
              <td><?php echo $rs->address;?></td>
              <td><?php if($rs->allow_login ==1){echo 'yes';}else{echo 'no';};?></td>
              <td>
                 <div class="btn-group  btn-group-xs">
                   <a href="<?php echo base_url();?>home/edit_system_users_content/<?php echo $e = en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-default load_modal_details" type="button">Edit</a>
				   <a href="<?php echo base_url();?>home/edit_system_users_status/<?php echo $e = en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-default load_modal_details" type="button">
				   <?php if($rs->allow_login ==1){echo 'Deactivate';}else{echo 'Activate';};?>
				   </a>
				  <a href="<?php echo base_url();?>home/edit_system_users_pass/<?php echo $e = en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-default load_modal_details" type="button">Reset Pass</a> 
                   <button class="btn btn-danger" type="button" onclick="remove_account('<?php echo $e = en($rs->id,$key);?>');">Delete</button> 
				   
                 </div>
              </td>
            </tr> 
           <?php }}}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

   
</div>
<script type="text/javascript">
function remove_account(str){
  reset(); 

  alertify.confirm("remove account?", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>home/delete_account/"+str;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>

