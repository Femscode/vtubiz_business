<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BeneficiaryController as BC;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\TransactionController as TC;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailPayController;
use App\Http\Controllers\SubscriptionController;
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

Route::any('save-erion', [App\Http\Controllers\MailPayController::class, 'saveErion'])->name('saveErion');
Route::any('mailpay/process', [App\Http\Controllers\MailPayController::class, 'processCreditAlertEmails'])->name('process.emails');
Route::get('/gmail/callback', [MailPayController::class, 'handleGoogleCallback'])->name('gmail.callback');

Route::any('paystack/hook', [App\Http\Controllers\FundingController::class, 'webhook_payment_for_paystack'])->name('handlewebhook');
Route::any('flw/webhook', [App\Http\Controllers\FundingController::class, 'webhook_payment'])->name('handlewebhook');
Route::any('easywebhook', [App\Http\Controllers\FundingController::class, 'easywebhook'])->name('easywebhook');
Route::any('smartwebook', [App\Http\Controllers\FundingController::class, 'smartwebook'])->name('smartwebook');

Route::any('whatsapp/webhook', [App\Http\Controllers\FundingController::class, 'whatsapp_webhook'])->name('whatsapp_webook');
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
        Route::get('/referral_details', [ApiUserController::class, 'referral_details'])->name('referral_details');
        Route::post('/remit-earnings', [ApiUserController::class, 'remitearning'])->name('remitearning');
        Route::post('/update', [ApiUserController::class, 'updateProfile'])->name('updateProfile');
        Route::post('/update-pin', [ApiUserController::class, 'updatePin'])->name('updatePin');
        Route::post('/update-password', [ApiUserController::class, 'updatePassword'])->name('updatePassword');
        Route::post('/delete-account', [ApiUserController::class, 'deleteAccount'])->name('deleteAccount');
       //Funding
        Route::post('/generate-virtual-account', [ApiUserController::class, 'generateVirtualAccount'])->name('generateAccount');
        Route::post('/generate-permanent-account', [ApiUserController::class, 'generatePermanentAccount'])->name('generatePermanentAccount');
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

    Route::group(['prefix' => 'purchase'], function () {
        Route::get('/fetch-plan/{type}/{network}', [PurchaseController::class, 'fetchPlan'])->name('transactions');
        Route::post('/buydata', [SubscriptionController::class, 'buydata'])->name('buydata');
        Route::post('/fetch_meter_details', [App\Http\Controllers\SubscriptionController::class, 'fetch_meter_details']);
        Route::post('/buyElectricity', [App\Http\Controllers\SubscriptionController::class, 'buyElectricity']);
        Route::post('/fetch_decoder_details', [App\Http\Controllers\SubscriptionController::class, 'fetch_decoder_details']);
        Route::get('/fetch_cable_plan/{network}', [App\Http\Controllers\SubscriptionController::class, 'fetch_cable_plan']);
        Route::post('/buyCable', [App\Http\Controllers\SubscriptionController::class, 'buyCable']);
        Route::get('/get_exam_types', [App\Http\Controllers\SubscriptionController::class, 'get_exam_types']);
        Route::post('/buyExamination', [App\Http\Controllers\SubscriptionController::class, 'buyExamination']);
    
    });
});

Route::any('/auth/set-pin', [AuthController::class, 'update_password'])->name('set-pin');

//authentication route
Route::post('/password/forgot-password', [UserController::class, 'forgot_password']);
Route::post('/password/reset-password', [UserController::class, 'reset'])->name('resetpasswordfield');




// Protected Routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {});
