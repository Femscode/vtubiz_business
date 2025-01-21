<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BeneficiaryController as BC;
use App\Http\Controllers\Api\TransactionController as TC;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});



Route::any('paystack/webhook', [App\Http\Controllers\FundingController::class, 'webhook_payment_for_paystack'])->name('handlewebhook');
Route::any('flw/webhook', [App\Http\Controllers\FundingController::class, 'webhook_payment'])->name('handlewebhook');
Route::any('easywebhook', [App\Http\Controllers\FundingController::class, 'easywebhook'])->name('easywebhook');
Route::any('smartwebook', [App\Http\Controllers\FundingController::class, 'smartwebook'])->name('smartwebook');

//authentication 

Route::group(['prefix' => 'auth'], function () {
    Route::any('/register', [AuthController::class, 'register'])->name('signup');
    Route::post('/login', [AuthController::class, 'login'])->name('signin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/setpin', [AuthController::class, 'setpin'])->name('setpin')->middleware('auth:sanctum');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ApiUserController::class, 'index'])->name('profile');
    });
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', [TC::class, 'index'])->name('transactions');
        Route::get('/five_transactions/{type}', [TC::class, 'five_transactions'])->name('five_transactions');
        Route::get('/all_transactions', [TC::class, 'all_transactions'])->name('all_transactions');
        Route::post('/redo_transaction', [TC::class, 'redo_transaction'])->name('redo_transaction');
    });
    Route::group(['prefix' => 'beneficiary'], function () {
        Route::get('/{type}', [BC::class, 'index'])->name('transactions');
        Route::post('/create_beneficiary', [BC::class, 'create_beneficiary'])->name('create_beneficiary');
        Route::post('/remove_beneficiary', [BC::class, 'removeBeneficiary'])->name('remove_beneficiary');
      
    });
});

Route::any('/auth/set-pin', [AuthController::class, 'update_password'])->name('set-pin');

//authentication route
Route::post('/password/forgot-password', [UserController::class, 'forgot_password']);
Route::post('/password/reset-password', [UserController::class, 'reset'])->name('resetpasswordfield');




// Protected Routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {});
