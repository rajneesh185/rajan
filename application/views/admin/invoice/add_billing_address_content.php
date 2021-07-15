<?php
function en($data,$key){
    $Openssl_security = new Openssl_security;
    return $Openssl_security->e($data, $key); 
} 
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Set Delivery Address <small>forms</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>invoice/save_billing_address/<?php echo en($id,$this->config->item('openssl_key'));?>" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

           

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Address
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea name="billing_address" class="form-control"><?php echo $invoice->billing_address;?></textarea>
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


