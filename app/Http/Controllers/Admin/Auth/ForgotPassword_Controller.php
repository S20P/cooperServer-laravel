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

class ForgotPassword_Controller extends Controller
{
  //Forgot Password  API Controller

   public function show_ForgotPassword_Form()
   {
      return view('admin.auth.ForgotPassword');
   }

    public function ForgotPassword(Request $request){

          $email = $request->email;

          $validatedData = $request->validate([
              'email' => 'required',
          ]);

          $response = Curl::to('https://cooperapp.herokuapp.com/forgotPassword')
                       ->withData( array( 'email' => $email) )
                       ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
                       ->withHeader('app_version: 1.0')
                       ->withHeader('api_version: 1.0')
                       ->withHeader('app_type: android')
                       ->withHeader('language: en')
                       ->post();

                  $data_all =json_decode($response);

              
                 if($data_all){
                   if($data_all->status=="success")
                    {
                        return redirect()->route('admin.resetPasswordOTP_form');
                      //  return redirect()->back()->with("success",$data_all->message);
                    }
                    else{
                       return redirect()->back()->with("error",$data_all->message);
                    }
                 }
              else{
                return redirect()->back()->with("error","Somthing Wrong!");
              }
        }
}
