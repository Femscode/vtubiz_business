<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airtime;
use App\Models\Data;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\TransactionTrait;

class TransactionController extends Controller
{
    use TransactionTrait;
    public function index()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->latest()->take(10)->get();

        return response()->json([
            'status' => true,
            'message' => 'Transactions Fetched successfully',
            'transactions' => $transactions,

        ], 201);
    }
    public function five_transactions($type)
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->where('type', 'debit')->where('status',1)->where('title',$type)->latest()->take(5)->get();

        return response()->json([
            'status' => true,
            'message' => 'Transactions Fetched successfully',
            'transactions' => $transactions,

        ], 201);
    }
    public function all_transactions()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Transactions Fetched successfully',
            'transactions' => $transactions,

        ], 201);
    }
    public function redo_transaction(Request $request)
    {
        try {
            $user = Auth::user();
            $hashed_pin = hash('sha256', $request->pin);
            if ($user->pin !== $hashed_pin) {
                $response = [
                    'success' => false,
                    'message' => 'Incorrect Pin!',
                    'auto_refund_status' => 'Nil'
                ];

                return response()->json($response, 401);
            }
            $tranx = Transaction::find($request->transaction_id);
            if ($tranx->title == "Airtime Purchase") {
                $phone_number = $tranx->phone_number;
                $company = User::where('id', $user->company_id)->first();


                $actual_price = Airtime::where('user_id', $user->company_id)->where('network', $tranx->network)->first()->actual_price;
                $real_airtimeprice = $tranx->real_amount - ($actual_price / 100) * $tranx->real_amount;
                // dd($real_airtimeprice, $tranx->amount, $tranx->real_amount);
                if ($user->balance < $tranx->amount) {
                    $response = [
                        'success' => false,
                        'message' => 'Insufficient Balance for airtime you want to get!',
                        'auto_refund_status' => 'Nil'
                    ];

                    return response()->json($response, 402);
                }

                //check duplicate

                $details =  "Airtime Purchase of NGN" . $tranx->real_amount . " on " . $tranx->phone_number;
                $client_reference =  'buy_airtime_' . Str::random(7);

                $check = $this->check_duplicate('check', $user->id, $tranx->amount, "Airtime Purchase", $details, $client_reference);

                if ($check[0] == true) {
                    $response = [
                        'type' => 'duplicate',
                        'success' => false,
                        'message' => 'Please confirm the success of ' . $check[1]->details . ' before resuming service usage.',
                        'auto_refund_status' => 'Nil'
                    ];

                    return response()->json($response, 402);
                }
                //purchase the data
                $trans_id = $this->create_transaction('Airtime Purchase', $client_reference, $details, 'debit', $tranx->discounted_amount, $user->id, 3, $real_airtimeprice, $phone_number, $tranx->network, $tranx->real_amount);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://easyaccessapi.com.ng/api/airtime.php",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => array(
                        'network' => $tranx->network,
                        'mobileno' => $phone_number,
                        'amount' => $tranx->real_amount,
                        'airtime_type' => 001,
                        'client_reference' => $client_reference, //update this on your script to receive webhook notifications
                    ),
                    CURLOPT_HTTPHEADER => array(
                        "AuthorizationToken: " . env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                        "cache-control: no-cache"
                    ),
                ));
                $response = curl_exec($curl);

                curl_close($curl);
                return response()->json([
                    'status' => true,
                    'message' => 'Transactions successfully made',


                ], 200);

                return $response;
            } elseif ($tranx->title == "Data Purchase") {
                $phone_number = $tranx->phone_number;
                if($user->upgrade == 1) {
                    $data = Data::where('user_id', $user->company_id)->where('plan_id', $tranx->plan_id)->where('network', $tranx->network)->first();
                    
                } else {
                    $data = Data::where('user_id', 0)->where('plan_id', $tranx->plan_id)->where('network', $tranx->network)->first();
    
                }

                // $data = Data::where('user_id', $user->company_id)->where('plan_id', $tranx->plan_id)->where('network', $tranx->network)->first();
                if ($data == null) {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid Plan!',
                        'auto_refund_status' => 'Nil'
                    ];

                    return response()->json($response, 400);
                }
                $data_price =  $data->admin_price;
                $real_dataprice = $data->data_price;
                // dd($data_price, $real_dataprice, $data->data_price);
                //check balance
                if ($user->balance < $data_price) {
                    $response = [
                        'success' => false,
                        'message' => 'Insufficient balance for the plan you want to get!',
                        'auto_refund_status' => 'Nil'
                    ];

                    return response()->json($response, 402);
                }

                //check duplicate


                if ($data->network == 1) {
                    $network = 'MTN';
                } elseif ($data->network == 2) {
                    $network = 'GLO';
                } elseif ($data->network == 3) {
                    $network = "Airtel";
                } else {
                    $network = "9Mobile";
                }

                $details = $network . " Data Purchase of " . $data->plan_name . " on " . $tranx->phone_number;
                $client_reference =  'buy_data_' . Str::random(7);

                $check = $this->check_duplicate('check', $user->id, $data->data_price, "Data Purchase", $details, $client_reference);

                if ($check[0] == true) {
                    $response = [
                        'type' => 'duplicate',
                        'success' => false,
                        'message' => 'Please confirm the success of ' . $check[1]->details . ' before resuming service usage.',
                        'auto_refund_status' => 'Nil'
                    ];

                    return response()->json($response, 401);
                }

                //purchase the data
                $trans_id = $this->create_transaction('Data Purchase', $client_reference, $details, 'debit', $data_price, $user->id, 3, $real_dataprice, $phone_number, $request->network, $request->plan);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://easyaccessapi.com.ng/api/data.php",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => array(
                        'network' => $tranx->network,
                        'mobileno' => $phone_number,
                        'dataplan' => $tranx->plan_id,
                        'client_reference' => $client_reference, //update this on your script to receive webhook notifications
                    ),
                    CURLOPT_HTTPHEADER => array(
                        "AuthorizationToken: " . env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                        "cache-control: no-cache"
                    ),
                ));
                $response = curl_exec($curl);
                $response_json = json_decode($response, true);
                curl_close($curl);
                return response()->json([
                    'status' => true,
                    'message' => 'Transactions successfully made',

                ], 200);
                return $response;
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid Transaction!',
                    'auto_refund_status' => 'Nil'
                ];
                return response()->json($response, 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
        //pin, transaction_id
    }
}
