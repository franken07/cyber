<?php

use App\Http\Controllers\about_controller;
use App\Http\Controllers\Apointmentcontroller;
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


Route::get('/reset-request', [ResetPasswordController::class, 'forgetpassword'])->name('forget.password');
Route::post('/reset-request', [ResetPasswordController::class, 'forgetpasswordpost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetpassword'])->name('reset.password');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');

Route::get('/admin', [Productcontroller::class, 'admin'])->name('admin');
Route::post('/admin', [Productcontroller::class, 'addProduct'])->name('addProduct');
Route::get('/delivered/{id}', [Productcontroller::class, 'delivered'])->name('delivered');
Route::post('/delivered/{id}', [ProductController::class, 'delivered'])->name('delivered');

Route::post('/cart/{id}', [Productcontroller::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [Productcontroller::class, 'checkout'])->name('checkout');
Route::delete('/remove-cart/{order}', [Productcontroller::class, 'removeCartItem'])->name('remove_cart');
Route::match(['post', 'delete'], '/checkout', [Productcontroller::class, 'checkoutprod'])->name('checkoutprod');


Route::get('/admin', [Productcontroller::class, 'editDeleteProducts'])->name('edit_delete_products');
Route::put('/admin/products/{id}', [Productcontroller::class, 'editProduct'])->name('edit_product');
Route::delete('/admin/products/{productId}', [Productcontroller::class, 'deleteProduct'])->name('delete_product');
Route::get('/admin/products/{id}/edit', [Productcontroller::class, 'editprod'])->name('editprod');


Route::get('/billing', [Productcontroller::class, 'billingshow'])->name('billing'); // Route to display billing information form
Route::put('/billing', [Productcontroller::class, 'updateBilling'])->name('billing.buy');

<<<<<<< Updated upstream
Route::delete('/product/delete/{productId}', [ProductController::class, 'deleteProduct'])->name('product.delete');
Route::put('/product/update/{id}', [ProductController::class, 'editProduct'])->name('product.update');
=======
Route::get('/appointments', [Apointmentcontroller::class, 'indexappointment'])->name('appointments.index');

// Route for adding appointment
Route::post('/appointments/add', [Apointmentcontroller::class, 'addappointment'])->name('appointments.add');
Route::match(['post', 'delete'],'/reservation/{id}', [Apointmentcontroller::class, 'Reservation'])->name('reservation');

Route::match(['post', 'get'],'reservations/{id}/mark-reserved', [Apointmentcontroller::class, 'markReserved'])->name('reservation.markReserved');
Route::delete('reservations/{id}', [Apointmentcontroller::class, 'destroy'])->name('reservation.destroy');
>>>>>>> Stashed changes
