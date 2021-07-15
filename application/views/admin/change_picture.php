<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Profile <small>change picture</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

		<form method="post" action="<?php echo base_url();?>home/upload_profile_picture" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

				<input type='file' id="imgInp1" name="profile_pic" class="form-control col-md-7 col-xs-12" />
                <img id="blah1" src="<?php echo base_url('assets/images/blank.jpg');?>" alt="image 1" height="30%" width="30%" />
		      
		        <div class="ln_solid"></div>
		          <div class="form-group">
		            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		              <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button> 
		              <button type="submit" class="btn btn-success">Save</button>
		            </div>
		          </div>
		     
		     
		</form>

	</div>

  </div>
 </div>
</div>

<script type="text/javascript">

function readURL(input,num) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah'+num).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp1").change(function(){
readURL(this,1);
});

</script>