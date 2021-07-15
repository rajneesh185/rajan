<?php
$key = $this->config->item('openssl_key');
function en($data,$key){
    $Openssl_security = new Openssl_security;
    return $Openssl_security->e($data, $key); 
} 
?>
<style type="text/css">
  .select2-search-choice-close{
    color: #000 !important;
  }
</style>
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
        <form method="post" id="frm_validation" action="<?php echo base_url();?>invoice/save_jobs/<?php echo en($id,$key);?>" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

           

          <div class="form-group">
            <label class="control-label col-12" for="last-name">Select Jobs
            </label>
            <div class="col-12">

              <select name="jobs[]" id="jobs" required="required" class="js-example-basic-multiple form-control col-md-7 col-xs-12" multiple="multiple">
                <option value=""></option> 
               <?php  
               if($invoice_jobs){
                 foreach ($invoice_jobs as $rs) { 
                   $arr_inv[$rs->job_id] = $rs->id;
               }} 

               if($job_orders){
                 foreach($job_orders as $rs){ if(isset($arr_inv[$rs->id]) && $arr_inv[$rs->id]){}else{ ?>
               <option value="<?php echo $rs->id;?>"><?php echo $rs->job_no;?></option>
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
      $('.js-example-basic-multiple').select2();
  });
  $('.datepicker').daterangepicker({
        format: 'mm/dd/yyyy',
        singleDatePicker: true
    });

  function copy_content(){
    document.getElementById('description').value = document.getElementById('editor-one').innerHTML;
  }
</script>


