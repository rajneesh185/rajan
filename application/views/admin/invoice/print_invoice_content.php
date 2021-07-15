<?php 
$border = ''; $width = ''; 

if($for_email == 'yes'){ 
  $border = ' style="border: 1px solid black !important; border-collapse: collapse;"'; $width = 'width="100%"'; 
}

function ceiling($number, $significance = 1)
   {
       return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
   }
?>

<div id="capture" class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
       
      <div class="x_content">

      <div class="row" id="section-to-print" style="width: 100%;">  
                     
                     <table class="table" <?php echo $width;?>>
                       <tr>
                         <td><h3>Tax Invoice</h3>

                           <?php echo $company_info->company_name;?><br/>
                           <?php echo $company_info->address;?><br/>
                           Email: <?php echo $company_info->email;?><br/>
                           ABN: <?php echo $company_info->abn;?><br/>
                         </td>
                         <td align="right">
                          <img height="80" src="<?php echo base_url();?>assets/uploaded_files/company_files/<?php echo $company_info->company_logo;?>"/>
                         </td>
                       </tr>
                     </table>
                     <?php
                     if($system_users){
                       foreach ($system_users as $rs) { 
                         $arr_usser[$rs->id] = $rs->name;
                         $arr_usser_address[$rs->id] = $rs->address;
                         $arr_usser_email[$rs->id] = $rs->email;
                         $arr_usser_abn[$rs->id] = $rs->abn;
                     }} 
                     ?>
                     <table class="table" <?php echo $width;?>>
                       <tr> 
                         <td>
                           <strong>Bill To</strong><br/>
                           <?php echo $arr_usser[$invoice->bill_to];?><br/>
                           <?php echo $arr_usser_address[$invoice->bill_to];?><br/>
                           Email: <?php echo $arr_usser_email[$invoice->bill_to];?><br/>
                           ABN: <?php echo $arr_usser_abn[$invoice->bill_to];?><br/>
                         </td>
                         <td>
                            <strong>Deliver To</strong><br/>
                           <?php echo $invoice->billing_address;?><br/> 
                         </td>
                         <td class="pull-right">
                           <strong>Invoice Number</strong><br/>
                           #<?php echo 'INV'.sprintf("%07d",$invoice->id);?><br/>
                           Date: <?php echo  date(dateformatc,strtotime($invoice->date_created))?>
                         </td> 
                       </tr>
                       <tr>
                         <td colspan="3">
                           
                          <table <?php echo $width; echo $border;?> class="table table-striped table-bordered table-hover">
                            <tr>
                              <th <?php echo $border;?>>Job Number</th>
                              <th <?php echo $border;?>>Job Open Date</th>
                              <th <?php echo $border;?>>Address</th>
                              <th <?php echo $border;?>>Product</th>
                              <th <?php echo $border;?>>Bricks</th>
                              <th <?php echo $border;?>>Number of Liters</th>
                              <th <?php echo $border;?>>Unit Price</th>
                              <th <?php echo $border;?>>Amount</th>
                            </tr>
                            <?php
                            if($system_users){
                              foreach ($system_users as $rs) { 
                                $arr_usser[$rs->id] = $rs->name;
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

                            $ratio_of_chemicals = 0;

                            if($job_orders){
                              foreach ($job_orders as $rs) { 
                                $arr_job_order[$rs->id] = $rs->job_no;
                                $arr_job_order_open_date[$rs->id] = $rs->job_open_date;
                                $arr_job_order_address[$rs->id] = $rs->address;

                                $checm_ltr = ($rs->qty_bricks / 1000);
                                $user_checm_ltr = $checm_ltr * $arr_wash_process_checm_ratio[$rs->wash_process];

                                $arr_job_order_bricks[$rs->id] = $rs->qty_bricks;

                                $ratio_of_chemicals = $arr_chemicals_ltr_per_btl[$arr_wash_process_checm[$rs->wash_process]];

                                $arr_job_order_ltr[$rs->id] = $user_checm_ltr;
                                $arr_job_order_unit_price[$rs->id] = $arr_chemicals_price[$arr_wash_process_checm[$rs->wash_process]];
                                $arr_job_order_price[$rs->id] = $arr_job_order_ltr[$rs->id] * $arr_chemicals_price[$arr_wash_process_checm[$rs->wash_process]];

                                $arr_job_order_chem[$rs->id] = $arr_chemicals[$arr_wash_process_checm[$rs->wash_process]];

                            }}  

                            $arr_ij = []; 
                            $ttl = 0;
                            $ttlu = 0;
                            $ttl_ltr = 0;
                            $ttl_brks = 0;

                            if($invoice_jobs){
                              foreach ($invoice_jobs as $rs) { 
                            ?>
                            <tr>
                              <td <?php echo $border;?>><?php echo $arr_job_order[$rs->job_id];?></td>
                              <td <?php echo $border;?>><?php echo $arr_job_order_open_date[$rs->job_id];?></td>
                              <td <?php echo $border;?>><?php echo $arr_job_order_address[$rs->job_id];?></td>
                              <td <?php echo $border;?>><?php echo $arr_job_order_chem[$rs->job_id];?></td> 
                              
                              <td <?php echo $border;?> align="right"><?php echo round($arr_job_order_bricks[$rs->job_id],2);  $ttl_brks+=round($arr_job_order_bricks[$rs->job_id],2);?></td>

                              <td <?php echo $border;?> align="right"><?php echo round($arr_job_order_ltr[$rs->job_id],2);  $ttl_ltr+=round($arr_job_order_ltr[$rs->job_id],2);?></td>

                              <td <?php echo $border;?> align="right"><?php /*echo number_format($arr_job_order_unit_price[$rs->job_id],2); */ $ttlu=round($arr_job_order_unit_price[$rs->job_id],2);?></td>
                              <td <?php echo $border;?> align="right"><?php /*echo number_format($arr_job_order_price[$rs->job_id],2); */$ttl+=round($arr_job_order_price[$rs->job_id],2);?></td>
                            </tr>
                          <?php }}?>
                          <tr>
                            <td <?php echo $border;?> colspan="4" align="right"><strong>Chemicals Sub Total </strong></td>
                            <td <?php echo $border;?> align="right"> </td>
                            <td <?php echo $border;?> align="right" title="<?php echo $ttl_ltr;?>"><strong><?php echo $ttl_ltr;?> ltr.</strong></td>
                            <td <?php echo $border;?> align="right"> </td>
                            <td <?php echo $border;?> align="right"> </td>
                          </tr>
                          <tr>
                            <td <?php echo $border;?> colspan="4" align="right"><strong>CHEMICAL ORDER rounded to the nearest whole number </strong></td>
                            <td <?php echo $border;?> align="right"><strong><?php echo round($ttl_brks,2);?> pcs.</strong></td>
                            <td <?php echo $border;?> align="right" title="<?php echo ceil($ttl_ltr);?>"><strong><?php echo $ttl_chem = ceil($ttl_ltr);;?> ltr.</strong></td>
                            <td <?php echo $border;?> align="right"><strong><?php echo '&#'.$settings->currency; echo number_format($ttlu,2);?> </strong></td>
                            <td <?php echo $border;?> align="right"><strong><?php echo '&#'.$settings->currency; echo number_format($ttl_chem * $ttlu,2); $ttl = round($ttl_chem * $ttlu,2);?> </strong></td>
                          </tr>
                          </table>

                         </td>
                       </tr>
                     </table>

                     <table class="table table-striped table-bordered table-hover" <?php echo $width; echo $border;?>>
                      <tr>
                        <th <?php echo $border;?>>Description</th>
                        <th <?php echo $border;?>>Price</th>
                      </tr>
                        <?php $ttl_fee=0;
                        if($invoice_fee){
                          foreach($invoice_fee as $rs){?>
                        <tr id="frow<?php echo $rs->id;?>">
                          <td <?php echo $border;?>><?php echo $rs->title;?></td>
                          <td <?php echo $border;?> align="right"><strong><?php echo number_format($rs->amount, 2); $ttl_fee+=round($rs->amount,2);?></strong></td> 
                        </tr>
                      <?php }}?>
                    </table>

                    <table width="100%" border="0">

                      <tr>
                        <td valign="bottom" width="60%" >
                            <strong>Invoice Terms</strong>
                            <p>
                            <?php echo $company_info->invoice_terms;?>
                          </p>
                        </td>
                        <td width="40%" align="right">
                       

                     <table class="table table-striped table-bordered table-hover pull-right" style="width: 80%; padding-right: 100px;" <?php echo $border;?>>
                       <tr>
                         <td <?php echo $border;?>>Subtotal: </td>
                         <td <?php echo $border;?> align="right"><?php echo '&#'.$settings->currency; echo number_format($ttl + $ttl_fee,2);?></td>
                       </tr>
                       <tr>
                         <td <?php echo $border;?>>GST <?php echo $settings->gst;?>%</td>
                         <td <?php echo $border;?> align="right"><?php echo '&#'.$settings->currency; echo number_format((($ttl + $ttl_fee) * ($settings->gst/100)),2);?></td>
                       </tr>
                       <tr>
                         <td <?php echo $border;?>><strong>Total: </strong></td>
                         <td <?php echo $border;?> align="right"><strong><?php echo '&#'.$settings->currency; echo number_format(($ttl + $ttl_fee)+(($ttl + $ttl_fee) * ($settings->gst/100)),2);?></strong></td>
                       </tr>
                     </table>

                     </td>
                   </tr>
                 </table>


                      <!-- this row will not appear when printing -->
                      
                    </section> 

              </div>
              <?php if($for_email == 'no'){?>
                    <div id="footek" class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default noprint pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button> 

                          <!--
                          <a href="<?php echo base_url();?>invoice/send_email/<?php echo $id;?>" class="btn btn-default noprint pull-right"><i class="fa fa-envelope-o"></i> SEND HTML FORMAT EMAIL</a> 
                          -->

                          <a href="Javascript:captureImage()" class="btn btn-default noprint pull-right"><i class="fa fa-envelope-o"></i> SEND BUILDER INVOICE COPY </a> 
                           
                          <button id="dismissModal" data-dismiss="modal" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-close"></i> Close</button> 
                        </div>
                      </div> 
                    </div>
             <?php }?>
                  </div>
                </div>
<?php if($for_email == 'yes'){?>
<script src="<?php echo base_url();?>assets/themes/html2canvas/html2canvas.min.js"></script> 
<script type="text/javascript">

  html2canvas(document.querySelector("#capture")).then(canvas => { 
      document.getElementById('capture').replaceWith(canvas);
    }); 
</script>
<?php }else{?>
<script src="<?php echo base_url();?>assets/themes/html2canvas/html2canvas.min.js"></script> 
<script type="text/javascript">

  function captureImage(){

    document.getElementById('footek').style.display = 'none';

    html2canvas(document.querySelector("#capture")).then(canvas => { 
        document.getElementById('capture').replaceWith(canvas);

        var dataURL = canvas.toDataURL("image/png");

      $.post("<?php echo base_url();?>invoice/save_image/<?php echo $id;?>",
      {
        img: dataURL
      },
      function(data, status){
        alert("Data: " + data + "\nStatus: " + status); 
        location.reload();
      }).fail(function() { 
         alert("error sending email"); 
         location.reload();
      });

      });
  

      
    }
</script>
<?php }?>