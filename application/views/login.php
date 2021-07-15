<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/uploaded_files/company_files/favicon.png" />

    <title>Brick Build System | Portal</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/themes/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://colorlib.com/polygon/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/themes/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>assets/themes/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/themes/build/css/custom.css" rel="stylesheet">
 

  </head>

  <body class="login">

   
    <div> 



      <div class="login_wrapper">
        <div class="animate form login_form"> 

         <div id="notif_fade" class="col-md-12">
		<?php if(isset($_SESSION["error"])){echo '<div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
		<?php if(isset($_SESSION["success"])){echo '<div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
		<?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
		</div>
    <center>
		<img class="img_logo" src="<?php echo base_url('assets/uploaded_files/company_files/'.$company_info->company_logo);?>" style="max-height: 150px;" />
</center>
          <section class="login_content">

            <?php if($reset_password==1){?>

              <form method="post" action="<?php echo base_url();?>Index/reset_password/<?php echo $key;?>" data-toggle="validator">
                <h1>Reset Password</h1>
                <div>
                  <input type="password" name="password1" class="form-control" placeholder="New Password" required="required" />
                </div>
                <div>
                  <input type="password" name="password2" class="form-control" placeholder="Re-Type New Password" required="required" />
                </div>
                <div>
                  <button type="submit" class="btn btn-default submit">Reset</button>
                   
                </div>

                <div class="clearfix"></div>

                <div class="separator">

                  <div class="clearfix"></div>
                  <br />

                  <div>
                    <p>©2020 All Rights Reserved. </p>
                  </div>
                </div>
              </form>

            <?php }else{?>

              <form method="post" action="<?php echo base_url();?>Index/validate_login" data-toggle="validator">
                <h1>Login</h1>
                <div>
                  <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                  <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                  <button type="submit" class="btn btn-default submit">Login</button>
                  <a class="reset_pass"  href="#" class="load_modal_details" data-toggle="modal" data-target=".bs-example-modal-lg">Forgot password?</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">

                  <div class="clearfix"></div>
                  <br />

                  <div>
                    <p>©2020 All Rights Reserved. View Brick Build System Privacy and Terms</p>
                  </div>
                </div>
              </form>

            <?php }?>

          </section>
        </div>

        <div class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <style>
               .datepicker{z-index:1151 !important;}
               </style>
               <div class="row">
                 <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="x_panel">
                     <div class="x_title">
                       <h2>Forgot Password <small>recover using email</small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                          
                          
                         <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
                         </li>
                       </ul>
                       <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                       <br />
                       <form method="post" id="frm_validation" action="<?php echo base_url();?>index/send_reset_password" data-toggle="validator" class="form-horizontal form-label-left">
                
                   
                         <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email  <span class="required">*</span>
                           </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="email" id="email" name="email" class="form-control col-md-7 col-xs-12" required="required">
                           </div>
                         </div>
 

                         <div class="ln_solid"></div>
                         <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button> 
                             <button type="submit" class="btn btn-success">Send Reset Password</button>
                           </div>
                         </div>

                       </form>
                     </div>
                   </div>
                 </div>
               </div>  

            </div>
          </div>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-h-square"></i> <?php echo system_name;?></h1>
                  <p>©2016 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/themes/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/themes/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/validator/bootstrap-validator.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      $("#notif_fade").fadeOut(10000); 
    });
</script>
