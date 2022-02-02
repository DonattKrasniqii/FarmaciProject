<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DrugsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Jobs\TestJob;
use App\Mail\WelcomeMail;
use App\Models\Drug;
use App\Models\ProfileViews;
use App\Models\User;
use App\Notifications\JuniorParrotAPI;
use App\Notifications\SlackMessageAPI;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('login', [HomeController::class, 'auth']);
Route::get('auth', [HomeController::class, 'auth']);
Route::get('login', [HomeController::class, 'auth']);
Route::post('auth-register', [HomeController::class, 'authRegister']);
Route::get('reload-captcha', [HomeController::class, 'reloadCaptcha']);
Route::post('auth-login', [HomeController::class, 'authLogin'])->middleware('checkUserStatus');
Route::get('auth-logout', [HomeController::class, 'logout']);
Route::get('auth-password-reset', [HomeController::class, 'resetPasswordView']);
Route::post('auth-password-reset-save', [HomeController::class, 'resetPassword']);
Route::get('reset-password/{token}', [HomeController::class, 'resetPasswordFinal']);
Route::post('reset-password', [HomeController::class, 'resetPasswordViaEmail']);
Route::get('success-reset-password', [HomeController::class, 'successfulResetPasswordNote']);

Route::get('view/{id}', [DrugsController::class, 'viewDrug']);
Route::get('contact', [ContactController::class, 'contactView']);
Route::post('save-contact', [ContactController::class, 'saveContact']);
Route::get('store/{id}', [UserController::class, 'viewStore']);
Route::post('save-order', [OrdersController::class, 'saveOrder']);
Route::group(['prefix' => 'blog'], function () {
    Route::get('/', [BlogController::class, 'getBlogs']);
    Route::get('view/{id}', [BlogController::class, 'viewBlog']);
});



Route::get('/testime',function (){

return motivational_qoute();


});



//WEB DASHBOARD ROUTES
include 'modules/web-dashboard.php';



