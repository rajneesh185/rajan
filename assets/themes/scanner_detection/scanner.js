$(document).ready(function(){
  var base_url = $("#base_url").val();
  var actual_count_id = $("#actual_count_id").val();
    $("#scanned_list").load(base_url+'/fixed_asset/scanned_list/'+actual_count_id); 
});

$(document).scannerDetection({ 

      // jQuery-Scanner-Detection

      timeBeforeScanTest: 200, // wait for the next character for upto 200ms
      avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
      preventDefault: true,

      endChar: [13],
        onComplete: function(barcode, qty){
       validScan = true; 

          $('#scannerInput').val (barcode);

          var base_url = $("#base_url").val();
          var actual_count_id = $("#actual_count_id").val();
          var barcode_data = this.value;  
          
          if(barcode_data){
            $("#process_scan_code").load(base_url+'/fixed_asset/user_input_barcode_scan/'+actual_count_id+'/'+barcode_data); 
            this.value='';
          }

          $("#scanned_list").load(base_url+'/fixed_asset/scanned_list/'+actual_count_id); 
          $("#scanned_list").load(base_url+'/fixed_asset/scanned_list/'+actual_count_id);
      
        } // main callback function ,
      ,
      onError: function(string, qty) {

      $('#userInput').val ($('#userInput').val()  + string);

      
      }
      
      
    });

    $('#userInput').keypress(function (e) {
      if (e.which == 13) { 
        
        var base_url = $("#base_url").val();
        var actual_count_id = $("#actual_count_id").val();
        var barcode_data = this.value;  
        
        if(barcode_data){
          $("#process_scan_code").load(base_url+'/fixed_asset/user_input_barcode_scan/'+actual_count_id+'/'+barcode_data); 
          this.value='';
        }

        $("#scanned_list").load(base_url+'/fixed_asset/scanned_list/'+actual_count_id); 
        $("#scanned_list").load(base_url+'/fixed_asset/scanned_list/'+actual_count_id);  

        return false;    //<---- Add this line
      }
    });