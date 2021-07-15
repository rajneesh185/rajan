<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Wash Process<small>description</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
         <div class="row"> 
          <?php 
          if($chemicals){
            foreach ($chemicals as $rs) { 
              $arr_chemicals[$rs->id] = $rs->title;
              $arr_chemicals_price[$rs->id] = $rs->retail_price;
              $arr_chemicals_ltr_per_btl[$rs->id] = $rs->liter_per_bottle;
              $arr_chemicals_btl_per_plt[$rs->id] = $rs->bottles_per_pallet;
          }} 

          if($wash_process){
            foreach ($wash_process as $rs) { 
              $arr_wash_process[$rs->id] = $rs->title;
              $arr_wash_process_desc[$rs->id] = $rs->ds;
              $arr_wash_process_checm[$rs->id] = $rs->chemicals;
              $arr_wash_process_checm_ratio[$rs->id] = $rs->chemicals_ratio;
          }} 

          ?>
                <div class="col-12">
                  <label>Wash Process Title</label> 
                  <p><?php echo $arr_wash_process[$id];?></p>
                </div>
                <div class="form-group col-12">
                  <label>Description</label> 
                  <p><?php echo $arr_wash_process_desc[$id];?></p>
                </div>
                <hr/>
                <div class="form-group col-12">
                  <label>Checmicals Used</label> 
                  <p><?php echo $arr_chemicals[$arr_wash_process_checm[$id]];?></p>
                </div>

                <div class="form-group col-12">
                  <label>Retails Price</label> 
                  <p><?php echo $arr_chemicals_price[$arr_wash_process_checm[$id]];?></p>
                </div>

                <div class="form-group col-12">
                  <label>Checmicals Liter per Bottle</label> 
                  <p><?php echo $arr_chemicals_ltr_per_btl[$arr_wash_process_checm[$id]];?></p>
                </div>

                <div class="form-group col-12">
                  <label>Checmicals Bottles per Pallet</label> 
                  <p><?php echo $arr_chemicals_btl_per_plt[$arr_wash_process_checm[$id]];?></p>
                </div>

                <div class="form-group col-12">
                  <label>Ratio Liters of Checmicals Per 1000 Bricks </label> 
                  <p><?php echo $arr_wash_process_checm_ratio[$id];?></p>
                </div>

              </div>
      </div>
    </div>
  </div>
</div> 
 

