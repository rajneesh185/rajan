<?php
function en($data,$key){
    $Openssl_security = new Openssl_security;
    return $Openssl_security->e($data, $key); 
} 
?>
<style>
/* [IMAGE] */
.zoomD { 
  cursor: pointer;
}

/* [LIGHTBOX BACKGROUND] */
#lb-back {
  position: fixed;
  top: 0;
  left: 0;
  width: 50vw;
  height: 50vh;
  background: rgba(0, 0, 0, 0.5);
  z-index: 999;
  visibility: hidden;
  opacity: 0;
  transition: all ease 0.4s;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
#lb-back.show {
  visibility: visible;
  opacity: 1;
}

/* [LIGHTBOX IMAGE] */
#lb-img {
  position: relative;
  top: 50%;
  transform: translateY(-50%);
  text-align: center;
}
#lb-img img {
  /* You might want to play around with 
     width, height, max-width, max-height
     to fit portrait / landscape pictures properly. */
  width: 100%;
  height: auto;
 
  /* ALTERNATE EXAMPLE
  width: 100%;
  max-width: 1200px;
  height: auto;
  margin: 0 auto; */
}
</style>
<div id="lb-back">x
  <div id="lb-img">cc</div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Job Order <small>
          <?php if($order->status == 1){?>
            <button type="button" class="btn btn-primary btn-lg">In-Progress</button>
          <?php }else{?>
            <button type="button" class="btn btn-success btn-lg">Completed</button>
          <?php }?>
        </small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> 

          <?php 

          if($user_category){
             foreach ($user_category as $rs) { 
               $arr_user_category[$rs->id] = $rs->title; 
           }}

          if($system_users){
            foreach ($system_users as $rs) { 
              $arr_usser[$rs->id] = $rs->name;
              $arr_usser_un[$rs->id] = $rs->un;
              $arr_usser_cat[$rs->id] = $arr_user_category[$rs->user_category];
          }} 

          if($sand_type){
            foreach ($sand_type as $rs) { 
              $arr_sand_type[$rs->id] = $rs->title;
          }} 
 
          if($brick_type){
            foreach ($brick_type as $rs) { 
              $arr_brick_type[$rs->id] = $rs->title;
              $arr_brick_type_manu[$rs->id] = $rs->manufacturer;
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
            <div class="row"> 
                <?php if(strtolower($this->session->user_category) != 'manufacturer'){?>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Date Order</label> 
                  <p><?php echo date(dateformatc,strtotime($order->date_created));?></p>
                </div>
                <?php }?>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Builder</label> 
                  <p><?php echo $arr_usser[$order->builder];?></p>
                </div>
                <!--
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Location</label> 
                  <p><?php echo $order->location;?></p>
                </div>-->
                <?php if(strtolower($this->session->user_category) != 'manufacturer'){?>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Address</label> 
                  <p><?php echo $order->address;?></p>
                </div>
                <!--
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Telephone Number</label> 
                  <p><?php echo $order->tel_no;?></p>
                </div>-->
                <?php }?>

                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Job Number</label> 
                  <p><?php echo $order->job_no;?></p>
                </div>

                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Job Open Date</label> 
                  <p><?php echo date(dateformatc,strtotime($order->job_open_date));?></p>
                </div>

                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Bricklayer Code</label> 
                  <p><?php 
                  if(isset($arr_brick_type_manu[$order->brick_type]) && $arr_brick_type_manu[$order->brick_type]==$this->session->user_id){
                      echo $arr_usser_un[$order->bricklayer];
                  }else{
                      echo $arr_usser[$order->bricklayer];
                   }
                 ?></p>
                </div>

                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Cement Type</label> 
                  <p><?php echo $arr_cement_type[$order->cement_type];?></p>
                </div>
                
                <?php if(strtolower($this->session->user_category) != 'manufacturer'){?>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Supervisor Name</label> 
                  <p><?php echo $order->supervisor;?></p>
                </div>
                <?php }?>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Approved</label> 
                  <p><?php echo $arr_approved[$order->approved];?></p>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Qty. Bricks</label> 
                  <p><?php echo $order->qty_bricks;?></p>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Cleaner</label> 
                  <p><?php 
                   if(isset($arr_brick_type_manu[$order->brick_type]) && $arr_brick_type_manu[$order->brick_type]==$this->session->user_id){
                      echo $arr_usser_un[$order->cleaner];
                   }else{
                      echo $arr_usser[$order->cleaner];
                    }

                  ?></p>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Sand Type</label> 
                  <p><?php echo $arr_sand_type[$order->sand_type];?></p>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Brick Type</label> 
                  <p><?php if(isset($arr_brick_type[$order->brick_type]) && $arr_brick_type[$order->brick_type]){echo $arr_brick_type[$order->brick_type];}?></p>
                </div>

                <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                  <label>Wash Process</label> 
                  <p><?php echo $arr_wash_process[$order->wash_process];?></p>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>Description</label> 
                  <p><?php echo $order->description;?></p>
                </div>

              

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <?php if($order->attachments){
              $images = explode("-split-",$order->attachments);
              foreach($images as $img){ if($img){?>
            <img height="90 width="90" src="<?php echo base_url('assets/uploaded_files/orders/'.$img);?>" class="zoomD" >
            <?php }}}?>

            </div>

            

            <?php if($site_report){?>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <hr/>

            <h4>Site Report</h4> 

              <table id="datatable" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Visit Date</th>
                    <th>Adhere to Safe Distance</th>
                    <th>Max 6 Pax Onsite</th>
                    <th>Walk Parimiter</th>
                    <th>Board Photo</th>
                    <th>Pre Clean Photos</th>
                    <th>Post Clean Photos</th>
                    <th>Note</th> 
                    <th>Bricklayer</th> 
                    <th>Cleaner</th> 
                    <?php if(strtolower($this->session->user_category) == 'admin'){?>
                    <th>Option</th>
                    <?php }?>
                  </tr>
                </thead>


                <tbody>
                <?php  

                 

                $arr_approved[1] = 'yes';
                $arr_approved[0] = 'no';

                if($site_report){
                  foreach ($site_report as $rs) { 
                ?>
                  <tr id="row_sr_<?php echo $rs->id;?>">
                    <td><?php echo date(dateformatc,strtotime($rs->visit_date));?></td>
                    <td><?php echo $arr_approved[$rs->atsd];?></td> 
                    <td><?php echo $arr_approved[$rs->mpo];?></td> 
                    <td><?php echo $arr_approved[$rs->wp];?></td> 
                    <td><?php 
                      if($rs->board_photos){
                          $images = explode("-split-",$rs->board_photos);
                          foreach($images as $img){ if($img){
                            ?><img height="30" width="30" src="<?php echo base_url('assets/uploaded_files/orders/'.$img);?>" class="zoomD"><?php
                          }}
                      }
                    ?></td> 
                    <td><?php 
                      if($rs->pre_clean_photos){
                          $images = explode("-split-",$rs->pre_clean_photos);
                          foreach($images as $img){ if($img){
                            ?><img height="30" width="30" src="<?php echo base_url('assets/uploaded_files/orders/'.$img);?>" class="zoomD"><?php
                          }}
                      }
                    ?></td> 
                    <td><?php 
                      if($rs->post_clean_photos){
                          $images = explode("-split-",$rs->post_clean_photos);
                          foreach($images as $img){ if($img){
                            ?><img height="30" width="30" src="<?php echo base_url('assets/uploaded_files/orders/'.$img);?>" class="zoomD"><?php
                          }}
                      }
                    ?></td>  
                    <td><?php echo $rs->note?></td> 
                    <td><?php echo $rs->score_bricklayer?></td>
                    <td><?php echo $rs->score_cleaner?></td>
                    <?php if(strtolower($this->session->user_category) == 'admin'){?>
                    <td>
                      <div class="btn-group  btn-group-xs">
                      <a href="Javascript:delete_site_report('<?php echo en($rs->id,$key);?>',<?php echo $rs->id;?>)"  type="button" data-placement="bottom" class="btn btn-primary" title="delete job order"><i class="fa fa-trash"></i></a> 
                      </div>
                    </td>
                    <?php }?>
                  </tr> 
                 <?php }}?>
                </tbody>
                
  
              </table>

            </div>
            </div>
            </div>


            <?php }?> 

            <?php if($raised_issue){?>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <hr/>

            <h4>Raised Issue</h4>

            <table id="datatable" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Date File</th> 
                    <th>Description</th>
                    <th>Attached Photo</th> 
                    <th>Created By</th> 
                    <?php if(strtolower($this->session->user_category) == 'admin'){?>
                    <th>Option</th>
                    <?php }?>
                  </tr>
                </thead>


                <tbody>
                <?php  
 
                if($raised_issue){
                  foreach ($raised_issue as $rs) { 
                ?>
                  <tr id="row_ri_<?php echo $rs->id;?>">
                    <td><?php echo date(dateformatc,strtotime($rs->date_created));?></td> 
                    <td><?php echo $rs->description;?></td>  
                    <td><?php 
                      if($rs->attachments){
                          $images = explode("-split-",$rs->attachments);
                          foreach($images as $img){ if($img){
                            ?><img class="zoomD" height="30" width="30" src="<?php echo base_url('assets/uploaded_files/orders/'.$img);?>" style="cursor: pointer;" class="img_large" alt="<?php echo base_url('assets/uploaded_files/orders/'.$img);?>"><?php
                          }}
                      }
                    ?></td> 
                    <td><?php 
                    if(strtolower($this->session->user_category) == 'manufacturer'){
                      echo $arr_usser_cat[$rs->user_id];
                    }else{
                      echo $arr_usser[$rs->user_id];
                    } 
                    ?></td>  

                    <?php if(strtolower($this->session->user_category) == 'admin'){?>
                    <td>
                      <div class="btn-group  btn-group-xs">
                      <a href="Javascript:delete_raised_issue('<?php echo en($rs->id,$key);?>',<?php echo $rs->id;?>)"  type="button" data-placement="bottom" class="btn btn-primary" title="delete job order"><i class="fa fa-trash"></i></a> 
                      </div>
                    </td>
                    <?php }?>
                     
                  </tr> 
                 <?php }}?>
                </tbody>
                
  
              </table>

            </div>
            <?php }?>


            <?php if($comments){?>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <hr/>

            <h4>Job Orders Comments</h4>

            <table id="datatable" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Date File</th> 
                    <th>Score</th> 
                    <th>Comments</th> 
                    <th>Created By</th> 
                    <?php if(strtolower($this->session->user_category) == 'admin'){?>
                    <th>Option</th>
                    <?php }?>
                  </tr>
                </thead>


                <tbody>
                <?php  
 
                if($comments){
                  foreach ($comments as $rs) { 
                ?>
                  <tr id="row_c_<?php echo $rs->id;?>">
                    <td><?php echo date(dateformatc,strtotime($rs->date_created));?></td> 
                    <td><?php echo $rs->score;?></td>   
                    <td><?php echo $rs->comments;?></td>   
                    <td><?php 
                    if(strtolower($this->session->user_category) == 'manufacturer'){
                      echo $arr_usser_cat[$rs->user_id];
                    }else{
                      echo $arr_usser[$rs->user_id];
                    } 
                    ?></td> 

                    <?php if(strtolower($this->session->user_category) == 'admin'){?>
                    <td>
                      <div class="btn-group  btn-group-xs">
                      <a href="Javascript:delete_comment('<?php echo en($rs->id,$key);?>',<?php echo $rs->id;?>)"  type="button" data-placement="bottom" class="btn btn-primary" title="delete job order"><i class="fa fa-trash"></i></a> 
                      </div>
                    </td>
                    <?php }?>
                     
                  </tr> 
                 <?php }}?>
                </tbody>
                
  
              </table>

            </div>
            <?php }?>



 
      </div>
    </div>
  </div>
</div> 
 
<script type="text/javascript">   
 
// This function will show the image in the lightbox
var zoomImg = function () {
  // Create evil image clone
  var clone = this.cloneNode();
  clone.classList.remove("zoomD");

  // Put evil clone into lightbox
  var lb = document.getElementById("lb-img");
  lb.innerHTML = "";
  lb.appendChild(clone);

  // Show lightbox
  lb = document.getElementById("lb-back");
  lb.classList.add("show");
};
 
 
//window.addEventListener("load", function(){  
  // Attach on click events to all .zoomD images
  var images = document.getElementsByClassName("zoomD");
  if (images.length>0) { console.log('works?z?');
    for (var img of images) {
      img.addEventListener("click", zoomImg);
    }
  }
 
  // Click event to hide the lightbox
  document.getElementById("lb-back").addEventListener("click", function(){
    this.classList.remove("show");
  })
//});

 <?php if(strtolower($this->session->user_category) == 'admin'){?>

 function delete_site_report(id,rid){

  alertify.confirm("Delete site report?", function (e) {
        if (e) { 
    var jqxhr = $.get( "<?php echo base_url('home/delete_site_report/')?>"+rid, function(data) {
      document.getElementById('row_sr_'+rid).style.display = 'none'; 
      if(data){
        alertify.success("successfuly deleted.");
      }else{
        alertify.error("Failed to delete.");
      } 
    })
    .fail(function() {
        alertify.error("Failed to connect");
      })
    }
  }, "Confirm");
 }

  function delete_raised_issue(id,rid){

  alertify.confirm("Delete rased issue?", function (e) {
        if (e) { 
    var jqxhr = $.get( "<?php echo base_url('home/delete_raised_issue/')?>"+rid, function(data) {
      document.getElementById('row_ri_'+rid).style.display = 'none'; 
      if(data){
        alertify.success("successfuly deleted.");
      }else{
        alertify.error("Failed to delete.");
      } 
    })
    .fail(function() {
        alertify.error("Failed to connect");
      })
    }
  }, "Confirm");
 }

   function delete_comment(id,rid){

  alertify.confirm("Delete comment?", function (e) {
        if (e) { 
    var jqxhr = $.get( "<?php echo base_url('home/delete_comment/')?>"+rid, function(data) {
      document.getElementById('row_c_'+rid).style.display = 'none'; 
      if(data){
        alertify.success("successfuly deleted.");
      }else{
        alertify.error("Failed to delete.");
      } 
    })
    .fail(function() {
        alertify.error("Failed to connect");
      })
    }
  }, "Confirm");
 }
 

<?php }?>
</script>
