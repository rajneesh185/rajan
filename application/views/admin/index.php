<!DOCTYPE html>
<?php 
$module_page=NULL;
$main_module=NULL;
if(!in_array($module, array('home','settings','profile','change_password'), true ) ){list($main_module,$module_page) = explode("/",$module);}
//$this->output->enable_profiler(TRUE); ?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/uploaded_files/company_files/favicon.png" />

    <title><?php echo $company_info->company_name;?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome --> 
    <link href="<?php echo base_url();?>assets/themes/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="https://colorlib.com/polygon/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/themes/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/themes/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>assets/themes/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url();?>assets/themes/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/themes/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- alertify -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/alertify/css/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/alertify/css/alertify.bootstrap.css" id="toggleCSS" />

    <!-- P-Notify -->
    <link href="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <?php if(in_array($module_page, array('system_users','master_list','main_table','dashboard','open_invoice','close_invoice'), true ) ){?>
    <!-- Datatables -->
    <link href="<?php echo base_url();?>assets/themes/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <?php }?>

    <!-- Switchery -->
    <link href="<?php echo base_url();?>assets/themes/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- select2 -->
    <link href="<?php echo base_url();?>assets/themes/select2/select2.css" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo base_url();?>assets/themes/multi_select/multi_select.css" rel="stylesheet" type="text/css" /> 

    <!-- loading Progress -->
    <link href="<?php echo base_url();?>assets/themes/loading_progress/loading_progress.css" rel="stylesheet" type="text/css" /> 

    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url();?>assets/themes/google-code-prettify/bin/prettify.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/themes/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div id="loading_progress"></div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="Javascript:company_info();" class="site_title"><!--<i class="fa fa-graduation-cap"></i>--> <span></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="
                <?php if($avatar){?> 
                    <?php echo base_url();?>assets/uploaded_files/user/<?php echo $avatar;?> 
                <?php }else{?>
                <?php echo base_url();?>assets/images/img.png
                <?php }?>
                " alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->name_of_user;?></h2>
                <small><?php echo $this->session->user_category;?></small>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu"> 
 
                <?php  
                 

                if($main_menu){
                foreach ($main_menu as $rs) { 
                  if(
                    ($rs->admin == 1 && strtolower($this->session->user_category) == 'admin') || 
                    ($rs->other == 1 && strtolower($this->session->user_category) != 'admin')
                  ){
                ?>
                  <li><a><i class="fa <?php echo $rs->font_icon;?>"></i> <?php echo $rs->title;?> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php 
                    if($sub_menu){
                    foreach ($sub_menu as $rs_sub) {
                      if($rs_sub->main_menu_id==$rs->id){
                        if(
                          ($rs_sub->admin == 1 && strtolower($this->session->user_category) == 'admin') || 
                          ($rs_sub->other == 1 && strtolower($this->session->user_category) != 'admin') || 
                          (strpos($rs_sub->allow_user_category, strtolower($this->session->user_category)) !== false)
                        ){
                    ?>
                      <li><a href="<?php echo base_url().$rs_sub->url_link;?>"><?php echo $rs_sub->title;?></a></li> 
                    <?php }}}}?>
                    </ul>
                  </li>
                <?php }}}?> 

                </ul>
              </div>
             

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!--
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="Javascript:logout();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Settings" href="Javascript:settingsx();">
                <span class="glyphicon glyphicon-cogx" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreenx" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-closex" aria-hidden="true"></span>
              </a>
            -->
              
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="
                    <?php if($avatar){?> 
                        <?php echo base_url();?>assets/uploaded_files/user/<?php echo $avatar;?> 
                    <?php }else{?>
                    <?php echo base_url();?>assets/images/img.png
                    <?php }?>
                    " alt=""><?php echo $this->session->name_of_user;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                     
                      <li><a href="<?php echo base_url();?>home/profile"> Profile</a></li> 
                      <li><a href="<?php echo base_url();?>home/change_password"> Change Password</a></li>  
                     
                    <li><a href="Javascript:logout();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!--
                 
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>

              -->


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">
          
          <div id="notif_fade" class="col-md-11 col-sm-11 col-xs-12">  
          <?php if(isset($_SESSION["error"])){echo '<div class="clearfix"></div><div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
          <?php if(isset($_SESSION["success"])){echo '<div class="clearfix"></div><div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
          <?php echo validation_errors('<div class="clearfix"></div><div class="alert alert-danger">','</div>');?>
          </div>

            <?php  $this->view("admin/$module");  ?>

            

        </div>
        <!-- /page content -->

        
      </div>
    </div>
<!-- footer content -->
        <footer>
          <div class="pull-right">
              <?php echo system_name;?> | <?php echo $company_info->company_name;?> <!--<a href="#"><?php echo developer;?></a>--> 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    <!-- SYSTEM MODAL -->
    <div class="modal fade" id="system_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" id="load_modal_fields">
            
        </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="load_modal_fields_large">
           
        </div>
      </div>
    </div>
    <!-- /SYSTEM MODAL-->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/themes/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/themes/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/themes/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/themes/nprogress/nprogress.js"></script>
    
    <!-- gauge.js -->
    <script src="<?php echo base_url();?>assets/themes/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url();?>assets/themes/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/themes/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url();?>assets/themes/skycons/skycons.js"></script>
    <?php if(in_array($module_page, array('dashboard'),true)){ ?>
    <!-- Chart.js -->
    <script src="<?php echo base_url();?>assets/themes/Chart.js/dist/Chart.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url();?>assets/themes/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url();?>assets/themes/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url();?>assets/themes/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url();?>assets/themes/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url();?>assets/themes/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url();?>assets/themes/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url();?>assets/themes/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/flot.curvedlines/curvedLines.js"></script>
    <?php }?>
    <!-- DateJS -->
    <script src="<?php echo base_url();?>assets/themes/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url();?>assets/themes/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url();?>assets/themes/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url();?>assets/themes/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>assets/themes/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url();?>assets/alertify/js/alertify.js"></script>

    <?php if(in_array($module_page, array('system_users','master_list','main_table','dashboard','open_invoice','close_invoice'), true ) ){?>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>assets/themes/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <?php }?>

    <!-- PNotify -->
    <script src="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.nonblock.js"></script>
    
    <!-- Switchery -->
    <script src="<?php echo base_url();?>assets/themes/switchery/dist/switchery.min.js"></script>

    <!-- select2 -->
    <script src="<?php echo base_url();?>assets/themes/select2/select2.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/themes/multi_select/multi_select.js" type="text/javascript"></script>

    <?php if(in_array($module_page, array('scan_barcode_actual_count'), true )){?>
    <!-- barcode scanner --> 
    <script src="<?php echo base_url();?>assets/themes/scanner_detection/jquery.scannerdetection.compatibility.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/themes/scanner_detection/jquery.scannerdetection.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/themes/scanner_detection/scanner.js" type="text/javascript"></script>
    <?php }?>

    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url();?>assets/themes/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url();?>assets/themes/google-code-prettify/src/prettify.js"></script>

    <!-- jquery.inputmask -->
    <script src="<?php echo base_url();?>assets/themes/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/themes/build/js/custom.js"></script>
	  <script type="text/javascript"> 

     $(function(){
      // turn the element to select2 select style
      $('#asset_id').select2();
      $('#to_incharge').select2();
      $('#to_location').select2();
      $('.report_field_multiple').select2(); 
      $('.multiselect-ui').multiselect({ includeSelectAllOption: true, enableFiltering: true, enableCaseInsensitiveFiltering: true });
    });

      
    
     // toggle small or large menu 
     $MENU_TOGGLE.on('click', function() {
        console.log('clicked - menu toggle');
        
        if ($BODY.hasClass('nav-md')) {
          localStorage.setItem("menu_nav", "hide");
          $SIDEBAR_MENU.find('li.active ul').hide();
          $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
          localStorage.setItem("menu_nav", "hide");
        } else {
          localStorage.setItem("menu_nav", "show");
          $SIDEBAR_MENU.find('li.active-sm ul').show();
          $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
          localStorage.setItem("menu_nav", "show");
        }

      $BODY.toggleClass('nav-md nav-sm');

      setContentHeight();

      $('.dataTable').each ( function () { $(this).dataTable().fnDraw(); });
     }); 

     function menuToggle(){
      if ($('body').hasClass('nav-md')) {
        $("#sidebar-menu").find('li.active ul').hide();
        $("#sidebar-menu").find('li.active').addClass('active-sm').removeClass('active');
      } else {
        $("#sidebar-menu").find('li.active-sm ul').show();
        $("#sidebar-menu").find('li.active-sm').addClass('active').removeClass('active-sm');
      }
      $('body').toggleClass('nav-md nav-sm');
      setHeight();
    }

    function setHeight(){
      $('.right_col').css('min-height', $(window).height());
      var bodyHeight = $('body').outerHeight();
      var footerHeight = $('body').hasClass('footer_fixed') ? -10 : $('footer').height();
      var leftColHeight = $('.left_col').eq(1).height() + $('.sidebar-footer').height();
      var contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;
      contentHeight -= $('.nav_menu').height() + footerHeight;
      $('.right_col').css('min-height', contentHeight);

    }

    if(localStorage.getItem("menu_nav")=="hide"){
      menuToggle(); 
    } 

    function hd(){
      $('.child_menu').hide();
    }

     function reset () {
       
          alertify.set({
            labels : {
              ok     : "OK",
              cancel : "Cancel"
            },
            delay : 5000,
            buttonReverse : false,
            buttonFocus   : "ok"
          });

        }


     function logout(){ 

          reset(); 

          alertify.confirm("logout from account?", function (e) {
                if (e) {  
                    alertify.log(" <i class='fa fa-circle-o-notch fa-spin'></i> signing off...");
                    location.href = "<?php echo base_url();?>admin/logout";
                } else {
                    alertify.log("cancelled");
                }
            }, "Confirm");

       }

    function settings(){ 
      location.href = "<?php echo base_url();?>home/settings";
    }   

    $(".load_modal_details").click(function(){  
      $("#load_modal_fields_large").html(" <i class='fa fa-circle-o-notch fa-spin'></i> LOADING...");
      var href = $(this).attr('href');  
      setTimeout(function() {
      $("#load_modal_fields_large").load(href, function(){
        init_wysiwyg();
      });
      }, 1000);
    });

    function load_modal_details(controller,href_val){   
      $("#load_modal_fields_large").load("<?php echo base_url();?>fixed_asset/"+controller+"/"+href_val);
    }


    $( document ).ready(function() {
      $("#notif_fade").fadeOut(10000); 
      if(localStorage.getItem("menu_nav")=="hide"){
      hd();
      }
    });

    $( document ).ready(function() {
    $('#datatable2').DataTable({
             "bProcessing": true,
             "serverSide": true,
             "order": [],
             "ajax":{
                url :"<?php echo base_url();?>fixed_asset/master_list_data", // json datasource
                type: "post",  // type of method  ,GET/POST/DELETE 
                error: function(){
                  $("#datatable_processing").css("display","none");
                }
              },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        }]
            });   
    }); 

    $('#datatableShowAll').dataTable({
        "bPaginate": false
    });

    

    </script>
  </body>
</html>
