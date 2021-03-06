 
<center>
				<img height="80" src="<?php echo base_url();?>assets/uploaded_files/company_files/<?php echo $company_info->company_logo;?>"/>
			</center>
      <style type="text/css">
        td,tr{
          white-space: nowrap;
        }
      </style>
 
<h4><?php echo $this->session->user_category;?> - Cleaner Score Report</h4>
 
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
 
<table class="table table-striped table-bordered table-hover ">
          <thead>
            <tr>
              <th>Cleaner</th> 
              <th>Jobs Completed</th>  
 
              <th>Bricklayer Score</th>
              <th>Cleaner Score</th> 
               
              <th>Builder Score</th>  

              <th>Qty Bricks</th> 
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
              $arr_usser[$rs->id] = $rs->name;
              $arr_usser_un[$rs->id] = $rs->un;
              $arr_usser_cat[$rs->id] = $arr_user_category[$rs->user_category];
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
              if(strtolower($arr_usser_cat[$rs->user_id])=='builder'){
                if(isset($arr_comment_score['builder'.$rs->job_order_id]) && $arr_comment_score['builder'.$rs->job_order_id]){
                  $arr_comment_score['builder'.$rs->job_order_id]+=$rs->score;
                  $arr_comment_score_count['builder'.$rs->job_order_id]+=1;
                }else{
                   $arr_comment_score['builder'.$rs->job_order_id]=$rs->score;
                   $arr_comment_score_count['builder'.$rs->job_order_id]=1;
                } 
              }elseif(strtolower($arr_usser_cat[$rs->user_id])=='manufacturer'){
                if(isset($arr_comment_score['manufacturer'.$rs->job_order_id]) && $arr_comment_score['manufacturer'.$rs->job_order_id]){
                  $arr_comment_score['manufacturer'.$rs->job_order_id]+=$rs->score;
                  $arr_comment_score_count['manufacturer'.$rs->job_order_id]+=1;
                }else{
                   $arr_comment_score['manufacturer'.$rs->job_order_id]=$rs->score;
                   $arr_comment_score_count['manufacturer'.$rs->job_order_id]=1;
                } 
              }
              
              $arr_comment[$rs->job_order_id] = $rs->comments; 
          }}  

          
           

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


                if($rs->status==0){
                  if(isset($jobs_completed[$rs->cleaner]) && $jobs_completed[$rs->cleaner]){
                    $jobs_completed[$rs->cleaner]+=1;
                  }else{
                    $jobs_completed[$rs->cleaner]=1;
                  }
                  
                  if(isset($jobs_completed_qty_brks[$rs->cleaner]) && $jobs_completed_qty_brks[$rs->cleaner]){
                    $jobs_completed_qty_brks[$rs->cleaner]+=$rs->qty_bricks;
                  }else{
                    $jobs_completed_qty_brks[$rs->cleaner]=$rs->qty_bricks;
                  }

                  if(isset($arr_score_bricklayer[$rs->id]) && $arr_score_bricklayer[$rs->id]){ 
                  if(isset($bricklayer_score[$rs->cleaner]) && $bricklayer_score[$rs->cleaner]){
                    $bricklayer_score[$rs->cleaner]+=($arr_score_bricklayer[$rs->id]/($arr_score_bricklayer_count[$rs->id] * 100)*100);
                    $bricklayer_score_count[$rs->cleaner]+=1;
                  }else{
                    $bricklayer_score[$rs->cleaner]=($arr_score_bricklayer[$rs->id]/($arr_score_bricklayer_count[$rs->id] * 100)*100);
                    $bricklayer_score_count[$rs->cleaner]=1;
                  }
                }

                if(isset($arr_score_cleaner[$rs->id]) && $arr_score_cleaner[$rs->id]){ 
                  if(isset($cleaner_score[$rs->cleaner]) && $cleaner_score[$rs->cleaner]){
                    $cleaner_score[$rs->cleaner]+=($arr_score_cleaner[$rs->id]/($arr_score_cleaner_count[$rs->id] * 100)*100);
                    $cleaner_score_count[$rs->cleaner]+=1;
                  }else{
                    $cleaner_score[$rs->cleaner]=($arr_score_cleaner[$rs->id]/($arr_score_cleaner_count[$rs->id] * 100)*100);
                    $cleaner_score_count[$rs->cleaner]=1;
                  }
                } 

              if(isset($arr_comment_score['builder'.$rs->id]) && $arr_comment_score['builder'.$rs->id]){ 
                  if(isset($builder_score[$rs->cleaner]) && $builder_score[$rs->cleaner]){
                    $builder_score[$rs->cleaner]+=($arr_comment_score['builder'.$rs->id]/($arr_comment_score_count['builder'.$rs->id] * 100)*100);
                    $builder_score_count[$rs->cleaner]+=1;
                  }else{
                    $builder_score[$rs->cleaner]=($arr_comment_score['builder'.$rs->id]/($arr_comment_score_count['builder'.$rs->id] * 100)*100);
                    $builder_score_count[$rs->cleaner]=1;
                  }
                }

                }

                
                


                
                  
           }}}?>
          

           <?php
            
           if($system_users){
            foreach ($system_users as $rs) { 
              if(strtolower($arr_user_category[$rs->user_category]) == 'cleaner'){
                if(isset($jobs_completed[$rs->id]) && $jobs_completed[$rs->id]){
           ?>
           <tr>
             <td><?php echo $rs->un;?></td>
             <td><?php if(isset($jobs_completed[$rs->id]) && $jobs_completed[$rs->id]){ echo $jobs_completed[$rs->id]; }else{echo 0;}?></td>
             <td><?php if(isset($bricklayer_score[$rs->id]) && $bricklayer_score[$rs->id]){ 
                echo round($bricklayer_score[$rs->id]/($bricklayer_score_count[$rs->id] * 100)*100,1).'%'; }else{echo 0;}?></td>
             <td><?php if(isset($cleaner_score[$rs->id]) && $cleaner_score[$rs->id]){ 
                echo round($cleaner_score[$rs->id]/($cleaner_score_count[$rs->id] * 100)*100,1).'%'; }else{echo 0;}?></td>
             
             <td><?php if(isset($builder_score[$rs->id]) && $builder_score[$rs->id]){ 
                echo round($builder_score[$rs->id]/($builder_score_count[$rs->id] * 100)*100,1).'%'; }else{echo 0;}?></td>
              
             <td><?php if(isset($jobs_completed_qty_brks[$rs->id]) && $jobs_completed_qty_brks[$rs->id]){ echo $jobs_completed_qty_brks[$rs->id]; }else{echo 0;}?></td>
           </tr>
         <?php }}}} ?>
          </tbody>
        </table>
        <?php if($report_type==1){?>
<script type="text/javascript">
//self.print();
</script>
<?php }?>