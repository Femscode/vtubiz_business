<?php

namespace App\Traits;

use App\Models\Data;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\DuplicateTransaction;
use App\Models\SchedulePurchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

trait TransactionTrait
{
   
    public function check_duplicate($type, $user_id, $amount = null, $title = null, $details = null)
    {
        if ($type == 'check') {

            $duplicate = DuplicateTransaction::where('user_id', $user_id)->first();
            // dd($duplicate);
            if ($duplicate !== null) {
                return [true,$duplicate];
            }
           
            $duplicate = DuplicateTransaction::create([
                'user_id' => $user_id,
                'title' => $title,
                'details' => $details,
                'amount' => $amount
            ]);
          
            return [false,$duplicate];
        } else {
            $duplicate = DuplicateTransaction::where('user_id', $user_id)->first();
            $duplicate->delete();
        }
    }
    public function reserve_account_monnify()
    {
        $user = Auth::user();
        //authentication to monnify
        $api_key = env('MON_API_KEY_TEST');
        $secret_key = env('MON_SECRET_KEY_TEST');

        // Encode API Key and Secret Key
        // $auth_str = base64_encode("$api_key:$secret_key");
        $auth_str = base64_encode("MK_TEST_A8C10B1WC9:FAACQZT5T9UZ1UESMZQ9C0DSYTHB17A1");


        // Set headers for HTTP request
        $headers = [
            'Authorization' => 'Basic ' . $auth_str,
        ];

        // Make HTTP request using Axios
        $response = Http::withHeaders($headers)
            ->post('https://sandbox.monnify.com/api/v1/auth/login', []);
        $response = json_decode($response, true);

        if ($response['requestSuccessful'] == false) {
            return 0;
        }
        // dd($response);
        $access_token = $response['responseBody']['accessToken'];
        // return $access_token;
        $payment_headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $payment_response = Http::withHeaders($payment_headers)
            ->post('https://sandbox.monnify.com/api/v2/bank-transfer/reserved-accounts', [
                "accountReference" => Str::random(5),
                "accountName" => "Paycirclex " . $user->name,
                "currencyCode" => "NGN",
                "contractCode" => "1699178756",
                "customerEmail" => $user->email,
                // "bvn" => "21212121212",
                "customerName" => $user->name,
                "getAllAvailableBanks" => true
            ]);
        $c_response = json_decode($payment_response, true);
        if ($c_response['requestSuccessful'] == false) {
            return 0;
        }
        $accounts = $c_response['responseBody']['accounts'];
        foreach ($accounts as $account) {
            if ($account['bankCode'] == '035') {
                $user->account_wema = $account['accountNumber'];
            } elseif ($account['bankCode'] == '232') {
                $user->account_sterling = $account['accountNumber'];
            } elseif ($account['bankCode'] == '50515') {
                $user->account_moniepoint = $account['accountNumber'];
            } elseif ($account['bankCode'] == '058') {
                $user->account_gtb = $account['accountNumber'];
            } else {
            }
            $user->save();
        }

        return 1;
    }
    public function reserve_account_paystack()
    {
        $user = Auth::user();
        //generate virtual from paystack
        $full_name = str_word_count($user->name, 1); // Split the full name into an array of words

        $firstName = $full_name[0]; // First name is the first word
        $lastName = end($full_name);

        $url = "https://api.paystack.co/customer";
        $fields = [
            "email" => $user->email,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "phone" => "+234" . $user->phone
        ];
        $fields_string = http_build_query($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_live_dc09eacf4aed817703251640abf8bd4b4f0d007f",
            // "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $json_result = json_decode($result, true);
        $customer = $json_result['data']['customer_code'];
        // dd($json_result,$customer,'nic');
        $url = "https://api.paystack.co/dedicated_account";

        $fields = [
            "customer" => $customer,
            "preferred_bank" => "wema-bank",
            "phone" => "234" . $user->phone
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_live_dc09eacf4aed817703251640abf8bd4b4f0d007f",
            // "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $c_response = json_decode($result, true);
        // dd($c_response);

        if ($c_response['status'] == false) {
            return 0;
        }

        $user->bank_name = $c_response['data']['bank']['name'];
        $user->account_name = $c_response['data']['account_name'];
        $user->account_no = $c_response['data']['account_number'];

        $user->save();


        return 1;
    }


    public function create_transaction($title, $reference, $details, $type, $amount, $user, $status, $real_dataprice = null)
    {
        //    dd($title, $details, $type, intval($amount),intval($user),$name);
        $r_user = User::find($user);
        $company = User::where('id', $r_user->company_id)->first();

        $tranx =  Transaction::create([
            'user_id' => $user,
            'company_id' => $company->id,
            'title' => $title,
            'reference' => $reference,
            'description' => $details,
            'before' => $r_user->balance,
            'admin_before' => $company->balance,
            'type' => $type,
            'amount' => $amount,
            'status' => $status
        ]);
        if ($title == 'Fund Transfer') {
            $r_user->balance -= $amount;
            $r_user->save();
            $tranx->after = $r_user->balance;
            $tranx->status = 1;
            $tranx->save();
        } elseif ($title == 'Data Purchase') {

            if ($status == 1) {
                $r_user->balance -= $amount;
                $r_user->total_spent += $amount;
                $r_user->save();
                $profit = $amount - floatval($real_dataprice);
                $company->balance += $profit;
                $company->save();
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $tranx->save();
                return $tranx->id;
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $r_user->save();
                $tranx->save();
            }
        } elseif ($title == 'Manual Funding') {

            $r_user->balance += $amount;
          

            $r_user->save();
            $tranx->after = $r_user->balance;

            $tranx->status = 1;
            $tranx->save();
        }
        elseif ($title == 'Admin Fund User') {

            $r_user->balance -= $amount;
         
            $r_user->save();
            $tranx->after = $r_user->balance;

            $tranx->status = 1;
            $tranx->save();
        }
        
        elseif ($title == 'Payment Received') {

            $r_user->balance += $amount;

            $r_user->save();
            $tranx->after = $r_user->balance;

            $tranx->status = 1;
            $tranx->save();
        } elseif ($title == 'Account Funding') {


            $r_user->balance += $amount;

            $r_user->save();
            $tranx->after = $r_user->balance;
            $tranx->status = 1;
            $tranx->save();
            return $tranx->id;
        } elseif ($title == 'Bonus Credited') {


            $r_user->bonus += $amount;

            $r_user->save();
            $tranx->after = $r_user->balance;
            $tranx->status = 1;
            $tranx->save();
            return $tranx->id;
        } elseif ($title == 'Account Funded Through Transfer') {


            $r_user->balance += $amount;

            $r_user->save();
            $tranx->after = $r_user->balance;
            $tranx->status = 1;
            $tranx->save();
            return $tranx->id;
        } elseif ($title == 'Pending Credit') {


            $r_user->balance += $amount;

            $r_user->save();
            $tranx->after = $r_user->balance;
            $tranx->status = 2;
            $tranx->save();
            return $tranx->id;
        } elseif ($title == 'Funds Withdraw') {


            if ($status == 1) {
                $r_user->balance -= $amount;
                $r_user->save();
                $tranx->after = $r_user->balance;
                $tranx->status = $status;
                $tranx->save();
                return $tranx;
            } else {

                $tranx->after = $r_user->balance;
                $tranx->status = $status;
                $tranx->save();
                return $tranx;
            }

            return $tranx->id;
        } elseif ($title == 'Airtime Purchase') {

            $company = User::where('id', $r_user->company_id)->first();
            if ($status == 1) {
                $r_user->balance -= $amount;
                $r_user->total_spent += $amount;
                $r_user->save();
                $profit = $amount - floatval($real_dataprice);
                $company->balance += $profit;
                $company->save();
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $tranx->save();
                return $tranx->id;
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $r_user->save();
                $tranx->save();
            }
        } elseif ($title == 'Cable Subscription') {

            $company = User::where('id', $r_user->company_id)->first();
            if ($status == 1) {
                $r_user->balance -= $amount;
                $r_user->total_spent += $amount;
                $r_user->save();
                $profit = $amount - floatval($real_dataprice);
                $company->balance += $profit;
                $company->save();
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $tranx->save();
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $r_user->save();
                $tranx->save();
            }
        } elseif ($title == 'Examination Result Payment') {

            $company = User::where('id', $r_user->company_id)->first();
            if ($status == 1) {
                $r_user->balance -= $amount;
                $r_user->total_spent += $amount;
                $r_user->save();
                $profit = $amount - floatval($real_dataprice);
                $company->balance += $profit;
                $company->save();
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $tranx->save();
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->admin_after = $company->balance;
                $tranx->after = $r_user->balance;
                $r_user->save();
                $tranx->save();
            }
        } elseif ($title == 'Electricity Payment') {

            $company = User::where('id', $r_user->company_id)->first();
            if ($status == 1) {
                $r_user->balance -= $amount;
                $r_user->total_spent += $amount;
                $r_user->save();
                $profit = $amount - floatval($real_dataprice);
                $company->balance += $profit;
                $company->save();
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $tranx->save();
                return $tranx->id;
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $r_user->save();
                $tranx->save();
            }
        } elseif ($title == 'Bulk SMS') {

            $company = User::where('id', $r_user->company_id)->first();
            if ($status == 1) {
                $r_user->balance -= $amount;
                $r_user->total_spent += $amount;
                $r_user->save();
                $profit = $amount - floatval($real_dataprice);
                $company->balance += $profit;
                $company->save();
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $tranx->save();
                return $tranx->id;
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $r_user->balance;
                $tranx->admin_after = $company->balance;
                $r_user->save();
                $tranx->save();
            }
        } else {
            $tranx->status = 0;

            $tranx->after = $r_user->balance;
            $tranx->save();

            return "not_completed";
        }
    }

    public function create_later_purchase($title, $reference, $details, $user_id, $phone, $network, $discounted_amount, $amount, $date, $time, $transaction_id)
    {
        $user = Auth::user();
        $company_id = User::where('id', $user->company_id)->first()->id;
        if ($title == 'Airtime Purchase') {

            SchedulePurchase::create([
                'title' => $title,
                'reference' => $reference,
                'description' => $details,
                'user_id' => $user_id,
                'company_id' => $company_id,
                'phone_number' => $phone,
                'network' => $network,
                'discounted_amount' => $discounted_amount,
                'amount' => $amount,

                'date' => $date,
                'time' => $time,
                'transaction_id' => $transaction_id,
            ]);
        } elseif ($title == 'Data Purchase') {
            SchedulePurchase::create([
                'title' => $title,
                'reference' => $reference,
                'description' => $details,
                'user_id' => $user_id,
                'company_id' => $company_id,
                'phone_number' => $phone,
                'network' => $network,
                'plan_id' => $discounted_amount,
                'amount' => $amount,

                'date' => $date,
                'time' => $time,
                'transaction_id' => $transaction_id,
            ]);
        } else {
            return false;
        }
        // return true;
        // dd($title,$reference,$details,$user_id,$phone,$network,$discounted_amount,$amount,$date,$time);

    }
    public function create_schedule_transaction($title, $reference, $details, $user_id, $phone, $network, $discounted_amount, $amount)
    {
        $user = Auth::user();
        $company_id = User::where('id', $user->company_id)->first()->id;
        if ($title == 'Airtime Purchase') {

            $tranx =  Transaction::create([
                'title' => $title,
                'reference' => $reference,
                'description' => $details,
                'user_id' => $user_id,
                'company_id' => $company_id,
                'type' => 'debit',
                'status' => 2,
                'phone_number' => $phone,
                'network' => $network,
                'discounted_amount' => $discounted_amount,
                'amount' => $amount,


            ]);
        } elseif ($title == 'Data Purchase') {
            $tranx =  Transaction::create([
                'title' => $title,
                'reference' => $reference,
                'description' => $details,
                'user_id' => $user_id,
                'company_id' => $company_id,
                'type' => 'debit',
                'status' => 2,
                'phone_number' => $phone,
                'network' => $network,
                'plan_id' => $discounted_amount,
                'amount' => $amount,


            ]);
        } else {
            return false;
        }
        return $tranx->id;
        // return true;
        // dd($title,$reference,$details,$user_id,$phone,$network,$discounted_amount,$amount,$date,$time);

    }
}
