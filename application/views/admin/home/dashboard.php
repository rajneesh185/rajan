<?php
$key = $this->config->item('openssl_key');
function en($data,$key){
    $Openssl_security = new Openssl_security;
    return $Openssl_security->e($data, $key); 
}  

if($system_users){
  foreach ($system_users as $rs) { 
    $arr_usser[$rs->id] = $rs->name;
    $arr_usser_un[$rs->id] = $rs->un;
}}  

if($wash_process){
  foreach ($wash_process as $rs) { 
    $arr_wash_process[$rs->id] = $rs->title;
}} 

if($invoice_jobs){
  foreach ($invoice_jobs as $rs) { 
    $arr_invoice[$rs->job_id] = $rs->invoice_id;
}} 

if($raised_issue){
  foreach ($raised_issue as $rs) { 
    $arr_raised_issue[$rs->job_order_id] = $rs->job_order_id;
}} 

$arr_approved[1] = 'yes';
$arr_approved[0] = 'no';

$arr_status[1] = 'in-progress';
$arr_status[0] = 'completed';
?>
<div class="row top_tiles">
  <?php if(1){

    $days7 = date('Y-m-d', strtotime('-7 days'));
    $days10 = date('Y-m-d', strtotime('-0 days'));
    $count_no_invoice=0;
    $finish_last7days = 0;
    $incomplete_jobs_after10days = 0;
    $filter_job_id = [];
    $outstanding = 0;

    if($brick_type){
      foreach ($brick_type as $rs) { 
        $arr_brick_type[$rs->id] = $rs->title;
        $arr_brick_type_manu[$rs->id] = $rs->manufacturer;
    }} 

    if($job_orders){
      foreach ($job_orders as $rs) { 
        if(
          (isset($arr_brick_type_manu[$rs->brick_type]) && $arr_brick_type_manu[$rs->brick_type]==$this->session->user_id) ||
          $rs->cleaner==$this->session->user_id || 
          $rs->builder==$this->session->user_id ||
          $rs->bricklayer==$this->session->user_id ||
          strtolower($this->session->user_category) == 'admin'
        ){

          if(isset($arr_invoice[$rs->id]) && $arr_invoice[$rs->id]){}else{
			$count_no_invoice+=1; 
            if($filter == 1){array_push($filter_job_id, $rs->id);}
          }

          if($rs->date_completed){
            if(strtotime($rs->date_completed) >= strtotime($days7)){
              $finish_last7days+=1; 
              if($filter == 2){array_push($filter_job_id, $rs->id);}
            }
          }  

          if(isset($arr_raised_issue[$rs->id]) && $arr_raised_issue[$rs->id] /*&& $rs->status==1*/){
            $outstanding+=1;
            if($filter == 3){array_push($filter_job_id, $rs->id);}
          }

          if(!$rs->date_completed){ 
            if(strtotime($rs->job_open_date) <= strtotime($days10)){ 
              $incomplete_jobs_after10days+=1; 
              if($filter == 4){array_push($filter_job_id, $rs->id);}
            }
          }

        }}}?>

  <?php if(strtolower($this->session->user_category) == 'admin'){?>      
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a href="<?php echo base_url();?>home/dashboard/1">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-file"></i></div>
      <div class="count"><?php echo $count_no_invoice;?></div>
      <h3>All Job Orders</h3>
      <p></p> <!-- not Invoiced* -->
    </div>
    </a>
  </div>
<?php }?>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a href="<?php echo base_url();?>home/dashboard/2">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-check-square-o"></i></div>
      <div class="count"><?php echo $finish_last7days;?></div>
      <h3>Completed Last 7 Days</h3>
      <p></p> <!-- Completed Last 7 Days -->
    </div>
    </a>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a href="<?php echo base_url();?>home/dashboard/3">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-bell"></i></div>
      <div class="count"><?php echo $outstanding;?></div>
      <h3>Active Alerts</h3>
      <p></p> <!-- Outstanding Alerts. -->
    </div>
    </a>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a href="<?php echo base_url();?>home/dashboard/4">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-square-o"></i></div>
      <div class="count"><?php echo $incomplete_jobs_after10days;?></div>
      <h3>Jobs to be completed</h3>
      <p></p> <!-- Job Incomplete after 10 days. -->
    </div>
    </a>
  </div>
</div> 
<?php }?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Job Orders <small>List of Job Orders</small></h2>
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
          <?php if(strtolower($this->session->user_category) == 'admin'){?>
          <li><a href="<?php echo base_url();?>home/add_orders_content" class="load_modal_details" data-toggle="modal" data-target=".bs-example-modal-lg"  title="create new order"><i class="fa fa-plus"></i></a>
          </li>
          <?php }?>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
        <style type="text/css">
          
        </style>
        </p>
        <table id="datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Job Open Date</th>
              <th>Job Number</th>
              <th>Approved</th>
              <th>Builder</th> 
              <?php if(strtolower($this->session->user_category) == 'builder'){?>
              <th>Supervisor</th>  
              <?php }?>
              <th>Qty. Bricks</th>
              <th>Brick Type</th>
              <th>Address</th>
              <th>Brick Layer</th>
              <th>Cleaner</th>
              <th>Wash Process</th>
              <th>Status</th> 
              <th>Alert</th>
              <?php if(strtolower($this->session->user_category) == 'admin'){?>
              <th>Invoice</th> 
              <?php }?>
              <th>Option</th>
            </tr>
          </thead>


          <tbody>
          <?php   

          if($job_orders){
            foreach ($job_orders as $rs) { 

              if((
                (isset($arr_brick_type_manu[$rs->brick_type]) && $arr_brick_type_manu[$rs->brick_type]==$this->session->user_id) ||
                $rs->cleaner==$this->session->user_id || 
                $rs->builder==$this->session->user_id ||
                $rs->bricklayer==$this->session->user_id ||
                strtolower($this->session->user_category) == 'admin')
                &&
                (!$filter || ($filter && in_array($rs->id, $filter_job_id)))
              ){
          ?>
            <tr>
              <td>
                <?php if($rs->job_open_date == '1970-01-01' && strtolower($this->session->user_category) == 'admin'){?>
                  <a title="edit error date" href="<?php echo base_url();?>home/edit_error_date/<?php echo en($rs->id,$key);?>" class="load_modal_details" data-toggle="modal" data-target=".bs-example-modal-lg"><?php echo date(dateformatc,strtotime($rs->job_open_date));?> <i class="fa fa-edit"></i></a>
                <?php }else{?>
                  <?php echo date(dateformatc,strtotime($rs->job_open_date));?>
                <?php }?>  
                </td> 
              <td><?php echo $rs->job_no;?></td> 
              <td><?php echo $arr_approved[$rs->approved];?></td> 
              <td><a href="<?php echo base_url();?>home/view_system_user_content/<?php echo en($rs->builder,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="load_modal_details"><u><?php echo $arr_usser[$rs->builder];?></u></a></td> 
              <?php if(strtolower($this->session->user_category) == 'builder'){?>
              <td><?php echo $rs->supervisor;?></td> 
              <?php }?>
              <td><?php echo $rs->qty_bricks;?></td> 
              <td><?php if(isset($arr_brick_type[$rs->brick_type]) && $arr_brick_type[$rs->brick_type]){echo $arr_brick_type[$rs->brick_type];}?></td> 
              <td><?php echo $rs->address;?></td> 
              <td>
                <?php if(isset($arr_brick_type_manu[$rs->brick_type]) && $arr_brick_type_manu[$rs->brick_type]==$this->session->user_id){?>
                  <u><?php echo $arr_usser_un[$rs->bricklayer];?></u>
                <?php }else{?>  
                <a href="<?php echo base_url();?>home/view_system_user_content/<?php echo en($rs->bricklayer,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="load_modal_details"><u><?php echo $arr_usser[$rs->bricklayer];?></u></a>
                <?php }?>
              </td> 
              <td>
                <?php if(isset($arr_brick_type_manu[$rs->brick_type]) && $arr_brick_type_manu[$rs->brick_type]==$this->session->user_id){?>
                  <u><?php echo $arr_usser_un[$rs->cleaner];?></u>
                <?php }else{?>
                  <a href="<?php echo base_url();?>home/view_system_user_content/<?php echo en($rs->cleaner,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="load_modal_details"><u><?php echo $arr_usser[$rs->cleaner];?></u></a>
                <?php }?>
                </td>
              <td><a href="<?php echo base_url();?>home/view_wash_procecess_content/<?php echo en($rs->wash_process,$this->config->item('openssl_key'));?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="load_modal_details" data-placement="bottom" title="show description"><u><?php echo $arr_wash_process[$rs->wash_process];?></u></a></td>
              <td>
                <?php if($rs->status==1){?>
                  <span class="btn btn-xs btn-primary"><?php echo $arr_status[$rs->status];?></span>
                <?php }else{?>
                  <span class="btn btn-xs btn-success" title="date completed : <?php echo date(dateformatc,strtotime($rs->date_completed));?>"><?php echo $arr_status[$rs->status];?></span>
                <?php }?> 
              </td>  
              <td><?php
              if(isset($arr_raised_issue[$rs->id]) && $arr_raised_issue[$rs->id] /*&& $rs->status==1*/){
                echo '<i class="fa fa-exclamation-triangle"></i>';
              }else{
                echo '';
              }
              ?></td> 
              <?php if(strtolower($this->session->user_category) == 'admin'){?>
              <td>
                <?php if(isset($arr_invoice[$rs->id]) && $arr_invoice[$rs->id]){?>
                  <a href="<?php echo base_url();?>invoice/view_invoice_content/<?php echo $e = en($arr_invoice[$rs->id],$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="load_modal_details"><u><small><?php echo 'INV'.sprintf("%07d",$arr_invoice[$rs->id]);?></u></small></a>
                <?php }?>
              </td>
              <?php }?>
              <td>  

                <div class="btn-group  btn-group-xs"id="tr<?php echo $rs->id;?>">
                  <a href="<?php echo base_url();?>home/view_orders_content/<?php echo $e = en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-default load_modal_details" type="button" data-placement="bottom" title="view job order details"><i class="fa fa-file-text-o"></i></a> 

                   <?php if($rs->status==1 && strtolower($this->session->user_category) == 'cleaner'){?>
                  <a href="<?php echo base_url();?>home/create_site_report_content/<?php echo en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-warning load_modal_details" type="button" data-placement="bottom" title="create site report"><i class="fa fa-pencil-square"></i></a> 
                  <?php }?> 

                  <?php if($rs->status==1 && (strtolower($this->session->user_category) == 'cleaner' || strtolower($this->session->user_category) == 'admin')){?>
                  <a href="<?php echo base_url();?>home/raise_an_issue_content/<?php echo en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-danger load_modal_details" type="button" data-placement="bottom" title="issues"><i class="fa fa-pencil-square-o"></i></a>
                  <?php }?>

                  <?php if(strtolower($this->session->user_category) != 'cleaner' && strtolower($this->session->user_category) != 'admin'){?>
                  <a href="<?php echo base_url();?>home/add_comments_content/<?php echo en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info load_modal_details" type="button" data-placement="bottom" title="add comments"><i class="fa fa-comment-o"></i></a>
                  <?php }?>

                  <?php if($rs->status==1 && strtolower($this->session->user_category) == 'cleaner'){?> 
                  <a onclick="mark_as_completed('<?php echo en($rs->id,$key);?>','<?php echo $rs->job_no;?>');" class="btn btn-primary load_modal_details" type="button" data-placement="bottom" title="mark as completed"><i class="fa fa-check-square-o"></i></a>
                  <?php }elseif($rs->status==0 && strtolower($this->session->user_category) == 'cleaner'){?> 
                  <a onclick="mark_as_inprogress('<?php echo en($rs->id,$key);?>','<?php echo $rs->job_no;?>');" class="btn btn-primary load_modal_details" type="button" data-placement="bottom" title="set as in-progress"><i class="fa fa-square-o"></i></a>
                  <?php }?> 

                  <?php if(strtolower($this->session->user_category) == 'admin'){?>
                  <a href="<?php echo base_url();?>home/edit_job_order/<?php echo en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-primary load_modal_details" type="button" data-placement="bottom" title="edit job order"><i class="fa fa-pencil-square"></i></a> 

                  <a href="Javascript:delete_job_order('<?php echo en($rs->id,$key);?>','<?php echo $rs->job_no;?>')"  type="button" data-placement="bottom" class="btn btn-primary" title="delete job order"><i class="fa fa-trash"></i></a> 
                  <?php }?> 

                  <?php if($rs->status==1 && strtolower($this->session->user_category) == 'builder'){?>
                  <a href="<?php echo base_url();?>home/edit_job_open_date/<?php echo en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-warning load_modal_details" type="button" data-placement="bottom" title="edit job open date"><i class="fa fa-pencil-square"></i></a> 
                  <?php }?>

                  <!--
                  <?php if($rs->status==0 && strtolower($this->session->user_category) == 'admin'){?> 
                  <a href="<?php echo base_url();?>home/generate_invoice_content/<?php echo en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info load_modal_details" type="button" data-placement="bottom" title="generate invoice"><i class="fa fa-file-text-o"></i></a>
                  <?php }?> 
                  -->
 
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
function mark_as_completed(id,sid){
  reset(); 

  alertify.confirm("set status of job number "+sid+" to completed?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>home/set_as_completed/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function mark_as_inprogress(id,sid){
  reset(); 

  alertify.confirm("set status of job number "+sid+" to in-progress?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>home/set_as_inprogress/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}


function action_open(id){
$( "#tr" + id ).show();  
}

function close_action(id){ 
  $( "#tr" + id ).hide(); 
}

$('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

function delete_job_order(id,sid){
  reset(); 

  alertify.confirm("remove job number "+sid+"?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>home/delete_job/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
} 
</script>




           

           


   