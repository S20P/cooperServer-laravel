<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;
use Session;
use View;
use Hash;
use Config;
use File;
use Response;

class PasswordResetController extends Controller
{
  public function show_resetPasswordOTP_Form()
   {
      return view('admin.auth.resetPasswordOTP');
   }

 public function resetPasswordOTP(Request $request){

       $otp = $request->otp;
       $password = $request->password;
       $confirm_password = $request->confirm_password;

       $validatedData = $request->validate([
           'otp' => 'required',
           'password' => 'required',
           'confirm_password' => 'required|min:8',
       ]);

         if(!$confirm_password===$password){
             //Current password and new password are same
             return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
         }
         if($confirm_password===$password){

             $response = Curl::to('https://cooperapp.herokuapp.com/resetPasswordOTP')
                    ->withData( array( 'otp' =>$otp,'password' => $password,'confPassword' => $confirm_password ) )
                    ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
                    ->withHeader('app_version: 1.0')
                    ->withHeader('api_version: 1.0')
                    ->withHeader('app_type: android')
                    ->withHeader('language: en')
                    ->post();

               $data_all =json_decode($response);

              //dd($data_all->message);
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
         }else{
             return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
         }
}
}
