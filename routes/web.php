<?php

use App\Models\Data;
use App\Models\User;
use App\Models\Cable;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BulkSMSController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\LoginWithGoogleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [BusinessController::class, 'index'])->name('homepage');

Route::any('update_account_data', function () {
    $themes = Data::where('user_id', 0)->get();
    foreach ($themes as $theme) {
        $theme->account_price = intval(0.05 * $theme->data_price) + intval($theme->data_price);
        $theme->save();
    }
});


require __DIR__.'/auth.php';
// Auth::routes();
Route::any('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
    

Route::any('/upgrade/{id}', [BusinessController::class, 'upgrade'])->name('upgrade');
Route::any('/saveBeneficiary', [BusinessController::class, 'saveBeneficiary'])->name('saveBeneficiary');
Route::any('/removeBeneficiary', [BusinessController::class, 'removeBeneficiary'])->name('removeBeneficiary');

Route::get('/delete_group/{id}', [BulkSMSController::class, 'deleteGroup'])->name('delete_group');
Route::any('/saveContacts', [BulkSMSController::class, 'saveContacts'])->name('saveContacts');
Route::post('/submitSMSForm', [BulkSMSController::class, 'submitSMSForm'])->name('submitSMSForm');
Route::post('/sendSMS2', [BulkSMSController::class, 'sendSMS2'])->name('sendSMS2');
Route::any('/resend_sms/{id}', [BulkSMSController::class, 'resendSMS'])->name('resend_sms');

//the subdomain website routes
Route::middleware(['auth'])->group(function () {
    // Auth::routes();

    Route::any('/premium-verify_purchase/{ref?}', [SubscriptionController::class, 'verify_purchase'])->name('verify_purchase');
    Route::any('/premium-verify_payment/{ref?}', [SubscriptionController::class, 'verify_payment'])->name('verify_payment');
    Route::post('/premium-check_verify_purchase', [SubscriptionController::class, 'check_verify_purchase'])->name('check_verify_purchase');
    Route::any('/premium-check_verify_payment', [SubscriptionController::class, 'check_verify_payment'])->name('check_verify_payment');


    // Route::get('/', [BusinessController::class, 'landing'])->name('index');
   
    // Route::view('/','coming_soon');
    // Route::any('/notify', [App\Http\Controllers\SubscriptionController::class, 'notify'])->name('notify');
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');
    Route::any('addfee', function () {
        $datas = Cable::all();
        foreach ($datas as $data) {
            $data->real_price = $data->actual_price + (0.1 * $data->actual_price);
            $data->save();
        }
        return 'fee added';
    });
    // Route::view('offline', 'offline');
    Route::any('fetch_email', function () {
        $datas = User::get()->pluck('email');

        return $datas;
    });
    Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle']);
    Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');
    Route::get('/sample_import_data', [App\Http\Controllers\PayrollController::class, 'sample_import_data'])->name('sample_import_data');


    Route::get('/my-dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('customer_dashboard');
    Route::post('/process_order', [App\Http\Controllers\HomeController::class, 'process_order'])->name('process_order');
    Route::get('/delete_order', [App\Http\Controllers\HomeController::class, 'delete_order'])->name('delete_order');
    // Route::post('/updateprofile', [App\Http\Controllers\HomeController::class, 'updateprofile'])->name('updateprofile');
    Route::post('/setpin', [App\Http\Controllers\HomeController::class, 'setpin'])->name('setpin');
    Route::get('my-profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::get('user-fundwallet', [App\Http\Controllers\HomeController::class, 'fundwallet'])->name('fundwallet');


    Route::post('/checkout/{checkout?}', [App\Http\Controllers\FundingController::class, 'checkout'])->name('checkout');
    // Route::get('withdraw', [App\Http\Controllers\HomeController::class, 'withdraw'])->name('withdraw');
    // Route::any('confirm_account', [HomeController::class, 'confirm_account'])->name('confirm_account');
    // Route::any('make_transfer', [HomeController::class, 'make_transfer'])->name('make_transfer');

    Route::get('resend_verification', [App\Http\Controllers\HomeController::class, 'resend_verification'])->name('resend_verification');
    Route::get('transactions', [App\Http\Controllers\HomeController::class, 'transactions'])->name('transactions');
    Route::get('premium-bulksms_transactions', [App\Http\Controllers\HomeController::class, 'bulksms_transactions'])->name('bulksms_transactions');
    Route::get('analysis', [App\Http\Controllers\HomeController::class, 'analysis'])->name('analysis');
    Route::post('changePhoneAnalysis', [App\Http\Controllers\HomeController::class, 'analysis'])->name('analysis');
    Route::get('transfer', [App\Http\Controllers\FundingController::class, 'transfer'])->name('transfer');
    // Route::get('pay_cttaste/{slug}', [App\Http\Controllers\FundingController::class, 'pay_cttaste'])->name('pay_cttaste');
    // Route::post('make_transfer', [App\Http\Controllers\FundingController::class, 'make_transfer'])->name('make_transfer');
    Route::post('pay_for_order', [App\Http\Controllers\FundingController::class, 'pay_for_order'])->name('pay_for_order');
    Route::post('verify_id', [App\Http\Controllers\FundingController::class, 'verify_id'])->name('verify_id');
    Route::post('verify_order', [App\Http\Controllers\FundingController::class, 'verify_order'])->name('verify_order');
    Route::post('/pay', [App\Http\Controllers\FundingController::class, 'redirectToGateway'])->name('pay');
    Route::get('/payment/callback', [App\Http\Controllers\FundingController::class, 'handleGatewayCallback']);
    Route::get('/reserve_account', [App\Http\Controllers\FundingController::class, 'reserve_account']);
    Route::post('monnify/transaction_complete', [App\Http\Controllers\MonnifyController::class, 'monnifyTransactionComplete2']);
    //subscription routes
    Route::get('/premium-data', [App\Http\Controllers\SubscriptionController::class, 'data']);
    Route::post('/redo_transaction', [App\Http\Controllers\SubscriptionController::class, 'redo_transaction']);
    Route::get('/premium-airtime', [App\Http\Controllers\SubscriptionController::class, 'airtime']);
    Route::get('/premium-electricity', [App\Http\Controllers\SubscriptionController::class, 'electricity']);
    Route::get('/premium-cable', [App\Http\Controllers\SubscriptionController::class, 'cable']);
    Route::get('/premium-examination', [App\Http\Controllers\SubscriptionController::class, 'examination']);
    Route::get('/premium-bulksms', [App\Http\Controllers\SubscriptionController::class, 'bulksms']);
    Route::get('/premium-contact_group', [App\Http\Controllers\SubscriptionController::class, 'contact_group']);


    Route::get('/premium-data_group', [App\Http\Controllers\GroupController::class, 'data_group'])->name('data_group');
    Route::post('/createGroup', [App\Http\Controllers\GroupController::class, 'admin_createGroup'])->name('admin_createGroup');
    Route::post('/recharge_group/', [App\Http\Controllers\SubscriptionController::class, 'admin_rechargeGroup'])->name('admin_rechargeGroup');
    Route::get('/premium-group_transactions/{id}', [App\Http\Controllers\GroupController::class, 'group_transactions'])->name('group_transactions');
    Route::post('/deleteGroup/{id}', [App\Http\Controllers\GroupController::class, 'admin_deleteGroup'])->name('admin_deleteGroup');
    Route::get('/premium-data_recipient/{id}', [App\Http\Controllers\GroupController::class, 'data_recipient'])->name('data_recipient');
    Route::post('/saveRecipient', [App\Http\Controllers\GroupController::class, 'admin_saveRecipient'])->name('admin_saveRecipient');
    Route::get('/delete_recipient/{id}', [App\Http\Controllers\GroupController::class, 'admin_deleteRecipient'])->name('admin_deleteRecipient');



    //airtime_groups
    Route::get('/premium-airtime_group', [App\Http\Controllers\GroupController::class, 'airtime_group'])->name('airtime_group');
    Route::post('/createAirtimeGroup', [App\Http\Controllers\GroupController::class, 'admin_createAirtimeGroup'])->name('admin_createAirtimeGroup');
    Route::post('/recharge_airtime_group/', [App\Http\Controllers\SubscriptionController::class, 'admin_rechargeAirtimeGroup'])->name('admin_rechargeAirtimeGroup');
    Route::get('/premium-group_airtime_transactions/{id}', [App\Http\Controllers\GroupController::class, 'group_airtime_transactions'])->name('group_airtime_transactions');
    Route::get('/delete_airtime_group/{id}', [App\Http\Controllers\GroupController::class, 'admin_deleteAirtimeGroup'])->name('admin_deleteAirtimeGroup');
    Route::get('/premium-airtime_recipients/{id}', [App\Http\Controllers\GroupController::class, 'airtime_recipients'])->name('airtime_recipients');
    Route::post('/saveAirtimeRecipient', [App\Http\Controllers\GroupController::class, 'admin_saveAirtimeRecipient'])->name('admin_saveAirtimeRecipient');
    Route::get('/delete_airtime_recipient/{id}', [App\Http\Controllers\GroupController::class, 'admin_deleteAirtimeRecipient'])->name('admin_deleteAirtimeRecipient');

    Route::post('/buydata', [App\Http\Controllers\SubscriptionController::class, 'buydata']);
    Route::post('/buyairtime', [App\Http\Controllers\SubscriptionController::class, 'buyairtime']);
    Route::post('/buyCable', [App\Http\Controllers\SubscriptionController::class, 'buyCable']);
    Route::post('/buyElectricity', [App\Http\Controllers\SubscriptionController::class, 'buyElectricity']);
    Route::get('/fetchnetwork/{phone}', [App\Http\Controllers\SubscriptionController::class, 'fetchnetwork']);
    Route::get('/fetchplan/{network}', [App\Http\Controllers\SubscriptionController::class, 'fetchplan']);
    Route::get('/fetchdiscount/{network}', [App\Http\Controllers\SubscriptionController::class, 'fetchdiscount']);
    Route::get('/fetch_cable_plan/{network}', [App\Http\Controllers\SubscriptionController::class, 'fetch_cable_plan']);
    Route::post('/fetch_meter_details', [App\Http\Controllers\SubscriptionController::class, 'fetch_meter_details']);
    Route::post('/fetch_decoder_details', [App\Http\Controllers\SubscriptionController::class, 'fetch_decoder_details']);
    Route::any('/user_delete_duplicate', [App\Http\Controllers\SubscriptionController::class, 'user_delete_duplicate']);

    //groups
    Route::get('/data_group', [App\Http\Controllers\GroupController::class, 'data_group'])->name('data_group');

    Route::post('/live_add', [App\Http\Controllers\PayrollController::class, 'live_add'])->name('live_add');
    // Payrll and payee 
    Route::get('/support', [App\Http\Controllers\HomeController::class, 'support'])->name('support');


    //new routes
    Route::any('/resetpassword', [App\Http\Controllers\UserController::class, 'resetpassword'])->name('resetpassword');
    Route::any('/change-password', [App\Http\Controllers\UserController::class, 'changepassword'])->name('change-password');
    Route::any('/resetpin', [App\Http\Controllers\UserController::class, 'resetpin'])->name('resetpin');
    Route::any('/user-change-pin', [App\Http\Controllers\UserController::class, 'changepin'])->name('change-pin');
    Route::any('/forgot-pin', [App\Http\Controllers\UserController::class, 'forgotpin'])->name('forgot-pin');
    Route::any('/reset-pin-with-token', [App\Http\Controllers\UserController::class, 'resetPinWithToken'])->name('reset-pin-with-token');
    Route::any('/reset-forgot-pin', [App\Http\Controllers\UserController::class, 'resetforgotpin'])->name('reset-forgot-pin');
    Route::any('/print_transaction_receipt/{id}', [App\Http\Controllers\UserController::class, 'print_transaction_receipt'])->name('print_transaction_receipt');

    // Email Verification Routes...
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware(['auth'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    })->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
   

    //the business domain start
    
    Route::view('/business', 'business_frontend.business');
    Route::get('home', [BusinessController::class, 'dashboard'])->name('admin_home')->name('dashboard');
    Route::get('dashboard', [BusinessController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('customized_domain', [BusinessController::class, 'customized_domain'])->name('customized_domain');
    Route::get('profile', [BusinessController::class, 'profile']);
    Route::get('data_prices', [BusinessController::class, 'data_prices']);
    Route::get('airtime_prices', [BusinessController::class, 'airtime_prices']);
    Route::get('electricity_prices', [BusinessController::class, 'electricity_prices']);
    Route::get('bulksms_prices', [BusinessController::class, 'bulksms_prices']);
    Route::get('cable_prices', [BusinessController::class, 'cable_prices']);
    Route::get('examination_prices', [BusinessController::class, 'examination_prices']);
    Route::post('save_admin_data', [BusinessController::class, 'save_admin_data'])->name('save_admin_data');
    Route::post('save_admin_airtime', [BusinessController::class, 'save_admin_airtime'])->name('save_admin_airtime');
    Route::post('save_admin_electricity', [BusinessController::class, 'save_admin_electricity'])->name('save_admin_electricity');
    Route::post('save_admin_cable', [BusinessController::class, 'save_admin_cable'])->name('save_admin_cable');
    Route::post('save_admin_exam', [BusinessController::class, 'save_admin_exam'])->name('save_admin_exam');
    Route::post('save_admin_bulksms', [BusinessController::class, 'save_admin_bulksms'])->name('save_admin_bulksms');

    Route::any('/saveAdminContact', [BulkSMSController::class, 'saveContacts'])->name('saveAdminContact');
    Route::get('mytheme', [BusinessController::class, 'theme']);
    Route::get('theme_preview/{id}', [BusinessController::class, 'theme_preview']);
    Route::get('customize_theme/{id}', [BusinessController::class, 'customize_theme']);
    Route::post('/updateprofile', [BusinessController::class, 'updateprofile'])->name('updateprofile');
    Route::get('/change_password', [BusinessController::class, 'change_password'])->name('change_password');
    Route::any('/resetpassword', [BusinessController::class, 'resetpassword'])->name('admin_resetpassword');
    Route::any('/select_theme', [BusinessController::class, 'select_theme'])->name('select_theme');
    Route::any('/notifications', [BusinessController::class, 'notifications'])->name('notifications');
    Route::any('/update_notification', [BusinessController::class, 'update_notification'])->name('update_notification');
    Route::any('/users', [BusinessController::class, 'user_management'])->name('user_management');
    Route::any('/email_marketing', [BusinessController::class, 'email_marketing'])->name('email_marketing');
    Route::any('/send_bulk_email', [BusinessController::class, 'sendBulkEmail'])->name('send_bulk_email');
    Route::any('/fund_wallet/{id}', [BusinessController::class, 'fund_wallet'])->name('fund_wallet');
    Route::any('/credit_user', [BusinessController::class, 'credit_user'])->name('credit_user');
    Route::any('/transactions/{id}', [BusinessController::class, 'transactions'])->name('transactions');
    Route::any('/block_user/{id}', [BusinessController::class, 'block_user'])->name('transactions');


    Route::any('/verify_purchase/{ref?}', [SubscriptionController::class, 'admin_verify_purchase'])->name('admin_verify_purchase');
    Route::any('/verify_payment/{ref?}', [SubscriptionController::class, 'admin_verify_payment'])->name('admin_verify_payment');
    Route::any('/check_verify_purchase', [SubscriptionController::class, 'admin_check_verify_purchase'])->name('admin_check_verify_purchase');
    Route::any('/check_verify_payment', [SubscriptionController::class, 'admin_check_verify_payment'])->name('admin_check_verify_payment');

    //routes for godaddy domain
    Route::post('/check_domain', [BusinessController::class, 'check_domain'])->name('check_domain');
    Route::post('/domain_suggestion', [BusinessController::class, 'domain_suggestion'])->name('domain_suggestion');

    Route::get('fundwallet', [BusinessController::class, 'fundwallet'])->name('fundwallet');
    Route::post('/checkout', [App\Http\Controllers\FundingController::class, 'admin_checkout'])->name('admin_checkout');

    Route::get('payment_transactions', [BusinessController::class, 'payment_transactions'])->name('payment_transactions');
    Route::get('purchase_transactions', [BusinessController::class, 'purchase_transactions'])->name('purchase_transactions');
    Route::get('bulksms_transactions', [BusinessController::class, 'bulksms_transactions'])->name('bulksms_transactions');


    Route::post('/setpin', [App\Http\Controllers\HomeController::class, 'setpin'])->name('setpin');
    Route::any('/resetpin', [App\Http\Controllers\UserController::class, 'resetpin'])->name('resetpin');
    Route::any('/change-pin', [App\Http\Controllers\UserController::class, 'admin_changepin'])->name('change-pin');
    Route::any('/forgot-pin', [App\Http\Controllers\UserController::class, 'forgotpin'])->name('forgot-pin');
    Route::any('/reset-pin-with-token', [App\Http\Controllers\UserController::class, 'resetPinWithToken'])->name('reset-pin-with-token');
    Route::any('/reset-forgot-pin', [App\Http\Controllers\UserController::class, 'resetforgotpin'])->name('reset-forgot-pin');
    Route::any('/print_transaction_receipt/{id}', [App\Http\Controllers\UserController::class, 'print_transaction_receipt'])->name('print_transaction_receipt');

    Route::post('/update_customization', [BusinessController::class, 'update_customization'])->name('update_customization');
    Route::get('checkpage_auth', function () {
        return 'domain';
    });
    // Define your routes here

    Route::post('/redo_transaction', [App\Http\Controllers\SubscriptionController::class, 'redo_transaction']);
    Route::get('/data', [App\Http\Controllers\SubscriptionController::class, 'admin_data'])->name('data');
    Route::get('/airtime', [App\Http\Controllers\SubscriptionController::class, 'admin_airtime']);
    Route::get('/electricity', [App\Http\Controllers\SubscriptionController::class, 'admin_electricity']);
    Route::get('/examination', [App\Http\Controllers\SubscriptionController::class, 'admin_examination']);
    Route::get('/cable', [App\Http\Controllers\SubscriptionController::class, 'admin_cable']);
    Route::get('/bulksms', [App\Http\Controllers\SubscriptionController::class, 'admin_bulksms']);
    Route::get('/contact_group',  [BulkSMSController::class, 'adminContactGroup']);
    Route::get('/fetch_airtime_rate/{network}/{company_id}', [App\Http\Controllers\SubscriptionController::class, 'fetch_airtime_rate'])->name('fetch_airtime_rate');

    //groups
    //data_groups
    Route::get('/data_group', [App\Http\Controllers\GroupController::class, 'admin_data_group'])->name('admin_data_group');
    Route::post('/createGroup', [App\Http\Controllers\GroupController::class, 'admin_createGroup'])->name('admin_createGroup');
    Route::post('/recharge_group/', [App\Http\Controllers\SubscriptionController::class, 'admin_rechargeGroup'])->name('admin_rechargeGroup');
    Route::get('/group_transactions/{id}', [App\Http\Controllers\GroupController::class, 'admin_group_transactions'])->name('admin_group_transactions');
    Route::post('/deleteGroup/{id}', [App\Http\Controllers\GroupController::class, 'admin_deleteGroup'])->name('admin_deleteGroup');
    Route::get('/data_recipient/{id}', [App\Http\Controllers\GroupController::class, 'admin_data_recipient'])->name('admin_data_recipient');
    Route::post('/saveRecipient', [App\Http\Controllers\GroupController::class, 'admin_saveRecipient'])->name('admin_saveRecipient');
    Route::get('/delete_recipient/{id}', [App\Http\Controllers\GroupController::class, 'admin_deleteRecipient'])->name('admin_deleteRecipient');


    //airtime_groups
    Route::get('/airtime_group', [App\Http\Controllers\GroupController::class, 'admin_airtime_group'])->name('admin_airtime_group');
    Route::post('/createAirtimeGroup', [App\Http\Controllers\GroupController::class, 'admin_createAirtimeGroup'])->name('admin_createAirtimeGroup');
    Route::post('/recharge_airtime_group/', [App\Http\Controllers\SubscriptionController::class, 'admin_rechargeAirtimeGroup'])->name('admin_rechargeAirtimeGroup');
    Route::get('/group_airtime_transactions/{id}', [App\Http\Controllers\GroupController::class, 'admin_group_airtime_transactions'])->name('admin_group_airtime_transactions');
    Route::get('/delete_airtime_group/{id}', [App\Http\Controllers\GroupController::class, 'admin_deleteAirtimeGroup'])->name('admin_deleteAirtimeGroup');
    Route::get('/airtime_recipient/{id}', [App\Http\Controllers\GroupController::class, 'admin_airtime_recipient'])->name('admin_airtime_recipient');
    Route::post('/saveAirtimeRecipient', [App\Http\Controllers\GroupController::class, 'admin_saveAirtimeRecipient'])->name('admin_saveAirtimeRecipient');
    Route::get('/delete_airtime_recipient/{id}', [App\Http\Controllers\GroupController::class, 'admin_deleteAirtimeRecipient'])->name('admin_deleteAirtimeRecipient');

    //endgroups
    Route::post('/buydata', [App\Http\Controllers\SubscriptionController::class, 'buydata']);
    Route::post('/buyairtime', [App\Http\Controllers\SubscriptionController::class, 'buyairtime']);
    Route::post('/buyCable', [App\Http\Controllers\SubscriptionController::class, 'buyCable']);
    Route::post('/buyElectricity', [App\Http\Controllers\SubscriptionController::class, 'buyElectricity']);
    Route::post('/buyExamination', [App\Http\Controllers\SubscriptionController::class, 'buyExamination']);
    Route::get('/fetchnetwork/{phone}/{subdomain?}', [App\Http\Controllers\SubscriptionController::class, 'fetchnetwork']);
    Route::get('/fetchplan/{network}/{subdomain?}', [App\Http\Controllers\SubscriptionController::class, 'fetchplan']);
    Route::get('/fetchdiscount/{network}/{subdomain?}', [App\Http\Controllers\SubscriptionController::class, 'fetchdiscount']);
    Route::get('/fetch_cable_plan/{network}/{subdomain?}', [App\Http\Controllers\SubscriptionController::class, 'fetch_cable_plan']);
    Route::post('/fetch_meter_details', [App\Http\Controllers\SubscriptionController::class, 'fetch_meter_details']);
    Route::post('/fetch_decoder_details', [App\Http\Controllers\SubscriptionController::class, 'fetch_decoder_details']);
    Route::any('/user_delete_duplicate', [App\Http\Controllers\SubscriptionController::class, 'user_delete_duplicate']);



    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware(['auth'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    })->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    // Route::any('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');



    Route::get('withdraw', [BusinessController::class, 'withdraw'])->name('admin_withdraw');
    Route::any('confirm_account', [HomeController::class, 'confirm_account'])->name('admin_confirm_account');
    Route::any('make_transfer', [HomeController::class, 'make_transfer'])->name('admin_make_transfer');
    Route::post('/pay', [App\Http\Controllers\FundingController::class, 'redirectToGateway'])->name('admin_pay');
    Route::get('/payment/callback', [App\Http\Controllers\FundingController::class, 'handleGatewayCallback']);
    Route::get('/reserve_account', [App\Http\Controllers\FundingController::class, 'reserve_account']);
    Route::post('monnify/transaction_complete', [App\Http\Controllers\MonnifyController::class, 'monnifyTransactionComplete2']);

    //subscription routes

    Route::group(['middleware' => 'auth'], function () {
        Route::any('/superadmin', [App\Http\Controllers\SuperController::class, 'index'])->name('superadmin');
        Route::any('/all_payment_transactions', [App\Http\Controllers\SuperController::class, 'payment_transactions'])->name('all_payment_transactions');
        Route::any('/all_withdrawals', [App\Http\Controllers\SuperController::class, 'all_withdrawals'])->name('all_withdrawals');
        Route::any('/approve_withdraw/{id}', [App\Http\Controllers\SuperController::class, 'approve_withdraw'])->name('approve_withdraw');
        Route::any('/revert_withdraw/{id}', [App\Http\Controllers\SuperController::class, 'revert_withdraw'])->name('revert_withdraw');
        Route::any('/user_management', [App\Http\Controllers\SuperController::class, 'user_management'])->name('user_management');
        Route::any('/user_transaction/{id}', [App\Http\Controllers\SuperController::class, 'user_transaction'])->name('user_transaction');
        Route::any('/data_price', [App\Http\Controllers\SuperController::class, 'data_price'])->name('data_price');
        Route::any('/update_data', [App\Http\Controllers\SuperController::class, 'update_data'])->name('update_data');
        Route::any('/cable_price', [App\Http\Controllers\SuperController::class, 'cable_price'])->name('cable_price');
        Route::any('/update_cable', [App\Http\Controllers\SuperController::class, 'update_cable'])->name('update_cable');
        Route::any('/block_user/{id}', [App\Http\Controllers\SuperController::class, 'block_user'])->name('block_user');
        Route::any('/upgrade_user/{id}', [App\Http\Controllers\SuperController::class, 'upgrade_user'])->name('upgrade_user');
        Route::any('/duplicate_transactions/', [App\Http\Controllers\SuperController::class, 'duplicate_transactions'])->name('duplicate_transactions');
        Route::any('/admin_delete_duplicate/{type}/{id}', [App\Http\Controllers\SubscriptionController::class, 'admin_delete_duplicate'])->name('admin_delete_duplicate');
    });
});

//business domain end
//the subdomains
// Route::domain('{subdomain}.localhost')->middleware(['subdomain.auth'])->group(function () {
