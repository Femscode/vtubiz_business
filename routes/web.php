<?php

use App\Models\Data;
use App\Models\User;
use App\Models\Cable;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BulkSMSController;
use App\Http\Controllers\FundingController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\LoginWithGoogleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::any('removedouble/{id}', function($id) {
    $planId = $id; // The specific plan_id to identify the data

    $duplicateUsers = Data::select('user_id')
        ->where('plan_id', $planId)
        ->groupBy('user_id')
        ->havingRaw('COUNT(*) > 1')
        ->pluck('user_id');
    
    foreach ($duplicateUsers as $userId) {
        // Get all records for the user with the specific plan_id, ordered by ID
        $userData = Data::where('user_id', $userId)
            ->where('plan_id', $planId)
            ->orderBy('id', 'asc')
            ->get();
    
        // Remove all but the first entry
        $userData->shift(); // Remove the first entry from the collection (keep it)
        
        // Delete the remaining duplicates
        foreach ($userData as $data) {
            $data->delete();
        }
    }
    
    echo "Duplicate data entries for plan_id $planId removed successfully.";
    
});

Route::any('runawoof', function() {
    
    // Data::create([
    //     'user_id' => 0,
    //     'network' => 1,
    //     'plan_id' => 199,
    //     'plan_name' => 'MTN 1GB (Awoof) 1day',
    //     'actual_price' => 230,
    //     'data_price' => 235,
    //     'account_price' => 240,
    //     'admin_price' => 240
    // ]);
    // Data::create([
    //     'user_id' => 0,
    //     'network' => 1,
    //     'plan_id' => 200,
    //     'plan_name' => 'MTN 3.5GB (Awoof) 2days',
    //     'actual_price' => 540,
    //     'data_price' => 590,
    //     'account_price' => 650,
    //     'admin_price' => 650
    // ]);
    // Data::create([
    //     'user_id' => 0,
    //     'network' => 1,
    //     'plan_id' => 201,
    //     'plan_name' => 'MTN 15GB (Awoof) 7days',
    //     'actual_price' => 2070,
    //     'data_price' => 2350,
    //     'account_price' => 2400,
    //     'admin_price' => 2400
    // ]);

    // $users = User::where('upgrade',0)->whereColumn('id', 'company_id')->get();
    $users = User::whereColumn('company_id', 'id')->get();
    foreach($users as $user) {
    Data::create([
        'user_id' => $user->id,
        'network' => 2,
        'plan_id' => 210,
        'plan_name' => 'Glo 1GB (Awoof) 1day',
        'actual_price' => 200,
        'data_price' => 220,
        'account_price' => 230,
        'admin_price' => 230
    ]);
    Data::create([
        'user_id' => $user->id,
        'network' => 2,
        'plan_id' => 211,
        'plan_name' => 'Glo 2GB (Awoof) 1day',
        'actual_price' => 300,
        'data_price' => 330,
        'account_price' => 345,
        'admin_price' => 345
    ]);
    Data::create([
        'user_id' => $user->id,
        'network' => 2,
        'plan_id' => 212,
        'plan_name' => 'Glo 3.5GB (Awoof) 2days',
        'actual_price' => 500,
        'data_price' => 550,
        'account_price' => 570,
        'admin_price' => 570
    ]);
    Data::create([
        'user_id' => $user->id,
        'network' => 2,
        'plan_id' => 213,
        'plan_name' => 'Glo 15GB (Awoof) 7days',
        'actual_price' => 2000,
        'data_price' => 2200,
        'account_price' => 2300,
        'admin_price' => 2300
    ]);
    Data::create([
        'user_id' => $user->id,
        'network' => 3,
        'plan_id' => 202,
        'plan_name' => 'Airtel 100MB (Awoof) 1day',
        'actual_price' => 68,
        'data_price' => 70,
        'account_price' => 75,
        'admin_price' => 75
    ]);
    Data::create([
        'user_id' => $user->id,
        'network' => 3,
        'plan_id' => 214,
        'plan_name' => 'Airtel 250MB (Awoof) 14days',
        'actual_price' => 80,
        'data_price' => 85,
        'account_price' => 90,
        'admin_price' => 90
    ]);

    Data::create([
        'user_id' => $user->id,
        'network' => 3,
        'plan_id' => 221,
        'plan_name' => 'Airtel 40GB (Awoof) 30days',
        'actual_price' => 7100,
        'data_price' => 7300,
        'account_price' => 7400,
        'admin_price' => 7400
    ]);



}
return "awoof run successfully!";
});


Route::get('/', [BusinessController::class, 'index'])->name('homepage');
Route::get('/blogs', [BusinessController::class, 'blogs'])->name('blogs');
Route::get('/blog/{id}', [BusinessController::class, 'blogdetails'])->name('blogdetails');
Route::post('/saveComment', [BusinessController::class, 'saveComment'])->name('saveComment');
Route::get('/run_schedule_giveaway', [App\Http\Controllers\FunGiveAwayController::class, 'run_schedule_giveaway'])->name('run_schedule_giveaway');
Route::get('/clear_duplicate_transaction', [App\Http\Controllers\FunGiveAwayController::class, 'clear_duplicate_transaction'])->name('clear_duplicate_transaction');
Route::any('mailpay/process', [App\Http\Controllers\MailPayController::class, 'processCreditAlertEmails'])->name('process.emails');

Route::get('/claim_giveaway/{giveaway_id}/{user_id}/{rand_no?}', [App\Http\Controllers\FunGiveAwayController::class, 'claim_price'])->name('claim_price');
Route::post('/saveGiveAwayContacts', [App\Http\Controllers\FunGiveAwayController::class, 'saveGiveAwayContacts'])->name('saveGiveAwayContacts');
Route::any('/retryGiveaway/{id}', [App\Http\Controllers\FunGiveAwayController::class, 'retryGiveaway'])->name('retryGiveaway')->middleware('auth');
Route::post('/createGiveawaySchedule', [App\Http\Controllers\FunGiveAwayController::class, 'createGiveawaySchedule'])->name('createGiveawaySchedule');
Route::any('/submittest', [App\Http\Controllers\FunGiveAwayController::class, 'submittest'])->name('submittest');
Route::any('/finishtest', [App\Http\Controllers\FunGiveAwayController::class, 'finishtest'])->name('finishtest');
Route::get('/result/user/{userId}/quiz/{quizId}', [App\Http\Controllers\FunGiveAwayController::class, 'viewResult'])->middleware('auth');
Route::any('/checkuserresult/{userid}/{testid}', [App\Http\Controllers\FunGiveAwayController::class, 'checkuserresult'])->name('checkuserresult');
Route::any('/viewresult/{userid}/{testid}', [App\Http\Controllers\FunGiveAwayController::class, 'checkuserresult'])->name('checkuserresult');
Route::any('confirm_account_details', [App\Http\Controllers\FunGiveAwayController::class, 'confirm_account_details'])->name('confirm_account_details');


Route::get('/asset-location', function () {
    $publicPath = public_path();

    return $publicPath;
});

Route::view('/business', 'business_frontend.business');

Route::view('/privacy-policy', 'frontend.privacy-policy');
Route::view('/terms-of-service', 'frontend.terms-of-service');
Route::any('delete-user', [BusinessController::class, 'delete_user_interface'])->name('delete_user_interface');
Route::any('deleteuser_confirm', [BusinessController::class, 'deleteuser_confirm'])->name('deleteuser');

Route::any('/run_schedule_purchase', [App\Http\Controllers\SubscriptionController::class, 'run_schedule_purchase'])->name('run_schedule_purchase');
Route::any('/test_debit/{client_reference}/{reference}', [App\Http\Controllers\FundingController::class, 'test_debit'])->name('test_debit');
Route::any('/run_debit/{client_reference}/{reference}/{message}', [App\Http\Controllers\FundingController::class, 'run_debit'])->name('run_debit');
Route::any('/run_failed/{client_reference}/{reference}/{message}', [App\Http\Controllers\FundingController::class, 'run_failed'])->name('run_failed');
Route::get('run_data_type', function () {

    $datas = Data::where('type', null)->update([
        'type' => 'cg'
    ]);


    $datas = Data::where('plan_name', 'like', '%SME%')->get();
    foreach ($datas as $data) {
        $data->type = 'SME';
        $data->save();
    }
    $datas = Data::where('plan_name', 'like', '%direct%')->get();
    foreach ($datas as $data) {
        $data->type = 'direct';
        $data->save();
    }
    $datas = Data::where('plan_name', 'like', '%cg_lite%')->get();
    foreach ($datas as $data) {
        $data->type = 'cg_lite';
        $data->save();
    }
    $data->save();
    return "Data type updaated";

    // $foods = Food::where('name', 'like', '%' . $request->food . '%')->pluck('user_id');


});

Route::any('format_data', function () {
    Data::where('user_id', '!=', 0)->delete();
    $themes = Data::where('user_id', 0)->get();
    foreach ($themes as $theme) {
        $string = $theme->plan_name;

        // Split the string by "-"
        $parts = explode('-', $string, 2);

        // Take the part before the "-"
        $newString = trim($parts[0]);
        $theme->plan_name = $newString;
        $theme->save();
    }
});
Route::any('update_account_data', function () {
    $themes = Data::where('user_id', 0)->get();
    foreach ($themes as $theme) {
        $theme->account_price = intval(0.05 * $theme->data_price) + intval($theme->data_price);
        $theme->save();
    }
});

Route::any('update_cable_price', function () {
    $themes = Cable::where('user_id', 0)->get();
    Cable::where('user_id', '!=', 0)->delete();
    foreach ($themes as $theme) {
        $theme->real_price = intval(0.05 * $theme->actual_price) + intval($theme->actual_price);
        $theme->admin_price = intval(0.07 * $theme->actual_price) + intval($theme->actual_price);
        $theme->save();
    }
});
Route::any('update_brand', function () {
    $users = User::whereNull('brand_name')->get(); // Changed where condition to check for null values directly
    foreach ($users as $user) {
        $user->brand_name = Str::replace(" ", "", $user->name); // Changed Str_replace to Str::replace
        $user->save();
    }
});
Route::any('update_user', function () {
    $users = User::get(); // Changed where condition to check for null values directly
    foreach ($users as $user) {
        $user->type ='customer'; // Changed Str_replace to Str::replace
        $user->save();
    }
});


require __DIR__ . '/auth.php';
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
    Route::get('/my-dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('customer_dashboard');
    Route::get('/benefits', [App\Http\Controllers\HomeController::class, 'benefits'])->name('benefits');
    Route::post('/process_order', [App\Http\Controllers\HomeController::class, 'process_order'])->name('process_order');
    Route::get('/delete_order', [App\Http\Controllers\HomeController::class, 'delete_order'])->name('delete_order');
    // Route::post('/updateprofile', [App\Http\Controllers\HomeController::class, 'updateprofile'])->name('updateprofile');
    Route::post('/setpin', [App\Http\Controllers\HomeController::class, 'setpin'])->name('setpin');
    Route::get('my-profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::get('my-referral', [App\Http\Controllers\HomeController::class, 'referral'])->name('referral');
    Route::get('remitearning', [App\Http\Controllers\HomeController::class, 'remitearning'])->name('remitearning');
    Route::get('user-fundwallet', [App\Http\Controllers\HomeController::class, 'fundwallet'])->name('fundwallet');


    Route::post('/checkout/{checkout?}', [App\Http\Controllers\FundingController::class, 'checkout'])->name('checkout');
    Route::post('/manualpayment/{manualpayment?}', [App\Http\Controllers\FundingController::class, 'manualpayment'])->name('manualpayment');
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
    Route::get('/payment/callback', [App\Http\Controllers\FundingController::class, 'handleFLWCallback']);
    Route::get('/reserve_account', [App\Http\Controllers\FundingController::class, 'reserve_account']);
    //subscription routes
    Route::get('/view_details/{id}', [BulkSMSController::class, 'viewDetails'])->name('view_details');

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
    Route::any('/users', [BusinessController::class, 'user_management'])->name('users');
    Route::any('/email_marketing', [BusinessController::class, 'email_marketing'])->name('email_marketing');
    Route::any('/send_bulk_email', [BusinessController::class, 'sendBulkEmail'])->name('send_bulk_email');
    Route::any('/fund_wallet/{id}', [BusinessController::class, 'fund_wallet'])->name('fund_wallet');
    Route::any('/refund/{id}', [BusinessController::class, 'refund'])->name('refund');
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
    Route::post('generatePermanentAccount', [FundingController::class, 'generatePermanentAccount'])->name('generatePermanentAccount');
    Route::post('/checkout', [App\Http\Controllers\FundingController::class, 'admin_checkout'])->name('admin_checkout');

    Route::get('payment_transactions', [BusinessController::class, 'payment_transactions'])->name('payment_transactions');
    Route::get('purchase_transactions', [BusinessController::class, 'purchase_transactions'])->name('purchase_transactions');
    Route::get('pending_transactions', [BusinessController::class, 'pending_transactions'])->name('pending_transactions');
    Route::get('mytransactions', [BusinessController::class, 'mytransactions'])->name('mytransactions');
    Route::get('bulksms_transactions', [BusinessController::class, 'bulksms_transactions'])->name('bulksms_transactions');


    Route::post('/setpin', [App\Http\Controllers\HomeController::class, 'setpin'])->name('setpin');
    Route::any('/resetpin', [App\Http\Controllers\UserController::class, 'resetpin'])->name('resetpin');
    Route::any('/change_pin_status', [App\Http\Controllers\UserController::class, 'change_pin_status'])->name('change_pin_status');
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

    //Fun GiveAway

    Route::get('/create-giveaway', [App\Http\Controllers\FunGiveAwayController::class, 'fun_giveaway_data'])->name('fun_giveaway_data');
    Route::get('/my-giveaway', [App\Http\Controllers\FunGiveAwayController::class, 'my_giveaway'])->name('my_giveaway');
    Route::get('/giveaway_participant/{id}', [App\Http\Controllers\FunGiveAwayController::class, 'giveaway_participants'])->name('giveaway_participants');
    Route::get('/giveaway_transactions/{id}', [App\Http\Controllers\FunGiveAwayController::class, 'giveaway_transactions'])->name('giveaway_transactions');
    Route::get('/add_question/{slug}', [App\Http\Controllers\FunGiveAwayController::class, 'addQuestion'])->name('addQuestion');
    Route::get('/delete_question/{slug}', [App\Http\Controllers\FunGiveAwayController::class, 'delete_question'])->name('delete_question');
    Route::get('/delete_giveaway/{slug}', [App\Http\Controllers\FunGiveAwayController::class, 'delete_giveaway'])->name('delete_giveaway');
    Route::post('/createDataGiveaway', [App\Http\Controllers\FunGiveAwayController::class, 'createDataGiveaway'])->name('createDataGiveaway');
    Route::post('/storequestion', [App\Http\Controllers\FunGiveAwayController::class, 'storequestion'])->name('storequestion');


    //End Fun Giveaway

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
    Route::any('make_withdraw', [HomeController::class, 'make_withdraw'])->name('admin_make_withdraw');
    Route::post('/pay', [App\Http\Controllers\FundingController::class, 'redirectToGateway'])->name('admin_pay');
    Route::get('/payment/callback', [App\Http\Controllers\FundingController::class, 'handleGatewayCallback']);
    Route::get('/reserve_account', [App\Http\Controllers\FundingController::class, 'reserve_account']);

    //subscription routes

    Route::group(['middleware' => 'auth'], function () {
        // Route::any('/run_schedule_purchase', [App\Http\Controllers\SubscriptionController::class, 'run_schedule_purchase'])->name('run_schedule_purchase');
        Route::any('/alltransactions', [App\Http\Controllers\SuperController::class, 'alltransactions'])->name('alltransactions');
        Route::any('/superadmin', [App\Http\Controllers\SuperController::class, 'index'])->name('superadmin');
        Route::any('/schedule_accounts', [App\Http\Controllers\SuperController::class, 'schedule_accounts'])->name('schedule_accounts');
        Route::any('/admin_giveaway', [App\Http\Controllers\SuperController::class, 'admin_giveaway'])->name('admin_giveaway');
        Route::any('/all_payment_transactions', [App\Http\Controllers\SuperController::class, 'payment_transactions'])->name('all_payment_transactions');
        Route::any('/all_withdrawals', [App\Http\Controllers\SuperController::class, 'all_withdrawals'])->name('all_withdrawals');
        Route::any('/approve_withdraw/{id}', [App\Http\Controllers\SuperController::class, 'approve_withdraw'])->name('approve_withdraw');
        Route::any('/revert_withdraw/{id}', [App\Http\Controllers\SuperController::class, 'revert_withdraw'])->name('revert_withdraw');
        Route::any('/user_management', [App\Http\Controllers\SuperController::class, 'user_management'])->name('user_management');
        Route::any('/new_users', [App\Http\Controllers\SuperController::class, 'new_users'])->name('new_users');
        Route::any('/user_transaction/{id}', [App\Http\Controllers\SuperController::class, 'user_transaction'])->name('user_transaction');
        Route::any('/data_price', [App\Http\Controllers\SuperController::class, 'data_price'])->name('data_price');
        Route::any('/reset_data_price/{type}', [App\Http\Controllers\SuperController::class, 'reset_data_price'])->name('reset_data_price');
        Route::any('/reset_all_data_prices', [App\Http\Controllers\SuperController::class, 'reset_all_data_prices'])->name('reset_all_data_prices');
        Route::any('/plan_status', [App\Http\Controllers\SuperController::class, 'plan_status'])->name('plan_status');
        Route::any('/plan_status/{network_id}/{type}', [App\Http\Controllers\SuperController::class, 'update_plan_status'])->name('update_plan_status');
        Route::any('/update_data', [App\Http\Controllers\SuperController::class, 'update_data'])->name('update_data');
        Route::any('/cable_price', [App\Http\Controllers\SuperController::class, 'cable_price'])->name('cable_price');
        Route::any('/reset_all_cable_prices', [App\Http\Controllers\SuperController::class, 'reset_all_cable_prices'])->name('reset_all_cable_prices');
        Route::any('/exam_price', [App\Http\Controllers\SuperController::class, 'exam_price'])->name('exam_price');
        Route::any('/update_cable', [App\Http\Controllers\SuperController::class, 'update_cable'])->name('update_cable');
        Route::any('/update_exam', [App\Http\Controllers\SuperController::class, 'update_exam'])->name('update_exam');
        Route::any('/reset_all_exam_prices', [App\Http\Controllers\SuperController::class, 'reset_all_exam_prices'])->name('reset_all_exam_prices');
        Route::any('/block_user/{id}', [App\Http\Controllers\SuperController::class, 'block_user'])->name('block_user');
        Route::any('/upgrade_user/{id}', [App\Http\Controllers\SuperController::class, 'upgrade_user'])->name('upgrade_user');
        Route::any('/reset_password/{id}', [App\Http\Controllers\SuperController::class, 'reset_password'])->name('reset_password');
        Route::any('/reset_pin/{id}', [App\Http\Controllers\SuperController::class, 'reset_pin'])->name('reset_pin');
        Route::any('/duplicate_transactions/', [App\Http\Controllers\SuperController::class, 'duplicate_transactions'])->name('duplicate_transactions');
        Route::any('/contact_gain/', [App\Http\Controllers\SuperController::class, 'contact_gain'])->name('contact_gain');
        Route::any('/admin_blog/', [App\Http\Controllers\SuperController::class, 'admin_blog'])->name('admin_blog');
        Route::any('/create_blog/', [App\Http\Controllers\SuperController::class, 'create_blog'])->name('create_blog');
        Route::post('/saveblog', [App\Http\Controllers\SuperController::class, 'saveblog'])->name('saveblog');
        Route::any('/editblog/{id}', [App\Http\Controllers\SuperController::class, 'editblog'])->name('editblog');
        Route::post('/updateblog/', [App\Http\Controllers\SuperController::class, 'updateblog'])->name('updateblog');
        Route::get('/changeblogstatus/{id}', [App\Http\Controllers\SuperController::class, 'changeblogstatus'])->name('changeblogstatus');
        Route::any('/deleteblog/{id}', [App\Http\Controllers\SuperController::class, 'deleteblog'])->name('deleteblog');
        Route::any('/delete_user/{id}', [App\Http\Controllers\SuperController::class, 'deleteuser'])->name('deleteuser');
    
        Route::any('/downloadCSV/', [App\Http\Controllers\SuperController::class, 'downloadCSV'])->name('downloadCSV');
        Route::any('/admin_delete_duplicate/{type}/{id}', [App\Http\Controllers\SubscriptionController::class, 'admin_delete_duplicate'])->name('admin_delete_duplicate');
    });

    //route for manager
    Route::group(['middleware' => 'auth'], function () {
        // Route::any('/run_schedule_purchase', [App\Http\Controllers\SubscriptionController::class, 'run_schedule_purchase'])->name('run_schedule_purchase');
        Route::any('/manager', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager');
        Route::any('/manager/transactions', [App\Http\Controllers\ManagerController::class, 'alltransactions'])->name('alltransactions');
        Route::any('/manager/user_records_2024', [App\Http\Controllers\ManagerController::class, 'user_records_2024'])->name('alltransactions');
        Route::any('/manager/user_records', [App\Http\Controllers\ManagerController::class, 'user_records'])->name('alltransactions');
        Route::any('/manager/purchase_records', [App\Http\Controllers\ManagerController::class, 'purchase_records'])->name('alltransactions');
        Route::any('/manager/purchase_records_2024', [App\Http\Controllers\ManagerController::class, 'purchase_records_2024'])->name('alltransactions');
        Route::any('/manager/admin_giveaway', [App\Http\Controllers\ManagerController::class, 'admin_giveaway'])->name('admin_giveaway');
        Route::any('/manager/payment_transactions', [App\Http\Controllers\ManagerController::class, 'payment_transactions'])->name('all_payment_transactions');
        Route::any('/manager/user_management', [App\Http\Controllers\ManagerController::class, 'user_management'])->name('user_management');
        Route::any('/manager/new_users', [App\Http\Controllers\ManagerController::class, 'new_users'])->name('new_users');
        Route::any('/manager/user_transaction/{id}', [App\Http\Controllers\ManagerController::class, 'user_transaction'])->name('user_transaction');
         Route::any('/manager/plan_status', [App\Http\Controllers\ManagerController::class, 'plan_status'])->name('plan_status');
        Route::any('/manager/plan_status/{network_id}/{type}', [App\Http\Controllers\ManagerController::class, 'update_plan_status'])->name('update_plan_status');
        Route::any('/manager/upgrade_user/{id}', [App\Http\Controllers\ManagerController::class, 'upgrade_user'])->name('upgrade_user');
        Route::any('/manager/reset_password/{id}', [App\Http\Controllers\ManagerController::class, 'reset_password'])->name('reset_password');
        Route::any('/manager/reset_pin/{id}', [App\Http\Controllers\ManagerController::class, 'reset_pin'])->name('reset_pin');
        Route::any('/manager/notifications/', [App\Http\Controllers\ManagerController::class, 'notifications'])->name('duplicate_transactions');
        Route::any('/manager/duplicate_transactions/', [App\Http\Controllers\ManagerController::class, 'duplicate_transactions'])->name('duplicate_transactions');
        Route::any('/manager/mailpay_dashboard/', [App\Http\Controllers\ManagerController::class, 'mailpay_dashboard'])->name('mailpay_dashboard');
        Route::any('/manager/contact_gain/', [App\Http\Controllers\ManagerController::class, 'contact_gain'])->name('contact_gain');
        Route::any('/manager/admin_blog/', [App\Http\Controllers\ManagerController::class, 'admin_blog'])->name('admin_blog');
        Route::any('/manager/create_blog/', [App\Http\Controllers\ManagerController::class, 'create_blog'])->name('create_blog');
        Route::post('/manager/saveblog', [App\Http\Controllers\ManagerController::class, 'saveblog'])->name('saveblog');
        Route::any('/manager/editblog/{id}', [App\Http\Controllers\ManagerController::class, 'editblog'])->name('editblog');
        Route::post('/manager/updateblog/', [App\Http\Controllers\ManagerController::class, 'updateblog'])->name('updateblog');
        Route::get('/manager/changeblogstatus/{id}', [App\Http\Controllers\ManagerController::class, 'changeblogstatus'])->name('changeblogstatus');
        Route::any('/manager/deleteblog/{id}', [App\Http\Controllers\ManagerController::class, 'deleteblog'])->name('deleteblog');
        Route::any('/manager/downloadCSV/', [App\Http\Controllers\ManagerController::class, 'downloadCSV'])->name('downloadCSV');
        Route::any('/manager/admin_delete_duplicate/{type}/{id}', [App\Http\Controllers\SubscriptionController::class, 'admin_delete_duplicate'])->name('admin_delete_duplicate');
    });

});
Route::get('/{slug}', [App\Http\Controllers\FunGiveAwayController::class, 'giveawayHome'])->name('giveawayHome');

//business domain end
//the subdomains
// Route::domain('{subdomain}.localhost')->middleware(['subdomain.auth'])->group(function () {
