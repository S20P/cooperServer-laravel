
//App3 model function

$(function(){
   $('#Admin_Signup').click(function() {
       console.log("Registraion API is call.");

    var signup_data = $('#signup_form').serialize();
     //  console.log("form-data",signup_data);
     //   return;

    $.ajax({
            headers: {
              // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8',
              "Access-Control-Allow-Origin": "*",
              "Access-Control-Allow-Credentials": "true",
              "Access-Control-Allow-Methods": "GET,HEAD,OPTIONS,POST,PUT",
              "Access-Control-Allow-Headers": "*",
              "crossDomain": "true",
              'Accept-Language': 'en',
              "Cache-Control": "no-cache",
              "app_version":"1.0",
              "api_version":"1.0",
              "app_type":"android",
              "language":"en",
            },
            url: "https://cooperapp.herokuapp.com/registration",
            type : "POST",
            dataType: 'json',
            data: {
                  "username": "satish",
                  "password": "12345678",
                  "email": "satish6073@gmail.com",
                  "phone": "8141876148",
                  "region": "+++++"
                 },
            success: function(response)
            {
            console.log("res",response);
            },
            error: function(error)
            {
            console.log("error",error);
            },
        });
        return false;
   });

//Admin Login API

   $('#Admin_Signin').click(function() {
       console.log("Admin login API is call.");

    //var signup_data = $('#login-form').serialize();
    //   console.log("form-data",signup_data);
      // return;

      $.ajaxSetup({
          headers: {
                   'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8',
                   'app_version':"1.0",
                   'api_version':"1.0",
                   'app_type':"android",
                   'language':"en",
                   }
             });

   //  $.ajax({
   //         jsonpCallback : 'getJSON',
   //         async: true,
   //            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
   //          url: "https://cooperapp.herokuapp.com/login",
   //          type : "POST",
   //          dataType: 'json',
   //          data: {
   //                "email": "abc18@yahoo.in",
   //                "password": "12341234",
   //               },
   //          success: function(response)
   //          {
   //          console.log("res",response);
   //          },
   //          error: function(error)
   //          {
   //          console.log("error",error);
   //          },
   //      });
   //      return false;
   // });

    var email = $('#email').val();
    var password =$('#password').val();

    console.log("email is",email);
    console.log("password is",password);

       $.ajax({
          jsonpCallback : 'getJSON',
          async: true,
             // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
           url: "https://cooperapp.herokuapp.com/login",
           type : "POST",
           dataType: 'json',
           data: {
                 "email": email,
                 "password":password,
                },
           success: function(response)
           {
           console.log("res",response);
           },
           error: function(error)
           {
           console.log("error",error);
           },
       });
});



var frm = $('#file_upload_form');

 frm.submit(function (e) {

     e.preventDefault();

  // console.log("fileToUpload",fileToUpload);
  // var file = $('#file_upload_form').serialize();
  //  console.log("file API is call.",fileToUpload);
  //  var file =  $('#inlineFormInput').val();
    console.log("file",$('#inlineFormInput')[0].files[0]);

    var filedata = $('#inlineFormInput')[0].files[0];

    $.ajax({
       //jsonpCallback : 'getJSON',
      // async: true,
       processData: false,
       //mimeType: "multipart/form-data",

        //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        url: "https://cooperapp.herokuapp.com/api/addCustomer",
        type : "POST",
      //  dataType: 'json',
        data: {
              "file": filedata,
               token:"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1YTNhNWFlNjcyZjYxMjAwMTQ4NDlmYTMiLCJ1c2VybmFtZSI6ImFiYyIsImVtYWlsIjoiYWJjMThAeWFob28uaW4iLCJpYXQiOjE1MTM4MzUwMzMsImV4cCI6MTUxNjQyNzAzM30.NgGOYzizrVbwQ00nV91Pev06E6Q3582dvrYqhTBfGMU",
             },
        success: function(response)
        {
        console.log("res",response);
        },
        error: function(error)
        {
        console.log("error",error);
        },
    });

});

});



// Get User List API
// public function getAllUser(){
//
// $.ajax({
//   jsonpCallback : 'getJSON',
//   async: true,
//   headers: {
//            'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8',
//            'app_version':"1.0",
//            'api_version':"1.0",
//            'app_type':"android",
//            'language':"en",
//          },
//      // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//    url: "https://cooperapp.herokuapp.com/api/getAlluser",
//    type : "GET",
//    dataType: 'json',
//    data: {
//          "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1YTNhMjdjZjU3MDFlMjAwMTQwOGVkNDYiLCJ1c2VybmFtZSI6ImFiY3h5eiIsImVtYWlsIjoic3VyYWphaGlyMThAeWFob28uaW4iLCJpYXQiOjE1MTM3NjA4MjIsImV4cCI6MTUxNjM1MjgyMn0.VIfHszkBs03iN7Z4J6aa1qAXki7MI-nK3znNBtJ_NwM",
//         },
//    success: function(response)
//    {
//          console.log("res",response);
//    },
//    error: function(error)
//    {
//    console.log("error",error);
//    },
// });
// }
