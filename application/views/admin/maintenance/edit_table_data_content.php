<?php
$key = $this->config->item('openssl_key');
function en($data,$key){
    $Openssl_security = new Openssl_security;
    return $Openssl_security->e($data, $key); 
}  
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Filemaintenance <small>Edit Record</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>maintenance/update_table_data/<?php echo $table_name;?>/<?php echo en($table_data->id,$key);?>" data-toggle="validator" class="form-horizontal form-label-left">

           
          <div class="form-group">
            <label class="control-label col-12" for="last-name">Title <span class="required">*</span>
            </label> 
              <input type="text" id="title" name="title" required="required" value="<?php echo htmlentities($table_data->title);?>" class="form-control col-md-7 col-xs-12">
      
          </div>

         <!-- stsrt editor -->

          <div class="form-group">
            <label class="control-label col-12" for="last-name">Description
            </label> 
               
            

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

          <div id="editor-one" class="editor-wrapper" onkeyup="copy_content()"><?php echo $table_data->ds;?></div>

          <textarea name="ds" id="description" style="display:none;" value="<?php echo $table_data->ds;?>"></textarea>
          
 
          </div>

          <!-- editor --> 

          <?php if($table_name=='fm_brick_type'){?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Manufacturer
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="manufacturer" id="manufacturer" required="required" class="form-control col-md-7 col-xs-12">
                <option value="">select manufacturer</option> 
               <?php 
               if($user_category){
                 foreach ($user_category as $rs) { 
                   $arr_user_category[$rs->id] = $rs->title; 
               }} 

               if($system_users){
                 foreach($system_users as $rs){ if(strtolower($arr_user_category[$rs->user_category]) == 'manufacturer'){?>
               <option value="<?php echo $rs->id;?>" <?php if($rs->id==$table_data->manufacturer){ echo 'selected';}?>><?php echo $rs->name;?></option>
               <?php }}}?> 
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Wash Approved
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12"> 
              <select name="wash_approved" id="wash_approved" required="required" class="form-control col-md-7 col-xs-12">
                <?php if($table_data->wash_approved == 1){?>
                <option value="1">yes</option> 
                <option value="0">no</option>
                <?php }else{?>
                <option value="0">no</option>
                <option value="1">yes</option> 
                <?php }?>

              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Process Type
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="wash_process" id="wash_process" required="required" class="form-control col-md-7 col-xs-12">
                 <option value="">select wash process</option> 
               <?php 
               if($wash_process){
                 foreach($wash_process as $rs){?>
               <option value="<?php echo $rs->id;?>" <?php if($rs->id==$table_data->wash_process){ echo 'selected';}?>><?php echo $rs->title;?></option>
               <?php }}?> 
              </select>
            </div>
          </div> 
          <?php }elseif($table_name=='fm_chemicals'){?>
          <div class="form-group">
            <label class="control-label col-12" for="last-name">Retail Price
            </label> 
              <input type="text" id="retail_price" name="retail_price" value="<?php echo htmlentities($table_data->retail_price);?>"class="form-control col-md-7 col-xs-12">
        
          </div>
          <div class="form-group">
            <label class="control-label col-12" for="last-name">Liter Per Bottle
            </label> 
              <input type="text" id="liter_per_bottle" name="liter_per_bottle" value="<?php echo htmlentities($table_data->liter_per_bottle);?>" class="form-control col-md-7 col-xs-12">
        
          </div>
          <div class="form-group">
            <label class="control-label col-12" for="last-name">Bottles Per Pallet
            </label> 
              <input type="text" id="bottles_per_pallet" name="bottles_per_pallet" value="<?php echo htmlentities($table_data->bottles_per_pallet);?>" class="form-control col-md-7 col-xs-12">
        
          </div>
        <?php }elseif($table_name=='fm_wash_process'){?>
          <div class="form-group">
            <label class="control-label col-12" for="last-name">Chemicals
            </label> 
              <select name="chemicals" id="chemicals" required="required" class="form-control col-md-7 col-xs-12">
                 <option value="">select chemicals</option> 
               <?php 
               if($chemicals){
                 foreach($chemicals as $rs){?>
               <option value="<?php echo $rs->id;?>" <?php if($rs->id==$table_data->chemicals){ echo 'selected';}?>><?php echo $rs->title;?></option>
               <?php }}?> 
              </select>
        
          </div>
          <div class="form-group">
            <label class="control-label col-12" for="last-name">Ratio Ltrs of chemical required Per 1000 Bricks 
            </label> 
              
              <input type="number" id="chemicals_ratio" name="chemicals_ratio" value="<?php echo $table_data->chemicals_ratio;?>" required="required" value="" class="form-control col-md-7 col-xs-12">
        
          </div>
          <?php }?>
 
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success" onclick="copy_content()">Update</button>
            </div>
          </div>

          <input type="hidden" name="table_name" value="<?php echo $table_name;?>"></input>

        </form>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
  function copy_content(){
    document.getElementById('description').value = document.getElementById('editor-one').innerHTML;
  }
</script>

