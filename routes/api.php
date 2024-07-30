<?php

use App\Http\Controllers\Api\User\ChangePasswordController;
use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\User\LogoutController;
use App\Http\Controllers\Api\User\RegisterController;
use App\Http\Controllers\Api\User\ResendOtpController;
use App\Http\Controllers\Api\User\VerifyOtpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('user')->group(function () {

    # user  registration varifyotp login 
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/verify-otp', [VerifyOtpController::class, 'verifyOtp']);
    Route::post('/resend-otp', [ResendOtpController::class, 'resendOtp']);
    Route::post('/login', [LoginController::class, 'login']);
});



// protected route
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->group(function () {

        #Logout & Password Change
        Route::post('/logout', [LogoutController::class, 'logout']);
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword']);

    });
});
