<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::view('/','admin.dashboard')->name('admin.dashboard');    
// Route::get('/new', [LoginController::class, 'new']);


Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login.form');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login');


Route::middleware('auth:admin')->group(function () {

  Route::get('/admin/dashboard', [LoginController::class, 'dashboard'])->name('admin.dashboard');
  Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');


  // password change
  Route::get('/admin/change-password',[LoginController::class,'changePassword'])->name('admin.change-password');
  Route::post('/admin/change-password', [LoginController::class, 'storePassword'])->name('admin.store-password');
  
});
