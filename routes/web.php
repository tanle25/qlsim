<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InviteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimCardController;
use App\Http\Controllers\LeechContentController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SocicalAuthenticateController;
use App\Models\User;

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
Route::get('test', function(){
    $user = User::find(5)->sims;
    dd($user);
});

Route::get('login',[AuthController::class,'showLoginForm']);
Route::post('login',[AuthController::class,'login'])->name('login');
// google login
Route::get('login/google',[SocicalAuthenticateController::class,'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback',[SocicalAuthenticateController::class,'handleGoogleCallback']);

// Facebook login

Route::get('login/facebook',[SocicalAuthenticateController::class,'redirectToFacebook'])->name('facebook.login');
Route::get('login/facebook/callback',[SocicalAuthenticateController::class,'handleFacebookCallback']);

Route::post('logout',[AuthController::class,'logout']);
Route::get('dang-ky',[AuthController::class,'showRegisterForm'])->middleware('guest');
Route::post('register',[AuthController::class,'register']);
Route::post('register-verify',[AuthController::class,'verify']);
Route::post('verify-otp',[AuthController::class,'verifyOtp']);
Route::post('forgot-password',[AuthController::class,'forgotPassword']);
Route::post('reset-password',[AuthController::class,'changePassword']);
Route::get('verify-user',function(){
    return view('login.otp');
})->middleware('verify_user');
Route::get('verify-otp',function(){
    return view('login.forgot-password-otp');
})->middleware('verify_user');

Route::get('mail-view',function(){
    return view('login.verify-email');
});
Route::get('quen-mat-khau', function(){
    return view('login.forgot-password');
});
Route::get('reset-password', function(){
    return view('login.reset-password');
});


Route::post('tim-nguoi-dung',[InviteController::class,'searchUser']);
Route::get('images-cli',[LeechContentController::class,'images']);
Route::get('get-wifi-network/{id}',[RequestController::class,'edit']);


Route::group(['middleware'=>['auth']],function(){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('get-wifi-request/{id}',[RequestController::class,'editRequest']);
    Route::post('update-wifi-request',[RequestController::class,'updateRequest']);
    Route::get('danh-sach-yeu-cau',[RequestController::class,'index']);
    Route::get('khach-hang',[CustomerController::class,'index']);
    Route::post('create-old-wifi-request',[RequestController::class,'createOldRequest']);
    Route::post('create-new-wifi-request',[RequestController::class,'createNewRequest']);
    Route::get('tu-choi/{token}/{notify}',[InviteController::class,'decline']);
    Route::get('dong-y/{token}/{notify}',[InviteController::class,'accept']);
});


Route::get('change-lang/{lang}',[HomeController::class,'changeLang']);
Route::post('toggle-dark-mode',[HomeController::class,'toggleDarkMode']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
