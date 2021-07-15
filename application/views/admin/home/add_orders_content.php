<?php
$arr_job_orders='';
if($job_orders){
  foreach ($job_orders as $rs) { 
    $arr_job_orders.='"'.$rs->job_no.'",'; 
}}
$arr_job_orders = $arr_job_orders.')';
$arr_job_orders = str_replace(',)', '', $arr_job_orders);
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Orders Forms <small>Create Orders</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>home/save_new_job_orders" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

           

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Job Number <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="job_no" name="job_no" required="required" class="form-control col-md-7 col-xs-12" onkeyup="check_job(this.value)">
              <small id="errJO" style="color: red; display: none;">Job Order Number Already Taken</small>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Builder <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="builder" id="builder" required="required" class="form-control col-md-7 col-xs-12">
                <option value="">select builder</option> 
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
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Job Open Date  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="single_cal1" name="job_open_date" data-provide="datepicker" class="datepicker form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Qty. Bricks   
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" id="qty_bricks" name="qty_bricks"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Approved  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="approved" id="approved" required="required" class="form-control col-md-7 col-xs-12">
                <option value="1">yes</option>
                <option value="0">no</option>  
              </select>
            </div>
          </div> 

          <!--
          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Location
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="location" name="location"  class="form-control col-md-7 col-xs-12">
            </div>
          </div> -->

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Address
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="address" name="address"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Supervisor Name
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="supervisor" name="supervisor"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <!--
          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Telephone Number
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="tel_no" name="tel_no"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>-->

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Cement Type <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="cement_type" id="cement_type" required="required" class="form-control col-md-7 col-xs-12">
                 <option value="">select cement type</option> 
               <?php 
               if($cement_type){
                 foreach($cement_type as $rs){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
               <?php }}?> 
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Sand Type <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="sand_type" id="sand_type" required="required" class="form-control col-md-7 col-xs-12">
                 <option value="">select sand type</option> 
               <?php 
               if($sand_type){
                 foreach($sand_type as $rs){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
               <?php }}?> 
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Brick Type <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="brick_type" id="brick_type" required="required" class="form-control col-md-7 col-xs-12">
                 <option value="">select brick type</option> 
               <?php 
               if($brick_type){
                 foreach($brick_type as $rs){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
               <?php }}?> 
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Bricklayer Code <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="bricklayer" id="bricklayer" required="required" class="form-control col-md-7 col-xs-12">
                <option value="">select bricklayer</option> 
               <?php 
               if($user_category){
                 foreach ($user_category as $rs) { 
                   $arr_user_category[$rs->id] = $rs->title; 
               }} 

               if($system_users){
                 foreach($system_users as $rs){ if(strtolower($arr_user_category[$rs->user_category]) == 'bricklayer'){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option>
               <?php }}}?> 
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Cleaner Code <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="cleaner" id="cleaner" required="required" class="form-control col-md-7 col-xs-12">
                <option value="">select cleaner</option> 
               <?php 
               if($user_category){
                 foreach ($user_category as $rs) { 
                   $arr_user_category[$rs->id] = $rs->title; 
               }} 

               if($system_users){
                 foreach($system_users as $rs){ if(strtolower($arr_user_category[$rs->user_category]) == 'cleaner'){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option>
               <?php }}}?> 
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Wash Process <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="wash_process" id="wash_process" required="required" class="form-control col-md-7 col-xs-12">
                 <option value="">select wash process</option> 
               <?php 
               if($wash_process){
                 foreach($wash_process as $rs){?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
               <?php }}?> 
              </select>
            </div>
          </div>

          <!-- stsrt editor -->

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               
            

          <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
            <div class="btn-group">
              <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
              <ul class="dropdown-menu">
              </ul>
            </div>

            <div class="btn-group">
              <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                  <a data-edit="fontSize 5">
                    <p style="font-size:17px">Huge</p>
                  </a>
                </li>
                <li>
                  <a data-edit="fontSize 3">
                    <p style="font-size:14px">Normal</p>
                  </a>
                </li>
                <li>
                  <a data-edit="fontSize 1">
                    <p style="font-size:11px">Small</p>
                  </a>
                </li>
              </ul>
            </div>

            <div class="btn-group">
              <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
              <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
              <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
              <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
            </div>

            <div class="btn-group">
              <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
              <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
              <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
              <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
            </div>

            <div class="btn-group">
              <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
              <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
              <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
              <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
            </div>

            <div class="btn-group">
              <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
              <div class="dropdown-menu input-append">
                <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                <button class="btn" type="button">Add</button>
              </div>
              <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
            </div>
 

            <div class="btn-group">
              <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
              <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
            </div>
          </div>

          <div id="editor-one" class="editor-wrapper" onkeyup="copy_content()"></div>

          <textarea name="ds" id="description" style="display:none;"></textarea>
          

          </div>
          </div>

          <!-- editor -->

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Attach Photo's
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="images[]" type="file" multiple="multiple" class="form-control col-md-7 col-xs-12" accept="image/*" /> 
            </div>
          </div>

          

           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
  $('.datepicker').daterangepicker({ 
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
          }
    });
 
  function copy_content(){
    document.getElementById('description').value = document.getElementById('editor-one').innerHTML;
  }

  function check_job(str){
    var jo = [<?php echo $arr_job_orders;?>];
    if(jo.includes(str)){
      document.getElementById('errJO').style.display = 'block';
    }else{
      document.getElementById('errJO').style.display = 'none';
    }
  }
</script>