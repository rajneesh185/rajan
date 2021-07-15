 
        <h2>Job Order <?php echo $order->job_no;?> Status Complete</h2>
         
          <?php 

          if($system_users){
            foreach ($system_users as $rs) { 
              $arr_usser[$rs->id] = $rs->name;
          }} 

          if($sand_type){
            foreach ($sand_type as $rs) { 
              $arr_sand_type[$rs->id] = $rs->title;
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
          }} 

          $arr_approved[1] = 'yes';
          $arr_approved[0] = 'no';
          ?> 
         

         <table border="0" width="95%" cellpadding="10">
           <tr>
             <td>
               <strong>Date Order</strong>
               <p><?php echo date(dateformatc,strtotime($order->date_created));?></p>
             </td>
             <td>
               <strong>Builder</strong>
               <p><?php echo $arr_usser[$order->builder];?></p>
             </td>
             <td>
               <strong>Location</strong>
               <p><?php echo $order->location;?></p>
             </td>
             <td>
               <strong>Address</strong>
               <p><?php echo $order->address;?></p>
             </td>
           </tr>
           <tr>
            <td>
               <strong>Job Number</strong>
               <p><?php echo $order->job_no;?></p>
             </td>
             <td>
               <strong>Telephone Number</strong>
               <p><?php echo $order->tel_no;?></p>
             </td> 
             <td>
               <strong>Job Open Date</strong>
               <p><?php echo date(dateformatc,strtotime($order->job_open_date));?></p>
             </td>
             <td>
               <strong>Bricklayer Code</strong>
               <p><?php echo $arr_usser[$order->bricklayer];?></p>
             </td>
           </tr>
           <tr>
            <td>
               <strong>Cement Type</strong>
               <p><?php echo $arr_cement_type[$order->cement_type];?></p>
             </td>
             <td>
               <strong>Supervisor Name</strong>
               <p><?php echo $order->supervisor;?></p>
             </td> 
             <td>
               <strong>Approved</strong>
               <p><?php echo $arr_approved[$order->approved];?></p>
             </td>
             <td>
               <strong>Qty. Bricks</strong>
               <p><?php echo $order->qty_bricks;?></p>
             </td>
           </tr>
           <tr>
            <td>
               <strong>Cleaner</strong>
               <p><?php echo $arr_usser[$order->cleaner];?></p>
             </td>
             <td>
               <strong>Sand Type</strong>
               <p><?php echo $arr_sand_type[$order->sand_type];?></p>
             </td> 
             <td>
               <strong>Wash Process</strong>
               <p><?php echo $arr_wash_process[$order->wash_process];?></p>
             </td>
             <td>
               
             </td>
           </tr>
         </table>
         <strong>Description</strong>
         <p><?php echo $order->description;?></p>
  
 
        <table border="0" cellpadding="10">
           <tr><?php if($order->attachments){
              $images = explode("-split-",$order->attachments);
              foreach($images as $img){ if($img){?>
             <td>
            
            <img height="90 width="90" src="<?php echo base_url('assets/uploaded_files/orders/'.$img);?>" class="zoomD">
            
          </td><?php }}}?>
        </tr>
      </table>
 
 
 