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
        <h2>Invoice <small>Closed Status</small></h2>
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
          <li><a href="<?php echo base_url();?>invoice/add_invoice_content" class="load_modal_details" data-toggle="modal" data-target=".bs-example-modal-lg"  title="add new invoice"><i class="fa fa-plus"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          List closed invoice in the system.
        </p>
        <table id="datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Invoice Number</th>
              <th>Jobs</th> 
              <th>Bill to</th>
              <th>Date Generated</th> 
              <th>Ltrs of Chemicals Used</th> 
              <th>Date Closed</th> 
              <th>Option</th>
            </tr>
          </thead>


          <tbody>
          <?php 

          function ceiling($number, $significance = 1)
             {
                 return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
             }

          if($system_users){
            foreach ($system_users as $rs) { 
              $arr_usser[$rs->id] = $rs->name;
          }}  

          if($job_orders){
            foreach ($job_orders as $rs) { 
              $arr_job_order[$rs->id] = $rs->job_no;
          }}  

          $arr_ij = [];
          $arr_job_order_ratio = 0;

          if($invoice_jobs){
            foreach ($invoice_jobs as $rs) { 
              if(isset($arr_ij[$rs->invoice_id]) && $arr_ij[$rs->invoice_id]){
                $arr_ij[$rs->invoice_id].= '-split-'.$rs->job_id.'-'.$rs->id;
              }else{
                $arr_ij[$rs->invoice_id] = $rs->job_id.'-'.$rs->id;
              }
          }}  

          if($wash_process){
            foreach ($wash_process as $rs) { 
              $arr_wash_process[$rs->id] = $rs->title;
              $arr_wash_process_checm[$rs->id] = $rs->chemicals;
              $arr_wash_process_checm_ratio[$rs->id] = $rs->chemicals_ratio;
          }} 

          if($chemicals){
            foreach ($chemicals as $rs) { 
              $arr_chemicals[$rs->id] = $rs->title;
              $arr_chemicals_price[$rs->id] = $rs->retail_price;
              $arr_chemicals_ltr_per_btl[$rs->id] = $rs->liter_per_bottle;
              $arr_chemicals_btl_per_plt[$rs->id] = $rs->bottles_per_pallet;
          }} 

          if($job_orders){
            foreach ($job_orders as $rs) { 
              $arr_job_order[$rs->id] = $rs->job_no;
              $arr_job_order_address[$rs->id] = $rs->address;

              $checm_ltr = ($rs->qty_bricks / 1000);
              $user_checm_ltr = $checm_ltr * $arr_wash_process_checm_ratio[$rs->wash_process];

              $arr_job_order_ltr[$rs->id] =  $user_checm_ltr;
              $arr_job_order_ratio = $arr_chemicals_ltr_per_btl[$arr_wash_process_checm[$rs->wash_process]];

              $arr_job_order_price[$rs->id] = $user_checm_ltr * $arr_chemicals_price[$arr_wash_process_checm[$rs->wash_process]];

          }}  


          if($invoice){
            foreach ($invoice as $rs) {  $ttl = 0;  
          ?>
            <tr>
               
              <td><?php echo 'INV'.sprintf("%07d",$rs->id);?></td> 
              <td><?php 
                if(isset($arr_ij[$rs->id]) && $arr_ij[$rs->id]){
                  $jobs = explode('-split-',$arr_ij[$rs->id]);
                  foreach($jobs as $jrs){ list($jrs,$jid) = explode('-',$jrs);
                  $ttl+=round($arr_job_order_ltr[$jrs],2);
                    ?><span class="label label-primary"><a href="<?php echo base_url();?>home/view_orders_content/<?php echo en($jrs,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="load_modal_details" style="color: #fff;"><?php echo $arr_job_order[$jrs];?></a></span> <?php
                  }
                }else{
                  echo 'no jobs';
                }
              ?></td>
              <td><a href="<?php echo base_url();?>home/view_system_user_content/<?php echo en($rs->bill_to,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="load_modal_details"><u><?php echo $arr_usser[$rs->bill_to];?></u></a></td>
              <td><?php echo date(dateformatc,strtotime($rs->date_created));?></td>
              <td><?php echo round($ttl,$arr_job_order_ratio,2);?></td>
              <td><?php echo  date(dateformatc,strtotime($rs->date_closed))?></td>
              <td>
                 <div class="btn-group  btn-group-xs"id="tr<?php echo $rs->id;?>">
                  <a href="<?php echo base_url();?>invoice/view_invoice_content/<?php echo $e = en($rs->id,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-default load_modal_details" type="button" data-placement="bottom" title="view invoice"><i class="fa fa-file-text-o"></i></a> 

                  <a href="Javascript:reopen_invoice('<?php echo en($rs->id,$key);?>');""  class="btn btn-primary" type="button" data-toggle="modal" data-placement="bottom" title="Re-Open Invoice"><i class="fa fa-history"></i></a> 

                  <!--
                  <a href="<?php echo base_url();?>invoice/add_jobs/<?php echo en($rs->id,$key);?>/<?php echo en($rs->bill_to,$key);?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info load_modal_details" type="button" data-placement="bottom" title="Add Job Orders"><i class="fa fa-plus"></i></a>  
 
                  <a href="Javascript:close_invoice('<?php echo en($rs->id,$key);?>');""  class="btn btn-primary" type="button" title="Close Invoice"><i class="fa fa-check-square-o"></i></a>  
                  -->
              </td>
            </tr> 
           <?php }}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

   
</div>
<script type="text/javascript">
function remove_job(str){
  reset(); 

  alertify.confirm("remove job?", function (e) {
        if (e) {  
            alertify.log("removing...");
            location.href = "<?php echo base_url();?>invoice/remove_job_from_invoice/"+str;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function reopen_invoice(str){
  reset(); 

  alertify.confirm("re-open invoice?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>invoice/set_invoice_to_open/"+str;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>

