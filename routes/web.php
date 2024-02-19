<?php

use App\Http\Controllers\about_controller;
use App\Http\Controllers\components_controller;
use App\Http\Controllers\contacts_controller;
use App\Http\Controllers\index_controller;
use App\Http\Controllers\loginregistration;
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

Route::get('/components',[components_controller::class, 'components'])->name('components');
Route::get('/about',[about_controller::class, 'about'])->name('about');
Route::get('/contact',[contacts_controller::class, 'contact'])->name('contact');
Route::get('/index',[index_controller::class, 'index'])->name('index');
Route::get('/login',[loginregistration::class, 'login'])->name('login');
Route::get('/registration',[loginregistration::class, 'registration'])->name('registration');
Route::post('/login',[loginregistration::class, 'loginPost'])->name('loginpost');
Route::post('/registration',[loginregistration::class, 'registrationPost'])->name('registrationpost');
