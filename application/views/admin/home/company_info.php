 
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Company Information <small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <!--
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>  
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
           
          </li> 
          -->
           
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
         
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>home/save_company_info" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Company Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="company_name" name="company_name" value="<?php echo $company_info->company_name;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Contact Number <span class="required">*</span> 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="contact_no" name="contact_no" value="<?php echo $company_info->contact_number;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" id="email" name="email" value="<?php echo $company_info->email;?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
 
          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Address  
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea type="text" id="address" name="address"  class="form-control col-md-7 col-xs-12"><?php echo $company_info->address?></textarea>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">ABN Number <span class="required">*</span> 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="abn" name="abn" value="<?php echo $company_info->abn;?>" required="required" data-inputmask="'mask': '99 999 999 999'" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <!-- stsrt editor -->

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Invoice Terms
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

          <div id="editor-one" class="editor-wrapper" onkeyup="copy_content()"><?php echo $company_info->invoice_terms;?></div>

          <textarea name="invoice_terms" id="description" style="display:none;"><?php echo $company_info->invoice_terms;?></textarea>
          
            </div>
          </div> 

          <!-- editor -->

          <div class="form-group">
            <label class="control-label col-md-3ad col-sm-3 col-xs-12" for="last-name">Company Logo
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="images" type="file" class="form-control col-md-7 col-xs-12" accept="image/*" /> 
              <p>
              <img src="<?php echo base_url('assets/uploaded_files/company_files/'.$company_info->company_logo);?>" width="400">
              </p>
            </div>
          </div>
 
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
              <button type="submit" class="btn btn-success">Upadate</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

   
</div>
<script type="text/javascript">
function mark_as_completed(id,sid){
  reset(); 

  alertify.confirm("set status of job number "+sid+" to completed?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>home/set_as_completed/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
function action_open(id){
$( "#tr" + id ).show();  
}

function close_action(id){ 
  $( "#tr" + id ).hide(); 
}

$('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

function copy_content(){
    document.getElementById('description').value = document.getElementById('editor-one').innerHTML;
  }
</script>




           

           


   