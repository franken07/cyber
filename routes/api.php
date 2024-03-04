<?php

use App\Http\Controllers\about_controller;
use App\Http\Controllers\components_controller;
use App\Http\Controllers\contacts_controller;
use App\Http\Controllers\index_controller;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\ResetPasswordController;
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


Route::get('/about',[about_controller::class, 'about'])->name('about');
Route::get('/contact',[contacts_controller::class, 'contact'])->name('contact');
Route::get('/index',[index_controller::class, 'index'])->name('index');
Route::get('/components',[Productcontroller::class, 'components'])->name('components');

Route::put('/users/{id}/update-usertype', [Authentication::class, 'updateUserType'])->name('users.update-usertype');
Route::get('/login', [Authentication::class, 'login'])->name('login');
Route::post('/login', [Authentication::class, 'loginPost'])->name('login.post');
Route::get('/registration', [Authentication::class, 'registration'])->name('registration');
Route::post('/registration', [Authentication::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [Authentication::class, 'logout'])->name('logout');
Route::get('/users', [Authentication::class, 'getalluser'])->name('users.getall');
Route::get('/allusers', [Authentication::class, 'alluser'])->name('allusers');

Route::get('/reset-request', [ResetPasswordController::class, 'showResetRequestForm'])->name('reset.request.form');
Route::post('/reset-request', [ResetPasswordController::class, 'showResetPasswordPost'])->name('reset.request.post');
Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');

Route::get('/admin', [ProductController::class, 'admin'])->name('admin');
Route::post('/admin', [Productcontroller::class, 'addProduct'])->name('addProduct');
Route::get('/userPurchases', [ProductController::class, 'userPurchases'])->name('user.purchases');  
Route::get('/delivered/{id}', [ProductController::class, 'delivered'])->name('delivered');
Route::post('/delivered/{id}', [ProductController::class, 'delivered'])->name('delivered');

Route::post('/cart/{id}', [Productcontroller::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [Productcontroller::class, 'checkout'])->name('checkout');
Route::get('/remove_cart/{id}', [Productcontroller::class, 'remove_cart'])->name('remove_cart');
Route::delete('/remove_cart/{id}', [Productcontroller::class, 'remove_cart'])->name('remove_cart');
Route::get('/checkout', [ProductController::class, 'checkoutprod'])->name('checkoutprod');
Route::post('/checkout', [ProductController::class, 'checkoutprod'])->name('checkoutprod');

Route::get('/admin', [ProductController::class, 'editDeleteProducts'])->name('edit_delete_products');
Route::put('/admin/products/{id}', [ProductController::class, 'editProduct'])->name('edit_product');
Route::delete('/admin/products/{productId}', [ProductController::class, 'deleteProduct'])->name('delete_product');
Route::get('/admin/products/{id}/edit', [ProductController::class, 'editprod'])->name('editprod');
