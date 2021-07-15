<?php if($report_type==2){?>
<?php
header("Content-Disposition: attachment; filename=job-order-report.xls");
header("Pragma: no-cache"); 	
header("Expires: 0");
?>
<?php }?>
<?php if($report_type==1){?>
<center>
				<img height="80" src="<?php echo base_url();?>assets/uploaded_files/company_files/<?php echo $company_info->company_logo;?>"/>
			</center>
      <style type="text/css">
        td,tr{
          white-space: nowrap;
        }
      </style>
<?php }?>
<h4>Job Order Report</h4>
<?php if($report_type==1){?> 
  <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome --> 
    <link href="<?php echo base_url();?>assets/themes/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="https://colorlib.com/polygon/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
	.table{ 
    font-size: 12px;
    size: 12px; 
	}
</style>
<?php }?>
<table class="table table-striped table-bordered table-hover ">
          <thead>
            <tr >
              <th>Job Open Date</th> 
              <th>Job Number</th>
              <th>Approved</th>
              
              <?php if(strtolower($this->session->user_category) != 'builder'){?>
              <th>Builder</th>
              <?php }?>

              
              <th>Qty. Bricks</th>
              <th>Location</th>

              <?php if(strtolower($this->session->user_category) != 'bricklayer'){?>
              <th>Brick Layer</th>
              <?php }?>

              <?php if(strtolower($this->session->user_category) != 'cleaner'){?>
              <th>Cleaner</th>
              <?php }?>

              <th>Address</th>
              <th>Sand Type</th>
              <th>Cement Type</th>
              <th>Brick Type</th>
              <th>Wash Process</th>
              <?php if(strtolower($this->session->user_category) != 'manufacturer'){?>
              <th>Supervisor Name</th>
              <th>Telephone No.</th>
              <?php }?>


              <?php if(strtolower($this->session->user_category) != 'admin'){?>
              <th>Description</th>
              <th>Status</th>
              <?php }?>

              <th>Date Completed</th>
              <th>Bricklayer Score</th>
              <th>Cleaner Score</th>
              <?php if($invoice_tab==1 && strtolower($this->session->user_category) == 'admin'){?>
              <th>Invoice Number</th>
              <th>Invoice Status</th> 
              <th>Number of Liters</th>
              <!--<th>Builder Score</th>-->
              <?php }?>
              <?php if(strtolower($this->session->user_category) != 'admin'){?>
              <th>Manufacturer Score</th>
              <?php }?>
            </tr>
          </thead>


          <tbody>
          <?php 

           if($system_users){
            foreach ($system_users as $rs) { 
              $arr_usser[$rs->id] = $rs->name;
              $arr_usser_un[$rs->id] = $rs->un;
          }} 

          if($brick_type){
            foreach ($brick_type as $rs) { 
              $arr_brick_type[$rs->id] = $rs->title;
              $arr_brick_type_manu[$rs->id] = $rs->manufacturer;
          }} 

          if($sand_type){
            foreach ($sand_type as $rs) { 
              $arr_sand_type[$rs->id] = $rs->title;
          }} 

          if($cement_type){
            foreach ($cement_type as $rs) { 
              $arr_cement_type[$rs->id] = $rs->title;
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

          if($comments){
            foreach ($comments as $rs) { 
              if(isset($arr_comment_score[$rs->job_order_id]) && $arr_comment_score[$rs->job_order_id]){
                $arr_comment_score[$rs->job_order_id]+=$rs->score;
                $arr_comment_score_count[$rs->job_order_id]+=1;
              }else{
                 $arr_comment_score[$rs->job_order_id]=$rs->score;
                 $arr_comment_score_count[$rs->job_order_id]=1;
              } 
              $arr_comment[$rs->job_order_id] = $rs->comments; 
          }} 

          
          if($invoice_tab==1  && strtolower($this->session->user_category) == 'admin'){

          if($invoice){
            foreach ($invoice as $rs) { 
              $arr_invoice_status[$rs->id] = $rs->status;
          }} 

          if($invoice_jobs){
            foreach ($invoice_jobs as $rs) { 
              $arr_invoice_id[$rs->job_id] = $rs->invoice_id; 
          }}  

          }

          if($site_reports){
            foreach ($site_reports as $rs) { 

              if(isset($arr_score_bricklayer[$rs->job_order_id]) && $arr_score_bricklayer[$rs->job_order_id]){
                $arr_score_bricklayer[$rs->job_order_id]+= $rs->score_bricklayer;
                $arr_score_bricklayer_count[$rs->job_order_id]+= 1;
              }else{
                $arr_score_bricklayer[$rs->job_order_id] = $rs->score_bricklayer;
                $arr_score_bricklayer_count[$rs->job_order_id] = 1;
              }
              
              if(isset($arr_score_cleaner[$rs->job_order_id]) && $arr_score_cleaner[$rs->job_order_id]){
                $arr_score_cleaner[$rs->job_order_id]+= $rs->score_cleaner;
                $arr_score_cleaner_count[$rs->job_order_id]+= 1;
              }else{
                $arr_score_cleaner[$rs->job_order_id] = $rs->score_cleaner;
                $arr_score_cleaner_count[$rs->job_order_id] = 1;
              }
              
          }} 

          $arr_approved[1] = 'yes';
          $arr_approved[0] = 'no';

          $arr_inv_status[1] = 'open';
          $arr_inv_status[0] = 'closed';

          $arr_status[1] = 'In-progress';
          $arr_status[0] = 'Completed';

          $alldate = $this->input->post('alldate');

          $builder = $this->input->post('builder');
          $cleaner = $this->input->post('cleaner');
          $bricklayer = $this->input->post('bricklayer');

          $sand_type = $this->input->post('sand_type');
          $brick_type = $this->input->post('brick_type');
          $cement_type = $this->input->post('cement_type');
          $approved = $this->input->post('approved');
          $status = $this->input->post('status');

          if($date_from){ 
            list($d,$m,$y) = explode('/', $date_from); $date_from="$y-$m-$d";
          }
          if($date_to){
            list($d,$m,$y) = explode('/', $date_to); $date_to="$y-$m-$d";
          }

          if($job_orders){
          	foreach ($job_orders as $rs) { 

              $arr_job_order[$rs->id] = $rs->job_no;
              $arr_job_order_address[$rs->id] = $rs->address;

              $checm_ltr = ($rs->qty_bricks / 1000);
              $user_checm_ltr = $checm_ltr * $arr_wash_process_checm_ratio[$rs->wash_process];

              $arr_job_order_ltr[$rs->id] = $user_checm_ltr;

              $arr_job_order_price[$rs->id] = $user_checm_ltr * $arr_chemicals_price[$arr_wash_process_checm[$rs->wash_process]]; 

          		if(
                
                ($alldate || (strtotime($date_from)<=strtotime($rs->job_open_date) && strtotime($date_to)>=strtotime($rs->job_open_date))) 
                && 
                ((!$builder || $rs->builder == $builder) && ($rs->builder==$this->session->user_id || strtolower($this->session->user_category) != 'builder'))
                && 
                ((!$cleaner || $rs->cleaner == $cleaner) && ($rs->cleaner==$this->session->user_id || strtolower($this->session->user_category) != 'cleaner'))
                && 
                ((!$bricklayer || $rs->bricklayer == $bricklayer) && ($rs->bricklayer==$this->session->user_id || strtolower($this->session->user_category) != 'bricklayer'))
                &&
                (!$sand_type || $rs->sand_type == $sand_type)
                &&
                (!$brick_type || $rs->brick_type == $brick_type)
                &&
                (!$cement_type || $rs->cement_type == $cement_type)
                &&
                (!$approved || $rs->approved == $approved)
                &&
                (!$status || $rs->status == $status)
                &&
                (strtolower($this->session->user_category) != 'manufacturer' || (strtolower($this->session->user_category) == 'manufacturer' && isset($arr_brick_type_manu[$rs->brick_type]) && $arr_brick_type_manu[$rs->brick_type]==$this->session->user_id))

          	){
          ?>
            <tr>
              <td><?php echo date(dateformatc,strtotime($rs->job_open_date));?></td>  
              <td><?php echo $rs->job_no;?></td> 
              <td><?php echo $arr_approved[$rs->approved];?></td>

              <?php if(strtolower($this->session->user_category) != 'builder'){?> 
              <td><?php echo $arr_usser[$rs->builder];?></td> 
              <?php }?>

              
              <td><?php echo $rs->qty_bricks;?></td> 
              <td><?php echo $rs->location;?></td> 
              
              <?php if(strtolower($this->session->user_category) != 'bricklayer'){?>
              <td>
                <?php if(strtolower($this->session->user_category) == 'manufacturer'){?>  
                  <?php echo $arr_usser_un[$rs->bricklayer];?> 
                <?php }else{?>  
                  <?php echo $arr_usser[$rs->bricklayer];?> 
                <?php }?>
                </td> 
              <?php }?>

              <?php if(strtolower($this->session->user_category) != 'cleaner'){?>
              <td>
                <?php if(strtolower($this->session->user_category) == 'manufacturer'){?>  
                  <?php echo $arr_usser_un[$rs->cleaner];?>
                <?php }else{?> 
                  <?php echo $arr_usser[$rs->cleaner];?>
                <?php }?>
                </td>
              <?php }?>

              <td><?php echo $rs->address;?></td>
              <td><?php echo $arr_sand_type[$rs->sand_type];?></td>
              <td><?php echo $arr_cement_type[$rs->cement_type];?></td>
              <td><?php if(isset($arr_brick_type[$rs->brick_type]) && $arr_brick_type[$rs->brick_type]){echo $arr_brick_type[$rs->brick_type];}?></td>
              <td><?php echo $arr_wash_process[$rs->wash_process];?></td>
              <?php if(strtolower($this->session->user_category) != 'manufacturer'){?>
              <td><?php echo $rs->supervisor;?></td>
              <td><?php echo $rs->tel_no;?></td> 
              <?php }?>

              <?php if(strtolower($this->session->user_category) != 'admin'){?>
              <td><?php echo $rs->description;?></td>
              <td><?php echo $arr_status[$rs->status];?></td>
              <?php }?>



              <td><?php if($rs->date_completed){echo date(dateformatc,strtotime($rs->date_completed));}?></td> 
              <td><?php if(isset($arr_score_bricklayer[$rs->id]) && $arr_score_bricklayer[$rs->id]){ 
                echo ($arr_score_bricklayer[$rs->id]/($arr_score_bricklayer_count[$rs->id] * 100)*100) ;
              } ?></td>
              <td><?php if(isset($arr_score_cleaner[$rs->id]) && $arr_score_cleaner[$rs->id]){
                echo ($arr_score_cleaner[$rs->id]/($arr_score_cleaner_count[$rs->id] * 100)*100) ; 
              } ?></td>
              <?php if($invoice_tab==1 && strtolower($this->session->user_category) == 'admin'){?>
              <td><?php $inv='';if(isset($arr_invoice_id[$rs->id]) && $arr_invoice_id[$rs->id]){echo 'INV'.sprintf("%07d",$inv=$arr_invoice_id[$rs->id]);}?></td>
              <td><?php if(isset($arr_inv_status[$arr_invoice_status[$inv]]) && $arr_inv_status[$arr_invoice_status[$inv]]){echo  $arr_inv_status[$arr_invoice_status[$inv]];}?></td>
              <td><?php if(isset($arr_job_order_ltr[$rs->id]) && $arr_job_order_ltr[$rs->id]){ echo $arr_job_order_ltr[$rs->id]; }?></td>
              <!--<td><?php //if(isset($arr_job_order_price[$rs->id]) && $arr_job_order_price[$rs->id]){ echo number_format($arr_job_order_price[$rs->id],2); }?></td>-->
              <?php }?>

              <?php if(strtolower($this->session->user_category) != 'admin'){?>
              <td><?php if(isset($arr_comment_score[$rs->id]) && $arr_comment_score[$rs->id]){ 
                echo ($arr_comment_score[$rs->id]/($arr_comment_score_count[$rs->id] * 100)*100) ;
              }?></td>
              <?php }?>
               
            </tr> 
           <?php }}}?>
          </tbody>
        </table>
        <?php if($report_type==1){?>
<script type="text/javascript">
//self.print();
</script>
<?php }?>