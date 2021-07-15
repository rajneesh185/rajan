<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Create New Invoice <small>forms</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>invoice/save_invoice" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

           

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Bill To
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="bill_to" id="bill_to" required="required" class="js-example-basic-single form-control col-md-7 col-xs-12">
                <option value=""></option> 
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
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
  });
  $('.datepicker').daterangepicker({
        format: 'mm/dd/yyyy',
        singleDatePicker: true
    });

  function copy_content(){
    document.getElementById('description').value = document.getElementById('editor-one').innerHTML;
  }
</script>


