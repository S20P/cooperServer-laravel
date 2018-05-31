




//Import Customer

      $(document).ready(function (e){


      $("#uploadForm").on('submit',(function(e){
      e.preventDefault();

       var valid;
      valid = validateContact();
      if(valid) {

     $('#file-info').hide();
  $("#loading").show();
  $("#loading-text").show();
      $.ajax({
      url: "https://cooperapp.herokuapp.com/api/addCustomer",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
      console.log(data);
        if(data.status=="Error"){
          $("#loading").hide();
          $("#loading-text").hide();
          $('#upload-msg').html("<h1 style='font-size:18px;' class='text-danger'>"+data.message+"</h1>");
          $('#uploadForm')[0].reset();
        }
        else{
          $("#loading").hide();
          $("#loading-text").hide();
          $('#upload-msg').html("<h1 style='font-size:18px;' class='text-success'>"+data.message+"</h1>");
           $('#uploadForm')[0].reset();
        }

      },
      error: function(data){
        console.log("error",data);
         $("#loading").hide();
         $("#loading-text").hide();
         $('#upload-msg').html('<h1 style="font-size:18px;" class="text-danger">No file was uploaded</h1>').fadeOut(3000);;
      }
      });
    }
      }));
});


function validateContact() {
 var valid = true;

 if(!$("#file").val()) {
   $('#file-info').show();
   $("#file-info").html('<h1 style="margin:10px;" class="text-danger">Please select a file to upload.</h1>');
     valid = false;
 }else if($("#file").val()){
  var image_name = $("#file").val();
  var image_extension = image_name.split('.').pop().toLowerCase();
  if(jQuery.inArray(image_extension,['xlsx','xls','xlsm']) == -1){
    $('#file-info').show();
    $("#file-info").html('<h1 style="margin:10px;" class="text-danger">Please upload valid excel file. The accepted formats are: .xlsx, .xlsm, .xls only.</h1>');
    valid = false;
  }
}
return valid;
}
