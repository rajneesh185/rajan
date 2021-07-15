 <div class="row">
  <div class="col-md-6 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Report <small>Job Order Report</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li> 
           
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <form method="post" id="frm_gen_report" name="frm_gen_report" target="_blank" action="<?php echo base_url();?>reports/generate_job_order_report" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <p class="text-muted font-13 m-b-30">
       
        <div class="container">
         
         
         <br/>

         <?php if(strtolower($this->session->user_category) != 'builder'){?>
         <label>Builder : </label>

          <select id="builder" name="builder" class="form-control" >  
              <option value="">all</option>
              <?php 
               if($user_category){
                 foreach ($user_category as $rs) { 
                   $arr_user_category[$rs->id] = $rs->title; 
               }} 

               if($system_users){
                 foreach($system_users as $rs){ if(strtolower($arr_user_category[$rs->user_category]) == 'builder'){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option>
               <?php }}}?> 
          </select> 
        <?php }?>


        <?php if(strtolower($this->session->user_category) != 'cleaner'){?>
          <label>Cleaner : </label>

          <select id="cleaner" name="cleaner" class="form-control" >  
              <option value="">all</option>
              <?php 
               if($user_category){
                 foreach ($user_category as $rs) { 
                   $arr_user_category[$rs->id] = $rs->title; 
               }} 

               if($system_users){
                 foreach($system_users as $rs){ if(strtolower($arr_user_category[$rs->user_category]) == 'cleaner'){?>
               <?php if(strtolower($this->session->user_category) == 'manufacturer'){?>   
               <option value="<?php echo $rs->id;?>"><?php echo $rs->un;?></option>
             <?php }else{?>
              <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option>
             <?php }?>
               <?php }}}?> 
          </select> 
        <?php }?>

        <?php if(strtolower($this->session->user_category) != 'bricklayer'){?>
          <label>Bricklayer : </label>

          <select id="bricklayer" name="bricklayer" class="form-control">  
              <option value="">all</option>
              <?php 
               if($user_category){
                 foreach ($user_category as $rs) { 
                   $arr_user_category[$rs->id] = $rs->title; 
               }} 

               if($system_users){
                 foreach($system_users as $rs){ if(strtolower($arr_user_category[$rs->user_category]) == 'bricklayer'){?>
                  <?php if(strtolower($this->session->user_category) == 'manufacturer'){?>   
                   <option value="<?php echo $rs->id;?>"><?php echo $rs->un;?></option>
                 <?php }else{?>
                    <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option>
                  <?php }?>
               <?php }}}?> 
          </select>
        <?php }?> 

         <label>Approved : </label>

          <select id="approved" name="approved" class="form-control">  
              <option value="">all</option>
              <option value="1">yes</option>
              <option value="0">no</option>
          </select> 

          <label>Cement Type : </label>

          <select id="cement_type" name="cement_type" class="form-control">  
              <option value="">all</option>
              <?php 
               if($cement_type){
                 foreach($cement_type as $rs){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
               <?php }}?> 
          </select> 

          <label>Sand Type : </label>

          <select id="sand_type" name="sand_type" class="form-control">  
              <option value="">all</option>
              <?php 
               if($sand_type){
                 foreach($sand_type as $rs){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
               <?php }}?> 
          </select> 

          <label>Brick Type : </label>

          <select id="brick_type" name="brick_type" class="form-control">  
              <option value="">all</option>
              <?php 
               if($brick_type){
                 foreach($brick_type as $rs){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
               <?php }}?> 
          </select> 

          <label>All date : </label>
          <div class="checkbox" onclick="alldate()">
            <label>
              <input type="checkbox" value="1" id="alldate" name="alldate"> all job open dates 
            </label>
          </div>
 
          <br/>
          <label>Job Open Date From : </label>
          <input type="text" id="single_cal2" name="date_from" data-provide="datepicker" class="datepicker form-control col-md-7 col-xs-12" value="">

          <br/>
          <label>Job Open Date To : </label>
          <input type="text" id="single_cal3" name="date_to" data-provide="datepicker" class="datepicker form-control col-md-7 col-xs-12" value="">

          <br/>
          <label>Job Order Status: </label>

          <select id="status" name="status" class="form-control">  
              <option value="">all</option>
              <option value="1">In-progress</option>
              <option value="0">Completed</option>
          </select> 

          <br/>
          <?php if(strtolower($this->session->user_category) == 'admin'){?>   
          <label>Invoice Details: </label>

          <select id="invoice_tab" name="invoice_tab" class="form-control">   
              <option value="1">Show in the report</option>
              <option value="0">Hide</option>
          </select> 
         
 

        <br/> <?php }?>
         <label>Report type : </label>

          <select id="report_type" name="report_type" class="form-control" required="required">  
              <option value="1">Print Preview</option>
              <option value="2">Export to excel</option>  
          </select> 


        <br/> 

         

         

        </div>  

        <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
              <button type="submit" class="btn btn-success">Generate</button>
            </div>
          </div>
    </form>
      </div>
    </div>
  </div> 
 
   
</div> 

<script type="text/javascript">

   // format is in the custom.js
   $('.datepicker').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
          }
    });
   $('#date_from').val('');
   $('#date_to').val('');


   function alldate(){
    if(document.getElementById("alldate").checked){
       document.getElementById("single_cal2").disabled = true; 
       document.getElementById("single_cal3").disabled = true; 
    }else{
       document.getElementById("single_cal2").disabled = false; 
       document.getElementById("single_cal3").disabled = false; 
    }
   }

</script>

