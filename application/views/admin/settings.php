<div class="col-md-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Settings <small>system settings</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
          
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <form method="post" action="<?php echo base_url('home/settings_update');?>" class="form-horizontal form-label-left input_mask" data-toggle="validator">

         

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Currency Type</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            
          	<select class="form-control" required="required" name="currency" id="currency">
	            <option value="">Select Currency</option> 
	            <option value="36;" <?php if($settings->currency=='36;'){echo 'selected="selected"';}?>>( &#36 ) DOLLAR SIGN</option>
	            <option value="8352;" <?php if($settings->currency=='8352;'){echo 'selected="selected"';}?>>( &#8352 ) EURO-CURRENCY SIGN</option>
				<option value="8353;" <?php if($settings->currency=='8353;'){echo 'selected="selected"';}?>>( &#8353 ) COLON SIGN</option>
				<option value="8354;" <?php if($settings->currency=='8354;'){echo 'selected="selected"';}?>>( &#8354 ) CRUZEIRO SIGN</option>
				<option value="8355;" <?php if($settings->currency=='8355;'){echo 'selected="selected"';}?>>( &#8355 ) FRENCH FRANC SIGN</option>
				<option value="8356;" <?php if($settings->currency=='8356;'){echo 'selected="selected"';}?>>( &#8356 ) LIRA SIGN</option>
				<option value="8357;" <?php if($settings->currency=='8357;'){echo 'selected="selected"';}?>>( &#8357 ) MILL SIGN</option>
				<option value="8358;" <?php if($settings->currency=='8358;'){echo 'selected="selected"';}?>>( &#8358 ) NAIRA SIGN</option>
				<option value="8359;" <?php if($settings->currency=='8359;'){echo 'selected="selected"';}?>>( &#8359 ) PESETA SIGN</option>
				<option value="8360;" <?php if($settings->currency=='8360;'){echo 'selected="selected"';}?>>( &#8360 ) RUPEE SIGN</option>
				<option value="8361;" <?php if($settings->currency=='8361;'){echo 'selected="selected"';}?>>( &#8361 ) WON SIGN</option>
				<option value="8362;" <?php if($settings->currency=='8362;'){echo 'selected="selected"';}?>>( &#8362 ) NEW SHEQEL SIGN</option>
				<option value="8363;" <?php if($settings->currency=='8363;'){echo 'selected="selected"';}?>>( &#8363 ) DONG SIGN</option>
				<option value="8364;" <?php if($settings->currency=='8364;'){echo 'selected="selected"';}?>>( &#8364 ) EURO SIGN</option>
				<option value="8365;" <?php if($settings->currency=='8365;'){echo 'selected="selected"';}?>>( &#8365 ) KIP SIGN</option>
				<option value="8366;" <?php if($settings->currency=='8366;'){echo 'selected="selected"';}?>>( &#8366 ) TUGRIK SIGN</option>
				<option value="8367;" <?php if($settings->currency=='8367;'){echo 'selected="selected"';}?>>( &#8367 ) DRACHMA SIGN</option>
				<option value="8368;" <?php if($settings->currency=='8368;'){echo 'selected="selected"';}?>>( &#8368 ) GERMAN PENNY SYMBOL</option>
				<option value="8369;" <?php if($settings->currency=='8369;'){echo 'selected="selected"';}?>>( &#8369 ) PESO SIGN</option>
				<option value="8370;" <?php if($settings->currency=='8370;'){echo 'selected="selected"';}?>>( &#8370 ) GUARANI SIGN</option>
				<option value="8371;" <?php if($settings->currency=='8371;'){echo 'selected="selected"';}?>>( &#8371 ) AUSTRAL SIGN</option>
				<option value="8372;" <?php if($settings->currency=='8372;'){echo 'selected="selected"';}?>>( &#8372 ) HRYVNIA SIGN</option>
				<option value="8373;" <?php if($settings->currency=='8373;'){echo 'selected="selected"';}?>>( &#8373 ) CEDI SIGN</option>
				<option value="8374;" <?php if($settings->currency=='8374;'){echo 'selected="selected"';}?>>( &#8374 ) LIVRE TOURNOIS SIGN</option>
				<option value="8375;" <?php if($settings->currency=='8375;'){echo 'selected="selected"';}?>>( &#8375 ) SPESMILO SIGN</option>
				<option value="8376;" <?php if($settings->currency=='8376;'){echo 'selected="selected"';}?>>( &#8376 ) TENGE SIGN</option>
				<option value="8377;" <?php if($settings->currency=='8377;'){echo 'selected="selected"';}?>>( &#8377 ) INDIAN RUPEE SIGN</option>   
				<option value="65020;" <?php if($settings->currency=='65020;'){echo 'selected="selected"';}?>>( &#65020 ) SAUDI RIYALS SIGN</option>
				<option value="x625;" <?php if($settings->currency=='x625;'){echo 'selected="selected"';}?>>( &#x625 ) ARAB EMIRATES DIRHAM SIGN</option>
	        </select>

          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Timezone </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            
            <select class="form-control" required="required" name="timezone" id="timezone">
            	  <?php 
            	  function tz_list() {
					  $zones_array = array();
					  $timestamp = time();
					  foreach(timezone_identifiers_list() as $key => $zone) {
					    date_default_timezone_set($zone);
					    $zones_array[$key]['zone'] = $zone;
					    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
					  }
					  return $zones_array;
					}
            	  ?>
	              <?php foreach(tz_list() as $t) { ?>
			      <option value="<?php print $t['zone'] ?>" <?php if($settings->timezone==$t['zone']){echo 'selected="selected"';}?>>
			        <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
			      </option>
			    <?php } ?>
	        </select>

          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">System Email </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            
            <input type="email" class="form-control" required="required" name="system_email" id="system_email" value="<?php echo $settings->system_email;?>" />

          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">GST </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
             
              <input type="text" class="form-control"  name="gst" value="<?php echo $settings->gst;?>">
              <span class="fa fa-percent form-control-feedback right" aria-hidden="true"></span>
           

          </div>
        </div>
        <!--
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Language</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" required="required">
            	<option value="AF">Afrikanns</option>
				  <option value="SQ">Albanian</option>
				  <option value="AR">Arabic</option>
				  <option value="HY">Armenian</option>
				  <option value="EU">Basque</option>
				  <option value="BN">Bengali</option>
				  <option value="BG">Bulgarian</option>
				  <option value="CA">Catalan</option>
				  <option value="KM">Cambodian</option>
				  <option value="ZH">Chinese (Mandarin)</option>
				  <option value="HR">Croation</option>
				  <option value="CS">Czech</option>
				  <option value="DA">Danish</option>
				  <option value="NL">Dutch</option>
				  <option value="EN">English</option>
				  <option value="ET">Estonian</option>
				  <option value="FJ">Fiji</option>
				  <option value="FI">Finnish</option>
				  <option value="FR">French</option>
				  <option value="KA">Georgian</option>
				  <option value="DE">German</option>
				  <option value="EL">Greek</option>
				  <option value="GU">Gujarati</option>
				  <option value="HE">Hebrew</option>
				  <option value="HI">Hindi</option>
				  <option value="HU">Hungarian</option>
				  <option value="IS">Icelandic</option>
				  <option value="ID">Indonesian</option>
				  <option value="GA">Irish</option>
				  <option value="IT">Italian</option>
				  <option value="JA">Japanese</option>
				  <option value="JW">Javanese</option>
				  <option value="KO">Korean</option>
				  <option value="LA">Latin</option>
				  <option value="LV">Latvian</option>
				  <option value="LT">Lithuanian</option>
				  <option value="MK">Macedonian</option>
				  <option value="MS">Malay</option>
				  <option value="ML">Malayalam</option>
				  <option value="MT">Maltese</option>
				  <option value="MI">Maori</option>
				  <option value="MR">Marathi</option>
				  <option value="MN">Mongolian</option>
				  <option value="NE">Nepali</option>
				  <option value="NO">Norwegian</option>
				  <option value="FA">Persian</option>
				  <option value="PL">Polish</option>
				  <option value="PT">Portuguese</option>
				  <option value="PA">Punjabi</option>
				  <option value="QU">Quechua</option>
				  <option value="RO">Romanian</option>
				  <option value="RU">Russian</option>
				  <option value="SM">Samoan</option>
				  <option value="SR">Serbian</option>
				  <option value="SK">Slovak</option>
				  <option value="SL">Slovenian</option>
				  <option value="ES">Spanish</option>
				  <option value="SW">Swahili</option>
				  <option value="SV">Swedish </option>
				  <option value="TA">Tamil</option>
				  <option value="TT">Tatar</option>
				  <option value="TE">Telugu</option>
				  <option value="TH">Thai</option>
				  <option value="BO">Tibetan</option>
				  <option value="TO">Tonga</option>
				  <option value="TR">Turkish</option>
				  <option value="UK">Ukranian</option>
				  <option value="UR">Urdu</option>
				  <option value="UZ">Uzbek</option>
				  <option value="VI">Vietnamese</option>
				  <option value="CY">Welsh</option>
				  <option value="XH">Xhosa</option>
            </select>
          </div>
        </div>
        -->
         
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-primary">Cancel</button> 
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
  $(".js-example-basic-single").select2();
});
</script>