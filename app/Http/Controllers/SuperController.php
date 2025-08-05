<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cable;
use App\Models\Data;
use App\Models\DuplicateTransaction;
use App\Models\Examination;
use App\Models\GiveAway;
use App\Models\ScheduleAccount;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperController extends Controller
{
    public function index()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['transactions'] = Transaction::where('title', 'Data Purchase')
            ->orWhere('title', 'Airtime Purchase')
            ->orWhere('title', 'Cable Subscription')
            ->orWhere('title', 'Electricity Payment')
            ->orWhere('title', 'Bulk SMS')
            ->orWhere('title', 'Examination Result Payment')
            ->latest()->take(100)->get();

        return view('super.index', $data);
    }
    public function alltransactions()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['transactions'] = Transaction::latest()->take(150)->get();

        return view('super.index', $data);
    }

    public function data_price()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['datas'] = Data::where('user_id', 0)->orderBy('network')->get();

        return view('super.data_price', $data);
    }
    public function reset_data_price($type)
    {
        $data['user'] = $user = Auth::user();
        if (!in_array($user->email, ['fasanyafemi@gmail.com', 'manager@gmail.com'])) {
            return redirect('dashboard');
        }
        // Extract network and plan type from the incoming type parameter
        $type_parts = explode('_', strtolower($type));
        $network_name = $type_parts[0];
        $plan_type = $type_parts[1];



        // Map network names to their IDs
        $network_mapping = [
            'mtn' => 1,
            'glo' => 2,
            'airtel' => 3,
            '9mobile' => 4
        ];

        // Get network ID and formatted network name
        $network = $network_mapping[$network_name] ?? 1;
        $network_prefix = strtoupper($network_name);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/get_plans.php?product_type=" . $type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: " . env('EASY_ACCESS_AUTH'),
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response_json = json_decode($response, true);
        $online_data = reset($response_json);
        // dd($network, $online_data, $network_prefix);

        if ($online_data && is_array($online_data) && count($online_data) > 0) {
            // Delete previous data only if we have valid response
            Data::where('type', $plan_type)->where('network', $network)->delete();

            foreach ($online_data as $data) {
                Data::create([
                    'user_id' => 0,
                    'network' => $network,
                    'plan_id' => $data['plan_id'],
                    'plan_name' => $network_prefix . ' ' . $data['name'] . ' ' . $data['validity'],
                    'actual_price' => ceil($data['price']),
                    'data_price' => ceil($data['price'] + (0.03 * $data['price'])),
                    'account_price' => ceil($data['price'] + (0.03 * $data['price'])),
                    'type' => $plan_type,
                    'status' => 1,
                    'admin_price' => ceil($data['price'] + (0.06 * $data['price']))
                ]);
            }
            return redirect()->back()->with('message', 'Data Price Updated Successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update data price.');
    }

    private function reset_data_price_logic($type)
    {
        $type_parts = explode('_', strtolower($type));
        $network_name = $type_parts[0];
        $plan_type = $type_parts[1];

        $network_mapping = [
            'mtn' => 1,
            'glo' => 2,
            'airtel' => 3,
            '9mobile' => 4
        ];

        $network = $network_mapping[$network_name] ?? 1;
        $network_prefix = strtoupper($network_name);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/get_plans.php?product_type=" . $type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: " . env('EASY_ACCESS_AUTH'),
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response_json = json_decode($response, true);
        $online_data = reset($response_json);

        if ($online_data && is_array($online_data) && count($online_data) > 0) {
            Data::where('type', $plan_type)->where('network', $network)->delete();

            foreach ($online_data as $data) {
                // $percentage = 0.015; // Default 4% for prices >= 5000
                // $selling_price_percentage = 0.07; 
                
                $percentage = 0.01; // Default 4% for prices >= 5000
                $selling_price_percentage = 0.03; 
                // Default 4% for prices >= 5000
                if ($data['price'] < 1000) {
                    $percentage = 0.01; 
                    $selling_price_percentage = 0.018; 
                } elseif ($data['price'] < 3000) {
                    $percentage = 0.013; 
                    $selling_price_percentage = 0.025; 
                } elseif ($data['price'] < 5000) {
                    $percentage = 0.015; 
                    $selling_price_percentage = 0.03; 
                }

                dd($percentage, $selling_price_percentage, Data::all());

                Data::create([
                    'user_id' => 0,
                    'network' => $network,
                    'plan_id' => $data['plan_id'],
                    'plan_name' => $network_prefix . ' ' . $data['name'] . ' ' . $data['validity'],
                    'actual_price' => ceil($data['price']),
                    'data_price' => ceil($data['price'] + ($percentage * $data['price'])),
                    'account_price' => ceil($data['price'] + ($percentage * $data['price'])),
                    'type' => $plan_type,
                    'status' => 1,
                    'admin_price' => ceil($data['price'] + ($selling_price_percentage * $data['price']))
                ]);
            }

            return ['success' => true];
        }

        return ['success' => false];
    }

    public function reset_all_data_prices()
    {
        $user = Auth::user();
        if (!in_array($user->email, ['fasanyafemi@gmail.com', 'manager@gmail.com'])) {
            return redirect('dashboard');
        }

        // Define all combinations of type strings used in the buttons
        $types = [
            'mtn_sme',
            'mtn_awoof',
            'mtn_cg',
            'mtn_cg_lite',
            'mtn_gifting',
            'glo_cg',
            'glo_gifting',
            'glo_awoof',
            'airtel_cg',
            'airtel_awoof',
            'airtel_gifting',
            '9mobile_sme',
            '9mobile_gifting'
        ];



        $errors = [];
        foreach ($types as $type) {
            $response = $this->reset_data_price_logic($type); // Custom logic extracted from your original function

            if (!$response['success']) {
                $errors[] = $type;
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->with('error', 'Some plans failed to reset: ' . implode(', ', $errors));
        }

        return redirect()->back()->with('message', 'All Data Prices Reset Successfully!');
    }


    public function schedule_accounts()
    {
        $schedules = ScheduleAccount::get();
        dd($schedules);
    }
    public function admin_giveaway()
    {
        $data['user'] = $user = Auth::user();
        if ($user->email == 'fasanyafemi@gmail.com') {
            $data['giveaways'] = GiveAway::latest()->get();
            $data['active'] = 'giveaway';

            return view('super.giveaway', $data);
        } else {
            return redirect()->back()->with('message', 'Access Denied');
        }
    }
    public function plan_status()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['mtn_sme'] = Data::where('user_id', 0)->where('type', 'SME')->where('network', 1)->first();
        $data['mtn_awoof'] = Data::where('user_id', 0)->where('type', 'AWOOF')->where('network', 1)->first();
        $data['mtn_cg'] = Data::where('user_id', 0)->where('type', 'cg')->where('network', 1)->first();
        $data['mtn_cg_lite'] = Data::where('user_id', 0)->where('type', 'cg_lite')->where('network', 1)->first();
        $data['mtn_gifting'] = Data::where('user_id', 0)->where('type', 'gifting')->where('network', 1)->first();


        $data['glo_cg'] = Data::where('user_id', 0)->where('type', 'cg')->where('network', 2)->first();
        $data['glo_awoof'] = Data::where('user_id', 0)->where('type', 'awoof')->where('network', 2)->first();
        $data['glo_gifting'] = Data::where('user_id', 0)->where('type', 'gifting')->where('network', 2)->first();

        $data['airtel_awoof'] = Data::where('user_id', 0)->where('type', 'AWOOF')->where('network', 3)->first();
        $data['airtel_cg'] = Data::where('user_id', 0)->where('type', 'cg')->where('network', 3)->first();
        $data['airtel_gifting'] = Data::where('user_id', 0)->where('type', 'gifting')->where('network', 3)->first();

        $data['nmobile_sme'] = Data::where('user_id', 0)->where('type', 'SME')->where('network', 4)->first();
        $data['nmobile_gifting'] = Data::where('user_id', 0)->where('type', 'gifting')->where('network', 4)->first();


        return view('super.plan_status', $data);
    }
    public function update_plan_status($network_id, $type)
    {
        //    dd(Data::where('network', $network_id)->where('type', $type)->where('user_id',0)->get());
        if (Data::where('network', $network_id)->where('type', $type)->first()->status == 0) {
            $datas = Data::where('network', $network_id)->where('type', $type)->update([
                'status' => 1
            ]);
        } else {
            $datas = Data::where('network', $network_id)->where('type', $type)->update([
                'status' => 0
            ]);
        }
        // $datas = Data::where('network',$network_id)->where('type',$type)->update([
        //     'status' => DB::raw('NOT status')
        // ]);
        return redirect()->back()->with('message', 'Status Updated Successfully');
    }
    public function update_data(Request $request)
    {
        // dd($request->all());

        $datas = Data::where('plan_id', $request->plan_id)
            // ->where('user_id', '!=', 888)
            ->get();
        foreach ($datas as $data) {
            $data->plan_name = $request->plan_name;
            $data->actual_price = $request->actual_price;
            $data->data_price = $request->data_price;
            $data->account_price = $request->account_price;
            $data->admin_price = $request->account_price;
            $data->save();
        }

        return true;
    }

    public function cable_price()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['cables'] = Cable::where('user_id', 0)->latest()->get();
        return view('super.cable_price', $data);
    }
    public function update_cable(Request $request)
    {
        $cables = Cable::where('plan_id', $request->plan_id)
            // ->where('user_id', '!=', 888)
            ->get();
        foreach ($cables as $cable) {
            $cable->plan_name = $request->plan_name;
            $cable->actual_price = $request->actual_price;
            $cable->admin_price = $request->real_price;
            $cable->real_price = $request->real_price;
            $cable->save();
        }

        return true;
    }

    //I am not using this function for now, but this is meant to reset cable price from easyaccess
    public function reset_cable_price($type)
    {
        $user = Auth::user();
        if (!in_array($user->email, ['fasanyafemi@gmail.com', 'manager@gmail.com'])) {
            return redirect('dashboard');
        }

        // Map cable types to company IDs
        $company_mapping = [
            'dstv' => 1,
            'gotv' => 2,
            'startimes' => 3,
            'showmax' => 4
        ];

        $company = $company_mapping[$type] ?? 1;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/get_plans.php?product_type=" . $type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: " . env('EASY_ACCESS_AUTH'),
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response_json = json_decode($response, true);
        $online_data = reset($response_json);

        if ($online_data && is_array($online_data) && count($online_data) > 0) {
            // Delete previous cable data for this type and company
            Cable::where('user_id', 0)->where('type', $type)->where('company', $company)->delete();

            foreach ($online_data as $cable) {
                Cable::create([
                    'user_id' => 0,
                    'company' => $company,
                    'plan_id' => $cable['plan_id'],
                    'plan_name' => strtoupper($type) . ' ' . $cable['name'],
                    'actual_price' => ceil($cable['price']),
                    'real_price' => ceil($cable['price'] + (0.04 * $cable['price'])),
                    'admin_price' => ceil($cable['price'] + (0.06 * $cable['price'])),
                    'type' => $type,
                    'status' => 1
                ]);
            }
            return redirect()->back()->with('message', 'Cable Price Updated Successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update cable price.');
    }

    private function reset_cable_price_logic($type)
    {
        // Map cable types to company IDs
        $company_mapping = [
            'dstv' => 1,
            'gotv' => 2,
            'startimes' => 3,
            'showmax' => 4
        ];

        $company = $company_mapping[$type] ?? 1;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/get_plans.php?product_type=" . $type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: " . env('EASY_ACCESS_AUTH'),
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response_json = json_decode($response, true);
        $online_data = reset($response_json);

        if ($online_data && is_array($online_data) && count($online_data) > 0) {
            Cable::where('type', $type)->where('company', $company)->delete();

            foreach ($online_data as $cable) {
                Cable::create([
                    'user_id' => 0,
                    'company' => $company,
                    'plan_id' => $cable['plan_id'],
                    'plan_name' => $cable['name'],
                    'actual_price' => ceil($cable['price']),
                    'real_price' => ceil($cable['price'] + (0.04 * $cable['price'])),
                    'admin_price' => ceil($cable['price'] + (0.06 * $cable['price'])),
                    'type' => $type,
                    // 'status' => 1
                ]);
            }

            return ['success' => true];
        }

        return ['success' => false];
    }

    // reset_all_cable_prices() method remains the same

    public function reset_all_cable_prices()
    {
        $user = Auth::user();
        if (!in_array($user->email, ['fasanyafemi@gmail.com', 'manager@gmail.com'])) {
            return redirect('dashboard');
        }

        // Define all cable types
        $types = [
            'dstv',
            'gotv',
            'startimes',
            'showmax'
        ];

        $errors = [];
        foreach ($types as $type) {
            $response = $this->reset_cable_price_logic($type);

            if (!$response['success']) {
                $errors[] = $type;
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->with('error', 'Some cable plans failed to reset: ' . implode(', ', $errors));
        }

        return redirect()->back()->with('message', 'All Cable Prices Reset Successfully!');
    }


    public function exam_price()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['exams'] = Examination::where('user_id', 0)->latest()->get();
        return view('super.exam_price', $data);
    }
    public function update_exam(Request $request)
    {

        $exams = Examination::where('name', $request->name)
            // ->where('user_id', '!=', 888)
            ->get();

        foreach ($exams as $exam) {
            $exam->name = $request->name;
            $exam->actual_amount = $request->actual_amount;
            $exam->real_amount = $request->real_amount;
            $exam->save();
        }
        return redirect()->back()->with('message', 'Examination Price Updated Successfully!');
        return true;
    }

    public function reset_exam_price($type)
    {
        $user = Auth::user();
        if (!in_array($user->email, ['fasanyafemi@gmail.com', 'manager@gmail.com'])) {
            return redirect('dashboard');
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/get_plans.php?product_type=" . $type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: " . env('EASY_ACCESS_AUTH'),
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response_json = json_decode($response, true);
        $online_data = reset($response_json);

        if ($online_data && is_array($online_data) && count($online_data) > 0) {
            // Delete previous exam data for this type
            Examination::where('exam_type', $type)->delete();

            foreach ($online_data as $exam) {
                Examination::create([
                    'user_id' => 0,
                    'exam_type' => $type,
                    'name' => ucfirst(Str::lower($type)) . " Result Checker",
                    'actual_amount' => ceil($exam['price']),
                    'real_amount' => ceil($exam['price'] + (0.03 * $exam['price'])),
                    'status' => 1
                ]);
            }
            return redirect()->back()->with('message', 'Exam Price Updated Successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update exam price.');
    }

    private function reset_exam_price_logic($type)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/get_plans.php?product_type=" . $type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: " . env('EASY_ACCESS_AUTH'),
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response_json = json_decode($response, true);
        $online_data = reset($response_json);

        if ($online_data && is_array($online_data) && count($online_data) > 0) {
            Examination::where('exam_type', $type)->delete();

            foreach ($online_data as $exam) {
                Examination::create([
                    'user_id' => 0,
                    'exam_type' => $type,
                    'name' => ucfirst(Str::lower($type)) . " Result Checker",
                    'actual_amount' => ceil($exam['price']),
                    'real_amount' => ceil($exam['price'] + (0.05 * $exam['price'])),
                    // 'status' => 1
                ]);
            }

            return ['success' => true];
        }

        return ['success' => false];
    }

    public function reset_all_exam_prices()
    {
        $user = Auth::user();
        if (!in_array($user->email, ['fasanyafemi@gmail.com', 'manager@gmail.com'])) {
            return redirect('dashboard');
        }

        // Define all exam types
        $types = [
            'waec',
            'neco',
            'nabteb',
            'nbais'
        ];

        $errors = [];
        foreach ($types as $type) {
            $response = $this->reset_exam_price_logic($type);

            if (!$response['success']) {
                $errors[] = $type;
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->with('error', 'Some exam plans failed to reset: ' . implode(', ', $errors));
        }

        return redirect()->back()->with('message', 'All Exam Prices Reset Successfully!');
    }

    public function payment_transactions()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['payments'] = Transaction::where('title', 'Account Funding')
            ->orWhere('title', 'Fund Transfer')
            ->orWhere('title', 'Payment Received')
            ->orWhere('title', 'Funds Withdraw')
            ->latest()->take(100)->get();
        return view('super.payment_transactions', $data);
    }
    public function all_withdrawals()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'withdrawal';
        $data['payments'] = Transaction::where('title', 'Funds Withdraw')

            ->latest()->get();
        return view('super.withdrawal', $data);
    }
    public function approve_withdraw($id)
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $tranx = Transaction::find($id);
        $tranx_user = User::find($tranx->user_id);
        $tranx_user->balance -= $tranx->amount;
        $tranx_user->save();
        $tranx->after = $tranx_user->balance;
        $tranx->status = 1;
        $tranx->save();
        return redirect()->back()->with('message', 'Withdrawal Approved!');
    }
    public function revert_withdraw($id)
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $tranx = Transaction::find($id);
        $tranx_user = User::find($tranx->user_id);
        $tranx_user->balance += $tranx->amount;
        $tranx_user->save();
        $tranx->after = $tranx_user->balance;
        $tranx->status = 2;
        $tranx->save();
        return redirect()->back()->with('message', 'Withdrawal revert!');
    }

    public function user_management()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['allusers'] =  User::count();

        $data['users'] = User::where('total_spent', '!=', 0)->orWhere('balance', '>', 0)
            ->latest()->get();
        // $data['users'] = User::latest()->get();
        $data['active'] = 'super';

        return view('super.user_management', $data);
    }
    public function new_users()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['allusers'] =  User::count();

        $data['users'] = User::latest()->take(100)->get();
        // $data['users'] = User::latest()->get();
        $data['active'] = 'super';

        return view('super.user_management', $data);
    }
    public function user_transaction($id)
    {
        $data['user'] =  $user = User::where('uuid', $id)->first();
        // dd($user);

        $data['transactions'] = Transaction::where('user_id', $user->id)
            // ->where('title', 'Data Purchase')
            // ->orWhere('title', 'Airtime Purchase')
            // ->orWhere('title', 'Cable Subscription')
            // ->orWhere('title', 'Electricity Payment')
            ->latest()->get();
        $data['active'] = 'super';

        return view('super.index', $data);
    }
    public function block_user($id)
    {
        $data['user'] =  $user = User::where('uuid', $id)->first();

        if ($user) {
            if ($user->block == 1) {
                $user->block = 0;
                $user->save();
                return redirect()->back()->with('message', "User Unblocked Successfully!");
            } else {
                $user->block = 1;
                $user->save();
                return redirect()->back()->with('message', "User Blocked Successfully!");
            }
        }
    }
    public function duplicate_transactions()
    {
        $data['user'] = $user =  Auth::user();

        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';


        // $fast_token = User::where('email','fasanyafemi@gmail.com')->first()->instagram;
        // return [ env("EASY_ACCESS_AUTH"), $fast_token];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/wallet_balance.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // "AuthorizationToken: " .$fast_token, //replace this with your authorization_token
                "AuthorizationToken: " . env("EASY_ACCESS_AUTH"), //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response_json = json_decode($response, true);
        $data['easy_balance'] = $response_json['balance'];

        $data['duplicate_transactions'] = DuplicateTransaction::latest()->get();

        return view('super.duplicate_transactions', $data);
    }
    public function contact_gain()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';

        return view('super.contact_gain', $data);
    }
    public function admin_blog()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['blogs'] = Blog::latest()->get();

        return view('super.admin_blog', $data);
    }
    public function create_blog()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';

        return view('super.create_blog', $data);
    }

    public function saveblog(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "category" => "required",
            "image" => "required",

        ]);

        if ($request->image !== null) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('blog_display_image'), $imageName);
        }
        $user = Auth::user();


        $project = Blog::create([
            'uid' => Str::random(7),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imageName,
        ]);

        return redirect()->back()->with('message', 'Blog created successfully!');
    }

    public function editblog($id)
    {
        $data['blog'] = Blog::find($id);
        $data['user'] = Auth::user();
        $data['active'] = 'blog';
        return view('super.editblog', $data);
    }

    public function updateblog(Request $request)
    {
        $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "category" => "required",

        ]);
        $project = Blog::find($request->id);
        // dd($request->all());


        $user = Auth::user();
        if ($request->image !== null) {
            $previousImagePath = public_path('blog_display_image') . '/' . $project->image;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('blog_display_image'), $imageName);
            $project->image = $imageName;
        }
        $project->title = $request->title;
        $project->description = $request->description;
        $project->category = $request->category;
        $project->save();



        return redirect()->back()->with('message', 'Blog updated successfully!');
    }
    public function changeblogstatus($id)
    {
        $blog = Blog::find($id);

        $blog->status = !$blog->status;
        $blog->save();
        return redirect()->back()->with('message', 'Blog Status Updated Successfully!');
    }
    public function deleteblog($id)
    {
        $blog = Blog::find($id);
        $previousImagePath = public_path('blog_display_image') . '/' . $blog->image;
        if (file_exists($previousImagePath)) {
            unlink($previousImagePath);
        }
        $blog->delete();
        return redirect()->back()->with('message', 'Blog Deleted Successfully!');
    }
    public function deleteuser($id)
    {
        $user = User::where('uuid', $id)->firstOrFail();
        $trans = Transaction::where('id', $user->id)->delete();
        $user->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully!');
    }

    public function downloadCSV(Request $request)
    {
        // dd($request->all());
        // $users = User::where('created_at', '>', $request->from)->where('created_at', '<', $request->to)->get(['name', 'phone']);

        $users = User::where('created_at', '>', $request->from)
            ->where('created_at', '<', $request->to)
            ->where(function ($query) use ($request) {
                $query->where('company_id', '!=', 888)
                    ->orWhere('company_id', '=', DB::raw('id'));
            })
            ->select([
                DB::raw("CONCAT('$request->prefix ', name) as name"),
                'phone',
            ])
            ->get();




        // $users = User::where('created_at', '>', $request->from)
        //     ->where('created_at', '<', $request->to)
        //     ->where('company_id', 5)
        //     ->where('company_id', '!=', 'id')
        //     ->select([
        //         DB::raw("CONCAT('$request->prefix ', name) as name"),
        //         'phone'
        //     ])
        //     ->get();

        $filename = Carbon::now()->format('d-m-Y') . '_users_data.csv';

        // Set the content type and headers for file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Open a file handle for PHP's output stream
        $handle = fopen('php://output', 'w');

        // Insert the header
        fputcsv($handle, ['Name', 'Phone']);

        // Insert the user data
        foreach ($users as $user) {
            fputcsv($handle, [$user->name, $user->phone]);
        }

        // Close the file handle
        fclose($handle);
        exit;
    }
    public function upgrade_user($id)
    {

        if (Auth::user()->email == 'fasanyafemi@gmail.com') {
            $data['user'] =  $user = User::where('uuid', $id)->first();
            // dd($user);

            if ($user) {
                $datas = Data::where('user_id', $user->id)->get();
                // $datas = Data::where('user_id', $user->company_id)->get();
                $real_data = Data::where('user_id', 0)->get();
                if ($user->upgrade == 1) {
                    //update the user's data prices
                    $user->company_id = 5;
                    $user->save();


                    foreach ($datas as $data) {
                        // Get the corresponding $real_data with the same plan_id 
                        $matchingRealData = $real_data->first(function ($realData) use ($data) {
                            return $realData->plan_id === $data->plan_id;
                        });
                        // dd($matchingRealData);
                        if ($matchingRealData) {
                            // Update the data_price of $data with the account_price of $matchingRealData
                            $data->data_price = $matchingRealData->account_price;
                            $data->account_price = $matchingRealData->account_price;
                            $data->admin_price = $matchingRealData->account_price;
                            $data->save();
                        }
                    }
                    $user->upgrade = 0;
                    $user->user_type = 'customer';

                    $user->save();
                    return redirect()->back()->with('message', "User Degraded Successfully!");
                } else {
                    //update the user's data prices
                    $user->company_id = $user->id;
                    $user->save();

                    foreach ($datas as $data) {

                        // Get the corresponding $real_data with the same plan_id
                        $matchingRealData = $real_data->first(function ($realData) use ($data) {
                            return $realData->plan_id === $data->plan_id;
                        });

                        if ($matchingRealData) {
                            // dd( $data->data_price, $matchingRealData->data_price);
                            // Update the data_price of $data with the account_price of $matchingRealData
                            $data->data_price = $matchingRealData->data_price;
                            $data->account_price = $matchingRealData->account_price;
                            $data->admin_price = $matchingRealData->account_price;
                            $data->save();
                        }
                    }
                    $user->upgrade = 1;
                    $user->user_type = 'admin';
                    $user->save();
                    return redirect()->back()->with('message', "User Upgraded Successfully!");
                }
            }
        } else {
            return "Access Denied";
        }
    }
    public function reset_pin($id)
    {

        if (Auth::user()->email == 'fasanyafemi@gmail.com') {
            $data['user'] =  $user = User::where('uuid', $id)->first();
            if ($user) {
                $user->pin =  hash('sha256', '1234');
                $user->save();
                return redirect('/superadmin')->with('message', 'Pin updated successfully');
            }
        } else {
            return "Access Denied";
        }
    }
    public function reset_password($id)
    {

        if (Auth::user()->email == 'fasanyafemi@gmail.com') {
            $data['user'] =  $user = User::where('uuid', $id)->first();
            if ($user) {
                $user->password = Hash::make('Password123');
                $user->save();
                return redirect()->back()->with('message', 'Password updated successfully');
            }
        } else {
            return "Access Denied";
        }
    }
}
