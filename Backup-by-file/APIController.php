<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

  use Ixudra\Curl\Facades\Curl;
  use Session;
  use Auth;
  use View;

class APIController extends Controller
{
  public function __construct()
  {
      $this->middleware('preventBackHistory')->except('logout');
      $response = Curl::to('https://cooperapp.herokuapp.com/api/getAlluser')
             ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
             ->withHeader('app_version: 1.0')
             ->withHeader('api_version: 1.0')
             ->withHeader('app_type: android')
             ->withHeader('language: en')
             ->withHeader('token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1YTNhMjdjZjU3MDFlMjAwMTQwOGVkNDYiLCJ1c2VybmFtZSI6ImFiY3h5eiIsImVtYWlsIjoic3VyYWphaGlyMThAeWFob28uaW4iLCJpYXQiOjE1MTM3NjA4MjIsImV4cCI6MTUxNjM1MjgyMn0.VIfHszkBs03iN7Z4J6aa1qAXki7MI-nK3znNBtJ_NwM')
             ->get();

               // customerName  abc
               // region ontario
               // fromDate 01-Dec-2017
               // toDate 19-Dec-2017

        $userdata_all =json_decode($response);
        $user_data = $userdata_all->data;

           View::share('user_data', $user_data);
           //return view ('admin.user_list',array('user_data' =>$user_data));

  }
   public function showLoginForm()
    {
      return view('admin.auth.login');
    }
        public function login(Request $request){

             $email = $request->email;
             $password = $request->password;
             $this->validate($request,[
                'email'=>'required',
                'password'=>'required|max:8'
             ]);

        //   $response = Curl::to('https://cooperapp.herokuapp.com/login')
        //          ->withData(['email'=>$email, 'password'=>$password])
        //          ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
        //          ->withHeader('app_version: 1.0')
        //          ->withHeader('api_version: 1.0')
        //          ->withHeader('app_type: android')
        //          ->withHeader('language: en')
        //          ->post();
        // //  $jdata =  json_encode($response);
        // //  print_r($jdata);
        //       $data =json_decode($response);
        //       $udata = $data->userData;  $data =json_decode($response);
        //       $udata = $data->userData;
        //       $_id = $udata->_id;
        //       $_status=$udata->status;
        //       $_region = $udata->region;
        //       $_phone = $udata->phone;
        //       $_email =  $udata->email;
        //       $_password =  $udata->password;
        //       $_username =  $udata->username;

         if ($email=="admin@gmail.com"&&$password=="admin123") {
                   //return view('home');

                 $request->session()->put('uname',"admin"); // set or Storing session data
                 $request->session()->put('email','admin@gmail.com');
                   //print_r($udata);
                   $_SESSION['logged_in'] = TRUE;
                // return view ('admin.home');
               return redirect()->route('admin.dashboard');
              //   return redirect()->action('APIController@get_user_all');
                  // return redirect('admin/home','username'=>$_username);
                // return redirect()->route('home',['id'=>1]); // with parameters
                     }
             else{
                 return redirect('/admin')->with('status', 'Invalid E-mail or password!');
                 }
        }

        public function dashboard(){
                  return view ('admin.home');
        }


     public function show_Call_Logs_form(){
             return view('admin.Call_Logs_form');
     }
     public function Call_Logs_admin(Request $request){

           $customerName = $request->customerName;
           $region = $request->region;
           $fromDate = $request->fromDate;
           $toDate = $request->toDate;


           // if($request->customerName){
           //    $customerName = $request->customerName;
           // }
           // else{
           //    $customerName = " ";
           // }
           //
           // if($request->region){
           //    $region = $request->region;
           // }
           // else{
           //    $region = " ";
           // }
           // if($request->fromDate){
           //    $fromDate = $request->fromDate;
           // }
           // else{
           //    $fromDate = " ";
           // }
           // if($request->toDate){
           //     $toDate = $request->toDate;
           // }
           // else{
           //    $toDate = " ";
           //  }


            // echo "1".$customerName."<br>";
            //   echo  "2".$region."<br>";
            //     echo  "3".$fromDate."<br>";
            //       echo  "4".$toDate."<br>";

           // $this->validate($request,[
           //    'customerName'=>'required',
           //    'region'=>'required',
           //    'fromDate'=>'required',
           //    'toDate'=>'required',
           // ]);



       $response = Curl::to('https://cooperapp.herokuapp.com/api/callLogsadmin')
              ->withData( array( 'customerName' => $customerName,'region' => $region,'fromDate' =>$fromDate,'toDate' => $toDate ) )
              ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
              ->withHeader('app_version: 1.0')
              ->withHeader('api_version: 1.0')
              ->withHeader('app_type: android')
              ->withHeader('language: en')
              ->withHeader('token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1YTNhMjdjZjU3MDFlMjAwMTQwOGVkNDYiLCJ1c2VybmFtZSI6ImFiY3h5eiIsImVtYWlsIjoic3VyYWphaGlyMThAeWFob28uaW4iLCJpYXQiOjE1MTM3NjA4MjIsImV4cCI6MTUxNjM1MjgyMn0.VIfHszkBs03iN7Z4J6aa1qAXki7MI-nK3znNBtJ_NwM')
              ->get();

                // customerName  abc
                // region ontario
                // fromDate 01-Dec-2017
                // toDate 19-Dec-2017

          //  dd($response);
          //  return;
         $data_all =json_decode($response);
      //   print_r($data_all);
         $CallLogs_data = $data_all->data;
        // print_r($udata);
 //return;
         return view('admin.Call_Logs_admin_list',array('CallLogs_data' =>$CallLogs_data));
     }



      public function show_profile_approval_form(){
              return view('admin.Profile_Approval');
      }

      public function profile_approval_action(Request $request){
            $email = $request->email;
            $this->validate($request,[
               'email'=>'required',
            ]);

            $response = Curl::to('https://cooperapp.herokuapp.com/api/profileApproval')
                   ->withData( array('email' => $email ) )
                   ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
                   ->withHeader('app_version: 1.0')
                   ->withHeader('api_version: 1.0')
                   ->withHeader('app_type: android')
                   ->withHeader('language: en')
                   ->withHeader('token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1YTNhMjdjZjU3MDFlMjAwMTQwOGVkNDYiLCJ1c2VybmFtZSI6ImFiY3h5eiIsImVtYWlsIjoic3VyYWphaGlyMThAeWFob28uaW4iLCJpYXQiOjE1MTM3NjA4MjIsImV4cCI6MTUxNjM1MjgyMn0.VIfHszkBs03iN7Z4J6aa1qAXki7MI-nK3znNBtJ_NwM')
                   ->post();

              $Approval_data =json_decode($response);
              //  print_r($Approval_data);
                return redirect()->back();
            ////  return;
      }

      public function get_user_all(){
        $response = Curl::to('https://cooperapp.herokuapp.com/api/getAlluser')
               ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
               ->withHeader('app_version: 1.0')
               ->withHeader('api_version: 1.0')
               ->withHeader('app_type: android')
               ->withHeader('language: en')
               ->withHeader('token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1YTNhMjdjZjU3MDFlMjAwMTQwOGVkNDYiLCJ1c2VybmFtZSI6ImFiY3h5eiIsImVtYWlsIjoic3VyYWphaGlyMThAeWFob28uaW4iLCJpYXQiOjE1MTM3NjA4MjIsImV4cCI6MTUxNjM1MjgyMn0.VIfHszkBs03iN7Z4J6aa1qAXki7MI-nK3znNBtJ_NwM')
               ->get();

                 // customerName  abc
                 // region ontario
                 // fromDate 01-Dec-2017
                 // toDate 19-Dec-2017

          $userdata_all =json_decode($response);
          $user_data = $userdata_all->data;


             return view ('admin.user_list',array('user_data' =>$user_data));
      }





//-------File Upload API ------------------------------------------------------


 public function show_file_upload_form(){
       return view('admin.file_upload');
 }

 public function file_upload_action(Request $request){

       $file = $request->file_upload;
       //dd($file);
       //return;
       // $this->validate($request,[
       //    'file_upload'=>'required|mimes:xlsx,xls,csv',
       // ]);

       $response = Curl::to('https://cooperapp.herokuapp.com/api/addCustomer')
       ->withHeader('Content-Type: application/x-www-form-urlencoded; charset=UTF-8')
       ->withHeader('app_version: 1.0')
       ->withHeader('api_version: 1.0')
       ->withHeader('app_type: android')
       ->withHeader('language: en')
       ->withHeader('token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1YTNhMjdjZjU3MDFlMjAwMTQwOGVkNDYiLCJ1c2VybmFtZSI6ImFiY3h5eiIsImVtYWlsIjoic3VyYWphaGlyMThAeWFob28uaW4iLCJpYXQiOjE1MTM3NjA4MjIsImV4cCI6MTUxNjM1MjgyMn0.VIfHszkBs03iN7Z4J6aa1qAXki7MI-nK3znNBtJ_NwM')
       ->withData( array( 'file' => $file ) )
       ->asJson()
       ->post();

      dd($response);

        return;
      //  return Response()->json($request->file);

 }


        public function logout(Request $request)
        {
             Session::flush();
            // $this->guard()->logout();
             $request->session()->flush();
             $request->session()->regenerate();
             $request->session()->regenerate(true);

             Auth::logout();
          if($request->session()->has('uname','email')){
          return $request->session()->all();
          }
             return redirect('/admin');
        }
}
