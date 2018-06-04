<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

  use Ixudra\Curl\Facades\Curl;
  use Session;
  use Auth;
  use View;
  use Hash;
  use Config;
  use File;
  use Response;

class APIController extends Controller
{


  //private $User_Jsonfile_path;
  private $token;

  public function __construct(request $request)
  {

    //  $this->User_Jsonfile_path='upload/User_place.json'; //local
    //$this->User_Jsonfile_path='public/upload/User_place.json';  //server

      //Use middleware for logout after Browser back
        $this->middleware('preventBackHistory')->except('logout');

     //Use token everywhere
     if($request->session()->has('token')){
            $this->token = Session::get('token');

            
     }
     else{
         return redirect('/');
     }
        //$this->token = Session::get('token');

        
        

      //User list API-----------------------------------------------------------
      $response = Curl::to('https://cooperapp.herokuapp.com/api/getAlluser')
             ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
             ->withHeader('app_version: 1.0')
             ->withHeader('api_version: 1.0')
             ->withHeader('app_type: android')
             ->withHeader('language: en')
             ->withHeader("token:$this->token")
             ->get();

        if($response){
        $userdata_all =json_decode($response);
        if ($userdata_all) {

        $user_data = $userdata_all->data;
        if ($user_data) {
            
           View::share('user_data', $user_data);
        }
        else{
          View::share('user_data', "No any User Found!");
        }
        }
      }


           //return view ('admin.user_list',array('user_data' =>$user_data));

  }






        public function dashboard(){
                  return view ('admin.home');
        }


//Call Logs API-----------------------------------------------------------

     public function show_Call_Logs_form(){
             return view('admin.Call_Logs_form');
     }
     public function Call_Logs_admin(Request $request){

           $customerName = $request->customerName;
           $region = $request->region;
           $fromDate = $request->fromDate;
           $toDate = $request->toDate;

        $timezone =  date_default_timezone_get();

       $response = Curl::to('https://cooperapp.herokuapp.com/api/callLogsadmin')
              ->withData( array( 'customerName' => $customerName,'region' => $region,'fromDate' =>$fromDate,'toDate' => $toDate ) )
              ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
              ->withHeader('app_version: 1.0')
              ->withHeader('api_version: 1.0')
              ->withHeader('app_type: android')
              ->withHeader('language: en')
              ->withHeader("token:$this->token")
              ->get();

         $data_all =json_decode($response);

         //dd($data_all);

         if($data_all){
           if($data_all->status=="success"){
               if(count($data_all->data) > 0){
                 $CallLogs_data = $data_all->data;
                 $a = json_encode($data_all);
                 return view('admin.Call_Logs_admin_list',array('CallLogs_data' =>$CallLogs_data));
               }else{
                   return redirect()->back()->with("success",$data_all->message);
               }

           }
           if($data_all->status=="error"){
              return redirect()->back()->with("error",$data_all->message);
           }
      }
      else{
        return redirect()->back()->with("error","Somthing Wrong!");
      }



           }


//Profile Approve API-----------------------------------------------------------
      public function show_profile_approval_form(){
              return view('admin.Profile_Approval');
      }

      public function profile_approval_action(Request $request){
            $email = $request->email;
            $this->validate($request,[
               'email'=>'required',
            ]);



            $response = Curl::to('https://cooperapp.herokuapp.com/api/profileApproval')
                   ->withData(array('email' => $email ) )
                   ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
                   ->withHeader('app_version: 1.0')
                   ->withHeader('api_version: 1.0')
                   ->withHeader('app_type: android')
                   ->withHeader('language: en')
                   ->withHeader("token:$this->token")
                   ->post();

              $Approval_data =json_decode($response);
              //  print_r($Approval_data);
                return redirect()->back();
            ////  return;
      }





//-------File Upload API ------------------------------------------------------


 public function show_file_upload_form(){
       return view('admin.file_upload');
 }


 public function file_upload_action(Request $request){

        $file = $request->file;
        $filename = $file->getClientOriginalName();
        $filemime = $file->getMimeType();
        $fileuri = $file->getRealPath();


       $response = Curl::to('https://cooperapp.herokuapp.com/api/addCustomer')
       ->withHeader('Content-Type: application/x-www-form-urlencoded')
       ->withHeader('app_version: 1.0')
       ->withHeader('api_version: 1.0')
       ->withHeader('app_type: android')
       ->withHeader('language: en')
       ->withHeader("token:$this->token")
       ->withData( array( 'file' => $file ) )
       ->post();

      //dd($response);

        return;
      //  return Response()->json($request->file);

 }

  //-------Export Call Logs API ------------------------------------------------------

  public function Show_Export_Call_Logs_form(){
          return view('admin.Export_Call_Logs');
  }
  public function Export_Call_Logs_action(Request $request){

        $customerName = $request->customerName;
        $region = $request->region;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;


    $response = Curl::to('https://cooperapp.herokuapp.com/api/createExcel')
           ->withData( array( 'customerName' => $customerName,'region' => $region,'fromDate' =>$fromDate,'toDate' => $toDate ) )
           ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
           ->withHeader('app_version: 1.0')
           ->withHeader('api_version: 1.0')
           ->withHeader('app_type: android')
           ->withHeader('language: en')
           ->withHeader("token:$this->token")
           ->get();

      $data_all =json_decode($response);

      //$export_data = $data_all->data;

     // $a = json_encode($data_all);


      //($data_all);
   //  return redirect()->back()->with($data_all->status,$data_all->message);


           if(isset($data_all->data)){
               return redirect()->back()->with("data",  [
                  'status' => $data_all->status,
                  'message' =>$data_all->message,
                  'url' =>"http://".$data_all->data->url
               ]);
             }
             else{
               return redirect()->back()->with("data",  [
                  'status' => $data_all->status,
                  'message' =>$data_all->message
               ]);
             }


  }


 // -----end Export Call_Logs ---

 //-------Export Customer API ------------------------------------------------------

 // public function show_export_customer_form(){
 //         return view('admin.Export_Customer');
 // }
 public function export_customer_action(Request $request){



   $response = Curl::to('https://cooperapp.herokuapp.com/api/exportCustomer')
        //  ->withData( array( 'customerName' => $customerName ) )
          ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
          ->withHeader('app_version: 1.0')
          ->withHeader('api_version: 1.0')
          ->withHeader('app_type: android')
          ->withHeader('language: en')
          ->withHeader("token:$this->token")
          ->get();

     $data_all =json_decode($response);


     if(isset($data_all->data)){
         return redirect()->back()->with("data",  [
            'status' => $data_all->status,
            'message' =>$data_all->message,
            'url' =>"http://".$data_all->data->url
         ]);
       }
       else{
         return redirect()->back()->with("data",  [
            'status' => $data_all->status,
            'message' =>$data_all->message
         ]);
       }





 }



// -----end Export Customer ---

 //-------Active User API ------------------------------------------------------

  public function User_active_action(Request $request){
        $email = $request->email;
        $this->validate($request,[
           'email'=>'required',
        ]);

        $response = Curl::to('https://cooperapp.herokuapp.com/api/activeUser')
               ->withData(array('email' => $email ) )
               ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
               ->withHeader('app_version: 1.0')
               ->withHeader('api_version: 1.0')
               ->withHeader('app_type: android')
               ->withHeader('language: en')
              ->withHeader("token:$this->token")
               ->post();

          $Approval_data =json_decode($response);
          //  print_r($Approval_data);
            return redirect()->back();
        ////  return;
  }
 //-------end Active User API---


//-------Deactive User API ------------------------------------------------------

 public function User_deactive_action(Request $request){
       $email = $request->email;
       $this->validate($request,[
          'email'=>'required',
       ]);

       $response = Curl::to('https://cooperapp.herokuapp.com/api/deactiveUser')
              ->withData(array('email' => $email ) )
              ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
              ->withHeader('app_version: 1.0')
              ->withHeader('api_version: 1.0')
              ->withHeader('app_type: android')
              ->withHeader('language: en')
              ->withHeader("token:$this->token")
              ->post();

         $Approval_data =json_decode($response);
         //  print_r($Approval_data);
           return redirect()->back();
       ////  return;
 }
//-------end Deactive User API---



//-------Delete User API ------------------------------------------------------

 public function User_delete_action(Request $request){
       $email = $request->email;
       $this->validate($request,[
          'email'=>'required',
       ]);

       $response = Curl::to('https://cooperapp.herokuapp.com/api/deleteUser')
              ->withData(array('email' => $email ) )
              ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
              ->withHeader('app_version: 1.0')
              ->withHeader('api_version: 1.0')
              ->withHeader('app_type: android')
              ->withHeader('language: en')
              ->withHeader("token:$this->token")
              ->post();

         $Approval_data =json_decode($response);
         //  print_r($Approval_data);

           return redirect()->back();


       ////  return;
 }

//-------end Delete User API---


//-------Reject User API ------------------------------------------------------

 public function User_reject_action(Request $request){
       $email = $request->email;
       $this->validate($request,[
          'email'=>'required',
       ]);

       $response = Curl::to('https://cooperapp.herokuapp.com/api/rejectUser')
              ->withData(array('email' => $email ) )
              ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
              ->withHeader('app_version: 1.0')
              ->withHeader('api_version: 1.0')
              ->withHeader('app_type: android')
              ->withHeader('language: en')
              ->withHeader("token:$this->token")
              ->post();

         $Approval_data =json_decode($response);
         //  print_r($Approval_data);
           return redirect()->back();
       ////  return;
 }

//-------end Reject User API---




 public function showChangePasswordForm(){
       return view('admin.auth.changepassword');
   }

//Change password without api
   // public function changePassword(Request $request){
   //
   //         $data = file_get_contents($this->User_Jsonfile_path);
   //         $json_arr = json_decode($data, true);
   //         $match_pass = $json_arr[0]['Password'];
   //
   //
   //        if (!$request->get('current-password')===$match_pass) {
   //            // The passwords matches
   //            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
   //        }
   //
   //        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
   //            //Current password and new password are same
   //            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
   //        }
   //
   //        if($request->get('current-password')==$match_pass){
   //          foreach ($json_arr as $key => $value) {
   //              if ($value['id'] == '1') {
   //                  $json_arr[$key]['Password'] = $request->get('new-password');
   //              }
   //          }
   //          file_put_contents($this->User_Jsonfile_path, json_encode($json_arr));
   //            return redirect()->back()->with("success","Password changed successfully !");
   //        }
   //        else{
   //            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
   //        }
   //
   //        $validatedData = $request->validate([
   //            'current-password' => 'required',
   //            'new-password' => 'required|string|min:6|confirmed',
   //        ]);
   //
   //        //Change Password
   //
   //    }


 //Reset password using API
      public function changePassword(Request $request){

             // $data = file_get_contents($this->User_Jsonfile_path);
             // $json_arr = json_decode($data, true);
             // $match_pass = $json_arr[0]['Password'];


             // if (!$request->get('current-password')===$match_pass) {
             //     // The passwords matches
             //     return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
             // }

             // if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
             //     //Current password and new password are same
             //     return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
             // }

             // if($request->get('current-password')==$match_pass){
             //   foreach ($json_arr as $key => $value) {
             //       if ($value['id'] == '1') {
             //           $json_arr[$key]['Password'] = $request->get('new-password');
             //       }
             //   }
             //   file_put_contents($this->User_Jsonfile_path, json_encode($json_arr));
             //     return redirect()->back()->with("success","Password changed successfully !");
             // }
             // else{
             //     return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
             // }

          $oldPassword =  $request->get('current-password');
          $ConfirmPassword =  $request->get('new-password_confirmation');
          $newPassword =  $request->get('new-password');

          $validatedData = $request->validate([
              'current-password' => 'required',
              'new-password' => 'required|string|min:8|confirmed',
          ]);



          $response = Curl::to('https://cooperapp.herokuapp.com/api/resetPassword')
                ->withData( array( 'oldPassword' => $oldPassword,'newPassword' => $newPassword ) )
                ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
                ->withHeader('app_version: 1.0')
                ->withHeader('api_version: 1.0')
                ->withHeader('app_type: android')
                ->withHeader('language: en')
                ->withHeader("token:$this->token")
                ->post();

           $data_all =json_decode($response);


           if($data_all){
             if($data_all->status=="success"){
                return redirect()->back()->with("success",$data_all->message);
             }
             if($data_all->status=="error"){
                return redirect()->back()->with("error",$data_all->message);
             }
        }
        else{
          return redirect()->back()->with("error","Somthing Wrong!");
        }

             //Change Password

         }

//settingEmail-------------------------------------------------------

      public function show_settingEmail_page(){


      //email list API-----------------------------------------------------------
      $response = Curl::to('https://cooperapp.herokuapp.com/api/getallemail')
             ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
             ->withHeader('app_version: 1.0')
             ->withHeader('api_version: 1.0')
             ->withHeader('app_type: android')
             ->withHeader('language: en')
             ->withHeader("token:$this->token")
             ->get();

        if($response){
        $data =json_decode($response);
        if ($data) {
        $email_data = $data->data;

        $message = $data->message;
        }
      }

        return view('admin.settingEmail_page',array('email_data' =>$email_data));
      }

//Add new email --
     public function add_settingEmail(Request $request){
      
        $firstname =  $request->get('firstname');
        $lastname =  $request->get('lastname');
        $email =  $request->get('email');

        $validatedData = $request->validate([
          'email' => 'required',
         ]);

        if($firstname==null){
          $firstname =  " ";
        }else{
          $firstname =  $request->get('firstname');
        }
        if($lastname==null){
          $lastname =  " ";
        }else{
          $lastname =  $request->get('lastname');
        }
        if($email==null){
          $email =  " ";
        }else{
          $email =  $request->get('email');
        }
        

          // return response()->json([
          //           "firstname"=> $firstname,
          //           "lastname" =>  $lastname,
          //           "email"=>$email
          //         ]);
       

     $response = Curl::to('https://cooperapp.herokuapp.com/api/createemail')
           ->withData( array( 'firstname' => $firstname,'lastname' => $lastname ,'email'=>$email,'_id'=>'0') )
           ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
           ->withHeader('app_version: 1.0')
           ->withHeader('api_version: 1.0')
           ->withHeader('app_type: android')
           ->withHeader('language: en')
           ->withHeader("token:$this->token")
           ->post();

      $data_all =json_decode($response);


      if($data_all){
     
        if($data_all->status=="success"){
           return redirect()->back()->with("success",$data_all->message);
        }
        if($data_all->status=="error"){
           return redirect()->back()->with("error",$data_all->message);
        }
   }
   else{
     return redirect()->back()->with("error","Somthing Wrong!");
   }

    }

   //Update new email --
     public function update_settingEmail(Request $request){
         $_id = $request->_id;
        $firstname =  $request->get('firstname');
        $lastname =  $request->get('lastname');
        $email =  $request->get('email_edit');

        $validatedData = $request->validate([
            'email_edit' => 'required',
        ]);

     $response = Curl::to('https://cooperapp.herokuapp.com/api/createemail')
           ->withData( array( 'firstname' => $firstname,'lastname' => $lastname ,'email'=>$email,'_id'=>$_id) )
           ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
           ->withHeader('app_version: 1.0')
           ->withHeader('api_version: 1.0')
           ->withHeader('app_type: android')
           ->withHeader('language: en')
           ->withHeader("token:$this->token")
           ->post();

      $data_all =json_decode($response);


      if($data_all){
        if($data_all->status=="success"){
           return redirect()->back()->with("success",$data_all->message);
        }
        if($data_all->status=="error"){
           return redirect()->back()->with("error",$data_all->message);
        }
   }
   else{
     return redirect()->back()->with("error","Somthing Wrong!");
   }
    }

  //Delete  email --
  
    public function delete_settingEmail(Request $request){
      $_id = $request->_id;
     
     $response = Curl::to('https://cooperapp.herokuapp.com/api/deleteemailbyid')
             ->withData(array('_id' => $_id ) )
             ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
             ->withHeader('app_version: 1.0')
             ->withHeader('api_version: 1.0')
             ->withHeader('app_type: android')
             ->withHeader('language: en')
             ->withHeader("token:$this->token")
             ->get();

        //$Approval_data =json_decode($response);
        //  print_r($Approval_data);
          return redirect()->back();
      ////  return;
}

 //Logout API-----------------------------------------------------------
        public function logout(Request $request)
        {
             Session::flush();
            // $this->guard()->logout();
             $request->session()->flush();
             $request->session()->regenerate();
             $request->session()->regenerate(true);

             Auth::logout();
          if($request->session()->has('token','email')){
           return $request->session()->all();
          }
             return redirect('/');
        }


        protected function test(request $request)
        {

      return $this->token;
      //  return $request->session()->get('token');
       return Session::get('token');
      //  return $this->User_Jsonfile_path;

          $path = "upload/User_place.json";
        //  $path = "public/upload/User_place.json"; //server
           $data = file_get_contents($path);

           $json_arr = json_decode($data, true);

           foreach ($json_arr as $key => $value) {
               if ($value['id'] == '1') {
                   $json_arr[$key]['Password'] = md5("123456");
               }
           }
 // encode array to json and save to file
          file_put_contents($path, json_encode($json_arr));
          print_r($json_arr);
        }
}
