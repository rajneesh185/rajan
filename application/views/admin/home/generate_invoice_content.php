<div class="row" id="section-to-print">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Invoice Design <small>Sample user invoice design</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Invoice.
                                          <small class="pull-right">Date: <?php echo date("d/m/Y");?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                                          <strong><?php echo $company_info->company_name;?></strong>
                                          <br><?php echo $company_info->address;?>
                                          <br>Phone: <?php echo $company_info->contact_number;?>
                                          <br>Email: <?php echo $company_info->email;?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                                          <strong>John Doe</strong>
                                          <br>795 Freedom Ave, Suite 600
                                          <br>New York, CA 94107
                                          <br>Phone: 1 (804) 123-9876
                                          <br>Email: jon@ironadmin.com
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice #<?php echo sprintf("%06d",$order->id);?></b>
                          <br>
                          <br>
                          <b>Order ID:</b> <?php echo $order->job_no;?>
                          <br>
                          <b>Completed Date:</b> <?php echo date(dateformatc,strtotime($order->date_completed));?>
                          <br>
                          <b>Date Order:</b> <?php echo date(dateformatc,strtotime($order->date_created));?>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <?php 

                      if($system_users){
                        foreach ($system_users as $rs) { 
                          $arr_usser[$rs->id] = $rs->name;
                      }} 

                      if($sand_type){
                        foreach ($sand_type as $rs) { 
                          $arr_sand_type[$rs->id] = $rs->title;
                      }} 

                      if($sand_type){
                        foreach ($sand_type as $rs) { 
                          $arr_sand_type[$rs->id] = $rs->title;
                      }} 

                      if($cement_type){
                        foreach ($cement_type as $rs) { 
                          $arr_cement_type[$rs->id] = $rs->title;
                      }} 

                      if($wash_process){
                        foreach ($wash_process as $rs) { 
                          $arr_wash_process[$rs->id] = $rs->title;
                          $arr_wash_process_checm[$rs->id] = $rs->chemicals;
                          $arr_wash_process_checm_ratio[$rs->id] = $rs->chemicals_ratio;
                      }} 

                      $arr_approved[1] = 'yes';
                      $arr_approved[0] = 'no';
                      ?> 
                      <!-- Table row -->
                      <div class="row"> 

                                          <!--
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Date Order</label> 
                                            <p><?php echo date(dateformatc,strtotime($order->date_created));?></p>
                                          </div>
                                          
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Builder</label> 
                                            <p><?php echo $arr_usser[$order->builder];?></p>
                                          </div> 

                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Location</label> 
                                            <p><?php echo $order->location;?></p>
                                          </div>
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Address</label> 
                                            <p><?php echo $order->address;?></p>
                                          </div>
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Telephone Number</label> 
                                            <p><?php echo $order->tel_no;?></p>
                                          </div> -->

                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Job Number</label> 
                                            <p><?php echo $order->job_no;?></p>
                                          </div>

                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Job Open Date</label> 
                                            <p><?php echo date(dateformatc,strtotime($order->job_open_date));?></p>
                                          </div>
                                          <!--
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Bricklayer Code</label> 
                                            <p><?php echo $arr_usser[$order->bricklayer];?></p>
                                          </div> -->

                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Cement Type</label> 
                                            <p><?php echo $arr_cement_type[$order->cement_type];?></p>
                                          </div>
                                          <!--
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Supervisor Namr</label> 
                                            <p><?php echo $order->supervisor;?></p>
                                          </div>
                                          
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Approved</label> 
                                            <p><?php echo $arr_approved[$order->approved];?></p>
                                          </div>
                                          -->
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Sand Type</label> 
                                            <p><?php echo $arr_sand_type[$order->sand_type];?></p>
                                          </div> 
                                          
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Qty. Bricks</label> 
                                            <p><?php echo number_format($order->qty_bricks,0);?></p>
                                          </div>
                                          <!--
                                          <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                            <label>Cleaner</label> 
                                            <p><?php echo $arr_usser[$order->cleaner];?></p>
                                          </div> -->
                                          

                                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Description</label> 
                                            <p><?php echo $order->description;?></p>
                                          </div> 

                                          


                        <!-- /.col -->
                      </div>
                      <hr/>
                      <?php 
                      if($chemicals){
                        foreach ($chemicals as $rs) { 
                          $arr_chemicals[$rs->id] = $rs->title;
                          $arr_chemicals_price[$rs->id] = $rs->retail_price;
                          $arr_chemicals_ltr_per_btl[$rs->id] = $rs->liter_per_bottle;
                          $arr_chemicals_btl_per_plt[$rs->id] = $rs->bottles_per_pallet;
                      }} 
                      ?>
                      <div class="row">
                        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-12">
                          <label>Wash Process</label> 
                          <p><?php echo $arr_wash_process[$order->wash_process];?></p>
                        </div>

                        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-12">
                          <label>Chemicals Used</label> 
                          <p><?php echo $arr_chemicals[$arr_wash_process_checm[$order->wash_process]];?></p>
                        </div>

                        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-12">
                          <label>Retails Price</label> 
                          <p>$ <?php echo $arr_chemicals_price[$arr_wash_process_checm[$order->wash_process]];?></p>
                        </div>

                        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-12">
                          <label>Checmicals Liter per Bottle</label> 
                          <p><?php echo $arr_chemicals_ltr_per_btl[$arr_wash_process_checm[$order->wash_process]];?></p>
                        </div>

                        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-12">
                          <label>Checmicals Bottles per Pallet</label> 
                          <p><?php echo $arr_chemicals_btl_per_plt[$arr_wash_process_checm[$order->wash_process]];?></p>
                        </div>

                        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-12">
                          <label>Ratio Liters of Checmicals Per 1000 Bricks </label> 
                          <p><?php echo $arr_wash_process_checm_ratio[$order->wash_process];?></p>
                        </div>

                        <div class="form-group col-12">
                          <label>Formula</label> 
                          <p><?php 
                          $checm_ltr = ($order->qty_bricks / 1000);
                          $user_checm_ltr = $checm_ltr * $arr_wash_process_checm_ratio[$order->wash_process];
                          $price = $user_checm_ltr * $arr_chemicals_price[$arr_wash_process_checm[$order->wash_process]];

                          echo '(qty brick used: '.number_format($order->qty_bricks,2).' / used chemicals: '.number_format($user_checm_ltr,2).' Liter) x price per Ltr: $'.number_format($arr_chemicals_price[$arr_wash_process_checm[$order->wash_process]],2).' <br/>';
 
                          ?></p>
                        </div>

                        
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="lead">Payment Methods:</p>
                          <img src="images/visa.png" alt="Visa">
                          <img src="images/mastercard.png" alt="Mastercard">
                          <img src="images/american-express.png" alt="American Express">
                          <img src="images/paypal.png" alt="Paypal">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Amount Due 2/22/2014</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>$<?php echo number_format($price,2);?></td>
                                </tr>
                                <tr>
                                  <th>Tax (9.3%)</th>
                                  <td>$0.00</td>
                                </tr> 
                                <tr>
                                  <th>Total:</th>
                                  <td>$<?php echo number_format($price,2);?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default noprint pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button> 
                          <!--
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>