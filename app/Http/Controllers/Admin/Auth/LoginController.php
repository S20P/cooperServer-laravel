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
class LoginController extends Controller
{
    public function __construct()
    {
    }




    //Login API-----------------------------------------------------------

       public function showLoginForm()
        {
          return view('admin.auth.login');
        }

        // This login function is static without call API
            // public function login123123(Request $request){
            //
            //      $email = $request->email;
            //      $password = $request->password;
            //      $this->validate($request,[
            //         'email'=>'required',
            //         'password'=>'required|max:8'
            //      ]);
            //
            //      $data = file_get_contents($this->User_Jsonfile_path);
            //      $json_arr = json_decode($data, true);
            //
            //      $match_pass = $json_arr[0]['Password'];
            //      $UserName   = $json_arr[0]['UserName'];
            //      //$password   = md5($password);
            //
            //
            //  if ($email==$UserName&&$password==$match_pass) {
            //            //return view('home');
            //          $request->session()->put('uname',"admin"); // set or Storing session data
            //          $request->session()->put('email','admin@gmail.com');
            //
            //            //print_r($udata);
            //            $_SESSION['logged_in'] = TRUE;
            //
            //        return redirect()->route('admin.dashboard');
            //    }
            //      else{
            //          return redirect('/admin')->with('status', 'Invalid E-mail or password!');
            //          }
            // }



    //Login Using API
            public function login(Request $request){

              $email = $request->email;
              $password = $request->password;
              $this->validate($request,[
                 'email'=>'required',
                 'password'=>'required|min:8'
              ]);

              $response = Curl::to('https://cooperapp.herokuapp.com/login')
                     ->withData( array('email' => $email,'password' => $password ) )
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
                   $request->session()->put('token',$data_all->token);
           //   return redirect()->back()->with("success",$data_all->message);
                  if($data_all->userData){
                       $isadmin = $data_all->userData->isAdmin;
                       $udata = $data_all->userData;
                        if($isadmin=="true"){
                          $request->session()->put('uname',$udata->email); // set or Storing session data
                          $request->session()->put('email',$udata->email);
                          Session::put('token',$data_all->token);
                            //print_r($udata);
                            $_SESSION['logged_in'] = TRUE;

                        return redirect()->route('admin.dashboard');
                        }
                        else{
                          return redirect()->back()->with("error","Invalid Credentials.");
                        }
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



    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
