<?php

use App\Http\Controllers\about_controller;
use App\Http\Controllers\components_controller;
use App\Http\Controllers\contacts_controller;
use App\Http\Controllers\index_controller;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Productcontroller;
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

Route::get('/', function () {
    return view('index');
});

Route::get('/users', [Authentication::class, 'getalluser'])->name('getalluser');


Route::get('/components',[components_controller::class, 'components'])->name('components');
Route::get('/about',[about_controller::class, 'about'])->name('about');
Route::get('/contact',[contacts_controller::class, 'contact'])->name('contact');
Route::get('/index',[index_controller::class, 'index'])->name('index');


Route::get('/login',[Authentication::class, 'login'])->name('login');
Route::post('/login',[Authentication::class,'loginPost'])->name('login.post');
Route::get('/registration',[Authentication::class,'registration'])->name('registration');
Route::post('/registration',[Authentication::class,'registrationPost'])->name('registration.post');
Route::get('/logout',[Authentication::class,'logout'])->name('logout');

Route::get('/reset-request', [ResetPasswordController::class, 'showResetRequestForm'])->name('reset.request.form');
Route::post('/reset-request', [ResetPasswordController::class, 'showResetPasswordPost'])->name('reset.request.post');
Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');


Route::get('/admin',[Productcontroller::class, 'admin'])->name('admin');
Route::post('/admin',[Productcontroller::class, 'addProduct'])->name('addProduct');
Route::get('/components',[Productcontroller::class, 'components'])->name('components');
Route::post('/cart', [Productcontroller::class, 'add'])->name('cart.add');
Route::post('/checkout', [Productcontroller::class, 'checkout'])->name('checkout');
Route::get('/cart', [Productcontroller::class, 'cart'])->name('cart');