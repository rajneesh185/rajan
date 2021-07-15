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
        <h2>Maintenance <small><?php echo $table_name;?></small></h2>
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
          <li><a href="<?php echo base_url();?>maintenance/add_table_data_content/<?php echo $table_name_sql;?>" class="load_modal_details" data-toggle="modal" data-target=".bs-example-modal-lg"  title="add new user"><i class="fa fa-plus"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          Maintenance list used in the system.
        </p>
        <table id="datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Maintenance ID</th>
              <th>Title</th>
              <th>Description</th> 
              <?php if($table_name_sql=='fm_brick_type'){?>
              <th>Manufacturer</th>
              <th>Wash Approved</th> 
              <th>Wash Process</th>  
              <?php }elseif($table_name_sql=='fm_chemicals'){?>
              <th>Retail Price</th>
              <th>Liter Per Bottle</th> 
              <th>Bottles Per Pallet</th>  
              <?php }elseif($table_name_sql=='fm_wash_process'){?>
              <th>Chemicals</th> 
              <th>Ratio Liters of Checmicals</th> 
              <?php }?>
              <th>Option</th>
            </tr>
          </thead>


          <tbody>
          <?php 

          if($table_name_sql=='fm_brick_type'){

            if($wash_process){
              foreach ($wash_process as $rs) { 
                $arr_wash_process[$rs->id] = $rs->title; 
            }} 

            if($brick_type){
              foreach ($brick_type as $rs) {  
                $arr_brick_type[$rs->id] = $rs->title; 
            }} 

            if($system_users){
              foreach ($system_users as $rs) { 
                $arr_system_users[$rs->id] = $rs->name; 
            }} 

            $arr_approved[0] = 'no';
            $arr_approved[1] = 'yes';

          }elseif($table_name_sql=='fm_wash_process'){

            if($chemicals){
              foreach ($chemicals as $rs) { 
                $arr_chemicals[$rs->id] = $rs->title; 
            }} 

          }


          if($table_data){
          	foreach ($table_data as $rs) { 
          ?>
            <tr>
              <td><?php echo sprintf("%05d",$rs->id);?></td>
              <td><?php echo $rs->title;?></td>
              <td><?php echo $rs->ds;?></td> 
              
              <?php if($table_name_sql=='fm_brick_type'){?>
                <td><?php echo $arr_system_users[$rs->manufacturer]; ?></td>
                <td><?php echo $arr_approved[$rs->wash_approved]; ?></td>
                <td><?php echo $arr_wash_process[$rs->wash_process]; ?></td> 
              <?php }elseif($table_name_sql=='fm_chemicals'){?>
                <td><span class="pull-right"><?php echo number_format($rs->retail_price,2);?></td>
                <td><?php echo $rs->liter_per_bottle;?></span></td> 
                <td><?php echo $rs->bottles_per_pallet;?></td> 
              <?php }elseif($table_name_sql=='fm_wash_process'){?>
                <td><?php echo $arr_chemicals[$rs->chemicals]; ?></td> 
                <td><?php echo $rs->chemicals_ratio; ?></td> 
              <?php }?>
              <th>
                <a href="<?php echo base_url();?>maintenance/edit_table_data_content/<?php echo $table_name_sql;?>/<?php echo en($rs->id,$key);?>" class="load_modal_details" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-pencil"></i> edit</a>
                | 
                <a href="Javascript:remove_data('<?php echo en($rs->id,$key);?>');"><i class="fa fa-trash-o"></i> remove</a>
               
              </th>
            </tr> 
           <?php }}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

   
</div>
<script type="text/javascript">
function remove_data(str){
  reset(); 

  alertify.confirm("delete id : "+str+"?", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>maintenance/delete_data/<?php echo $table_name_sql;?>/"+str;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>

