<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::group(['middleware' => ['web']], function () {
Route::get('/', function () {
  return view('admin.auth.login');
});

//Admin Registration
    Route::get('/registration','Admin\Auth\RegisterController@show_signup_Form')->name('admin.register_form');
    Route::post('/registration', 'Admin\Auth\RegisterController@registration')->name('admin.register');

//Forgot Password
     Route::get('/ForgotPassword','Admin\Auth\ForgotPassword_Controller@show_ForgotPassword_Form')->name('admin.ForgotPassword_form');
     Route::post('/ForgotPassword','Admin\Auth\ForgotPassword_Controller@ForgotPassword')->name('admin.ForgotPassword');

 //resetPasswordOTP
    Route::get('/resetPasswordOTP','Admin\Auth\PasswordResetController@show_resetPasswordOTP_Form')->name('admin.resetPasswordOTP_form');
    Route::post('/resetPasswordOTP','Admin\Auth\PasswordResetController@resetPasswordOTP')->name('admin.resetPasswordOTP');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin' ], function () {

      //  Route::get('/', 'APIController@showLoginForm');
        // Route::get('/', function () {
        //    return back()->with('status', 'Invalid E-mail or password!');
        //         });



     //Admin Login
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.loginform');
        Route::post('/dashboard', 'Auth\LoginController@login')->name('admin.login');

      Route::group(['middleware' => 'admin.auth'], function () {

              Route::get('dashboard', 'APIController@dashboard')->name('admin.dashboard');
              Route::get('home', 'HomeController@index')->name('admin.home');
              Route::post('logout', 'APIController@logout')->name('admin.logout');

              //Admin Call_Logs
              Route::get('/Call_Logs_form', 'APIController@show_Call_Logs_form')->name('admin.Call_Logs_form');
              Route::post('/Call_Logs_admin', 'APIController@Call_Logs_admin')->name('admin.Call_Logs_list');

              Route::post('/Call_Logs_admin',[
                'uses'=>'APIController@Call_Logs_admin',
                'middleware' => 'admin.auth'
               ])->name('admin.Call_Logs_list');


            //Profile_Approval
               Route::get('/profile_approval', 'APIController@show_profile_approval_form')->name('admin.prof_approv_form');
               Route::post('/profile_approval_done', 'APIController@profile_approval_action')->name('admin.profile_approval_api');

          //Active User
              Route::post('/User_active', 'APIController@User_active_action')->name('admin.User_active_api');

           //Deactive User
               Route::post('/User_deactive', 'APIController@User_deactive_action')->name('admin.User_deactive_api');

           //Delete User
               Route::post('/User_delete', 'APIController@User_delete_action')->name('admin.User_delete_api');

           //Reject User
               Route::post('/User_reject', 'APIController@User_reject_action')->name('admin.User_reject_api');

           //File_Upload
               Route::get('/file_upload', 'APIController@show_file_upload_form')->name('admin.fileupload_form');
               Route::post('/file_upload_call', 'APIController@file_upload_action')->name('admin.fileupload_api');

           //Export  Call_Logs
               Route::get('/Export_Call_Logs', 'APIController@Show_Export_Call_Logs_form')->name('admin.Export_Call_Logs');
               Route::post('/Export_Call_Logs', 'APIController@Export_Call_Logs_action')->name('admin.Export_Call_Logs_api');

           //Export Customer
               Route::get('/Export_Customer', 'APIController@show_export_customer_form')->name('admin.Export_Customer');
               Route::post('/Export_Customer', 'APIController@export_customer_action')->name('admin.Export_Customer_api');

            //change Passwords
               Route::get('/changePassword','APIController@showChangePasswordForm')->name('admin.changePassword_form');
               Route::post('/changePassword','APIController@changePassword')->name('admin.changePassword');

            //Admin crossemail
            Route::get('/settingEmail','APIController@show_settingEmail_page')->name('admin.settingEmail_page');
            Route::post('/settingEmail/add', 'APIController@add_settingEmail')->name('admin.add_settingEmail');
            Route::post('/settingEmail/update', 'APIController@update_settingEmail')->name('admin.update_settingEmail');
            Route::post('/settingEmail/delete', 'APIController@delete_settingEmail')->name('admin.delete_settingEmail');
   
          //test
             Route::get('/test','APIController@test');

        });
});
});
