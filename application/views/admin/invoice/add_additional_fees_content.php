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
        <h2>Set Invoice Additional Fees <small>forms</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
            
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url();?>invoice/save_billing_address/<?php echo en($id,$this->config->item('openssl_key'));?>" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

           

          <table class="table table-border" id="myTable">
            <tr>
              <th>Description</th>
              <th>Amount</th>
              <th>Options</th> 
            </tr>
            <tr>
              <td><input type="text" class="form-control" name="ds" id="ds" /></td>
              <td><input type="text" class="form-control" name="amount" id="amount" /></td>
              <td><a href="Javascript:add()" class="btn btn-primary">add</a></td>
            </tr>
            <?php if($invoice_fee){
              foreach($invoice_fee as $rs){?>
            <tr id="frow<?php echo $rs->id;?>">
              <td><?php echo $rs->title;?></td>
              <td align="right"><?php echo number_format($rs->amount, 2);?></td>
              <td><a href="Javascript:rev(<?php echo $rs->id;?>)">remove</a></td>
            </tr>
          <?php }}?>
          
          </table>

        </form>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
  function add(){
    var ds = document.getElementById('ds').value; 
    var amount = document.getElementById('amount').value; 

    if(ds == '' || amount == ''){
      alert('description and title required.');
    }else{
      $.post("<?php echo base_url();?>invoice/save_fee/<?php echo en($id,$this->config->item('openssl_key'));?>",
      {
        amount: amount,
        ds: ds
      },
      function(id,stat){ 
         $('#myTable tr:last').after('<tr id="frow'+id+'"><td>'+ds+'</td><td>'+amount+'</td><td><a href="Javascript:rev('+id+')">remove</a></td></tr>');
         document.getElementById('ds').value = ''; 
         document.getElementById('amount').value = '';  
      }); 
    }
  }

  function rev(id){
    
     $.post("<?php echo base_url();?>invoice/remove_fee/" + id,
    {
      id: id 
    },
    function(id,stat){
    $('#frow' + id).remove();  
    }); 
  }
</script>


