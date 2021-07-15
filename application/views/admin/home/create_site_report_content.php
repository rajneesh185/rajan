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
        <h2>Create Site Report <small>forms</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>home/save_site_report/<?php echo en($id,$this->config->item('openssl_key'));?>" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Visit Date  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="single_cal1" name="visit_date" data-provide="datepicker" class="datepicker form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Adhere to Safe Distance  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="atsd" id="atsd" required="required" class="form-control col-md-7 col-xs-12">
                <option value="1">yes</option>
                <option value="0">no</option>  
              </select>
            </div>
          </div>

           <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Max 6 Pax Onsite
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="mpo" id="mpo" required="required" class="form-control col-md-7 col-xs-12">
                <option value="1">yes</option>
                <option value="0">no</option>  
              </select>
            </div>
          </div>

           <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Walk Parimiter
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="wp" id="wp" required="required" class="form-control col-md-7 col-xs-12">
                <option value="1">yes</option>
                <option value="0">no</option>  
              </select>
            </div>
          </div>

           <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Board Photo
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="board_photos[]" type="file" multiple="multiple" class="form-control col-md-7 col-xs-12" accept="image/*" required="required"/> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Pre Clean Photos
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="pre_clean_photos[]" type="file" multiple="multiple" class="form-control col-md-7 col-xs-12" accept="image/*" required="required"/> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Post Clean Photos
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="post_clean_photos[]" type="file" multiple="multiple" class="form-control col-md-7 col-xs-12" accept="image/*" required="required"/> 
            </div>
          </div>

          <!-- stsrt editor -->

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Note
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              
          <textarea name="note" id="note" style="width:100%" ></textarea>
          

          </div>
          </div>

          <!-- editor -->

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Bricklayer
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="score_bricklayer" id="score_bricklayer" required="required" class="js-example-basic-single form-control col-md-7 col-xs-12" maxlength="3" />
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Cleaner
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="score_cleaner" id="score_cleaner" required="required" class="js-example-basic-single form-control col-md-7 col-xs-12" maxlength="3"  />
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
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
  });
   

  function copy_content(){
    document.getElementById('note').value = document.getElementById('editor-one').innerHTML;
  }
</script>


