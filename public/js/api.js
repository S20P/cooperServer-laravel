//Import Customer

$(document).ready(function (e) {


  $("#uploadForm").on('submit', (function (e) {
    e.preventDefault();

    var valid;
    valid = validateContact();
    if (valid) {

      $('#file-info').hide();
      $("#loading").show();
      $("#loading-text").show();
      $.ajax({
        url: "https://cooperapp.herokuapp.com/api/addCustomer",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          console.log(data);
          if (data.status == "Error") {
            $("#loading").hide();
            $("#loading-text").hide();
            $('#upload-msg').html("<h1 style='font-size:18px;' class='text-danger'>" + data.message + "</h1>");
            $('#uploadForm')[0].reset();
          } else {
            $("#loading").hide();
            $("#loading-text").hide();
            $('#upload-msg').html("<h1 style='font-size:18px;' class='text-success'>" + data.message + "</h1>");
            $('#uploadForm')[0].reset();
          }

        },
        error: function (data) {
          console.log("error", data);
          $("#loading").hide();
          $("#loading-text").hide();
          $('#upload-msg').html('<h1 style="font-size:18px;" class="text-danger">No file was uploaded</h1>').fadeOut(3000);
        }
      });
    }
  }));

  $('#email_edit-info').hide();
  $('#email-info').hide();
  //add cron email using ajex...........................................................

  $("#addemailform").on('submit', (function (e) {
    e.preventDefault();
    var valid;
    valid = validateEmail_add();
    if (valid) {

      //  console.log("form-data",new FormData(this));
      var firstname = $("#firstname").val();
      var lastname = $("#lastname").val();
      var email = $("#email").val();
      var _id = $("#_id").val();


      var paramdata = [{
        "firstname": firstname,
        "lastname": lastname,
        "email": email,
        "_id": _id
      }];

      console.log("param-data", paramdata);
      var formData = $('#addemailform').serialize();
      $('#email-info').hide();
      $("#loading").show();
      $.ajaxSetup({
        headers: {
          'token': $('#token').val(),
          'Content-Type': 'application/x-www-form-urlencoded',
          'app_version': '1.0',
          'api_version': '1.0',
          'app_type': 'android',
          'language': 'en'
        }
      });
      $.ajax({
        //url: $('#addemailform').attr('action'),
        data: formData,
        url: "https://cooperapp.herokuapp.com/api/createemail",
        type: "POST",
        success: function (data) {
          console.log("dd", data);
          if (data.status == "error") {
            $("#loading").hide();
            $('#upload-msg').html("<h1 style='font-size:18px;' class='text-danger'>" + data.message + "</h1>");
            $('#addemailform')[0].reset();

          } else {
            $("#loading").hide();
            $("#loading-text").hide();
            $('#upload-msg').html("<h1 style='font-size:18px;' class='text-success'>" + data.message + "</h1>").fadeOut(3000);
            $('#addemailform')[0].reset();
            // $("#confirm-add").hide();
          //  $('#confirm-add').modal('hide');
            //  $('#confirm-add').fadeOut( "slow" );
            //   $('.modal-backdrop.in').css("opacity", 0); 
            //  window.location = "/settingEmail";
            setTimeout(function(){  
              location.reload();
              }, 1000);
            setTimeout(function(){  
              $('#confirm-add').modal('hide');
              $('.modal-backdrop.in').css("opacity", 0); 
              }, 5000);

          }
        },
        error: function (data) {
          console.log("error", data);
          $("#loading").hide();
          $("#loading-text").hide();
          $('#upload-msg').html('<h1 style="font-size:18px;" class="text-danger">"' + data.message + '"</h1>');
          //  $("#confirm-add").hide();
        }

      });
    }
  }));



  //edit cron email using ajex...........................................................

  $("#updateemailform").on('submit', (function (e) {

    console.log("form enter 1");

    e.preventDefault();
    var valid;
    valid = validateEmail_edit();
    if (valid) {

      //  console.log("form-data",new FormData(this));
      var firstname = $("#firstname").val();
      var lastname = $("#lastname").val();
      var email = $("#email_edit").val();
      var _id = $("#_id").val();
      var token = $('#token').val();

      var paramdata = {
        "token": token,
        "firstname": firstname,
        "lastname": lastname,
        "email": email,
        "_id": _id
      };

      var str = jQuery.param(paramdata);
      console.log("ppp", str);

      var fdata = JSON.stringify(paramdata);
      var formData = $('#updateemailform').serialize();

      console.log("param-data", formData);
      //var formData = $('#addemailform').serialize();
      $('#email_edit-info').hide();
      $("#loading").show();
      $.ajaxSetup({
        headers: {
          'token': $('#token').val(),
          'Content-Type': 'application/x-www-form-urlencoded',
          'app_version': '1.0',
          'api_version': '1.0',
          'app_type': 'android',
          'language': 'en'
        }
      });
      $.ajax({
        //  url: $('#addemailform').attr('action'),
        data: str,
        url: "https://cooperapp.herokuapp.com/api/createemail",
        type: "POST",
        success: function (data) {
          console.log("dd", data);
          if (data.status == "error") {
            $("#loading").hide();
            $('#edit-msg').html("<h1 style='font-size:18px;' class='text-danger'>" + data.message + "</h1>");
            $('#addemailform')[0].reset();
          } else {
            $("#loading").hide();
            $("#loading-text").hide();
            $('#edit-msg').html("<h1 style='font-size:18px;' class='text-success'>" + data.message + "</h1>").fadeOut(3000);
            $('#addemailform')[0].reset();
            var jsonData = data['data'];
           
            var email =  jsonData['email'];
            var _id =  jsonData['_id'];
            var firstname =  jsonData['firstname'];
            var lastname =  jsonData['lastname'];
            //console.log("data is updates", email);

            $('#'+_id+'_1').text(firstname);
            $('#'+_id+'_2').text(lastname);
            $('#'+_id+'_3').text(email);
            
           console.log("data is updates", jsonData);
         
           //$('#abc span').text('baa baa black sheep');

           setTimeout(function(){  
            $('#confirm-edit').modal('hide');
            $('.modal-backdrop.in').css("opacity", 0); 
           
            }, 5000);
          }
        },
        error: function (data) {
          console.log("error", data);
          $("#loading").hide();
          $("#loading-text").hide();
          $('#edit-msg').html('<h1 style="font-size:18px;" class="text-danger">"' + data.message + '"</h1>');
        }
      });
    }
  }));


});




function validateContact() {
  var valid = true;

  if (!$("#file").val()) {
    $('#file-info').show();
    $("#file-info").html('<h1 style="margin:10px;" class="text-danger">Please select a file to upload.</h1>');
    valid = false;
  } else if ($("#file").val()) {
    var image_name = $("#file").val();
    var image_extension = image_name.split('.').pop().toLowerCase();
    if (jQuery.inArray(image_extension, ['xlsx', 'xls', 'xlsm']) == -1) {
      $('#file-info').show();
      $("#file-info").html('<h1 style="margin:10px;" class="text-danger">Please upload valid excel file. The accepted formats are: .xlsx, .xlsm, .xls only.</h1>');
      valid = false;
    }
  }
  return valid;
}


function validateEmail_add() {
  var valid = true;
  console.log("email", $("#email").val());
  if (!$("#email").val()) {
    $('#email-info').show();
    $("#email-info").html("(email field is required)");
    $("#email").css('background-color', '#FFFFDF');
    valid = false;
  }
  if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
    $('#email-info').show();
    $("#email-info").html("(Invalid Email Address)");
    $("#email").css('background-color', '#FFFFDF');
    valid = false;
  }
  return valid;
}


function validateEmail_edit() {
  var valid = true;
  console.log("email", $("#email_edit").val());
  if (!$("#email_edit").val()) {
    $('#email_edit-info').show();
    $("#email_edit-info").html("(email field is required)");
    $("#email_edit").css('background-color', '#FFFFDF');
    valid = false;
  }
  if (!$("#email_edit").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
    $('#email_edit-info').show();
    $("#email_edit-info").html("(Invalid Email Address)");
    $("#email_edit").css('background-color', '#FFFFDF');
    valid = false;
  }
  return valid;
}



function confirm_edit(data) {

  $('#updateemailform')[0].reset();
  $('#email_edit-info').hide();


  var result = jQuery.parseJSON(data);
  //console.log("data is edit", result['email']);

  var _id = result['_id'];
  // var firstname = result['firstname'];
  // var lastname = result['lastname'];
  // var email = result['email'];

  var  firstname  = $.trim($('#'+_id+'_1').text());
  var  lastname   = $.trim($('#'+_id+'_2').text());
  var  email      = $.trim($('#'+_id+'_3').html());
  
  $('#_id').val(_id);
  $('#firstname').val(firstname);
  $('#lastname').val(lastname);
  $('#email_edit').val(email);
  // {"_id":"5b10fd481feb11001410d425","lastname":"","firstname":"","email":"cc@gmail.com","__v":0}

  $('#confirm-edit').modal('show');
  //$('#confirm-add').modal('show');

}



function confirm_add() {
  $('#email_edit-info').hide();
  $('#email-info').hide();
  $("#email").css('background-color', '#ffffff');
  //$('#confirm_add').modal('show');
  $('#addemailform')[0].reset();
}


allemail();
function allemail(){
console.log("get all cron-email is api is call");
var token = $('#token').val();
$.ajaxSetup({
  headers: {
    'token': $('#token').val(),
    'Content-Type': 'application/x-www-form-urlencoded',
    'app_version': '1.0',
    'api_version': '1.0',
    'app_type': 'android',
    'language': 'en'
  }
});
$.ajax({
  url: "https://cooperapp.herokuapp.com/api/getallemail",
  type: "GET",
  success: function (data) {
     if (data.status == "success") {
      console.log("success", data);
     
      console.log("jsonData", data['data']);
     var jsonData = data['data'];
    
    for(var i=0;i<jsonData.length;i++){
    //  console.log("email is ...",jsonData[i].email);
      //$("#providersFormElementsTable").html("<tr><td>email</td></tr><tr></td>"+jsonData[i].email+"</td></tr>");
      }
    } else {
      console.log("error", data);
    }
  },
  error: function (data) {
    console.log("error", data);
  }
});
}

function confirm_delet(data){

  var result = jQuery.parseJSON(data);

  console.log("c-data",result);

  // var _id = result['_id'];
  // var firstname = result['firstname'];
  // var lastname = result['lastname'];
  // var email = result['email'];

  // $('#_id').val(_id);
  // $('#firstname').val(firstname);
  // $('#lastname').val(lastname);
  // $('#email_edit').val(email);


  $('#confirm-delet').modal('show');

  console.log("confirm delete is call");

}