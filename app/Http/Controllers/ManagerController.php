<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cable;
use App\Models\Data;
use App\Models\DuplicateTransaction;
use App\Models\Examination;
use App\Models\GiveAway;
use App\Models\Notification;
use App\Models\ScheduleAccount;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManagerController extends Controller
{
    public function index()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'manager';
        $data['transactions'] = Transaction::where('title', 'Data Purchase')
            ->orWhere('title', 'Airtime Purchase')
            ->orWhere('title', 'Cable Subscription')
            ->orWhere('title', 'Electricity Payment')
            ->orWhere('title', 'Bulk SMS')
            ->orWhere('title', 'Examination Result Payment')
            ->latest()->take(100)->get();
        return view('manager.index', $data);
    }
    public function alltransactions()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['transactions'] = Transaction::latest()->take(150)->get();

        return view('manager.index', $data);
    }

    public function data_price()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['datas'] = Data::where('user_id', 0)->latest()->orderBy('network')->get();

        return view('manager.data_price', $data);
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

            return view('manager.giveaway', $data);
        } else {
            return redirect()->back()->with('message', 'Access Denied');
        }
    }
    public function plan_status()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['mtn_sme'] = Data::where('user_id', 0)->where('type', 'SME')->where('network', 1)->first();
        $data['mtn_cg'] = Data::where('user_id', 0)->where('type', 'cg')->where('network', 1)->first();
        $data['mtn_cg_lite'] = Data::where('user_id', 0)->where('type', 'cg_lite')->where('network', 1)->first();
        $data['mtn_direct'] = Data::where('user_id', 0)->where('type', 'direct')->where('network', 1)->first();

        $data['glo_sme'] = Data::where('user_id', 0)->where('type', 'SME')->where('network', 2)->first();

        $data['glo_cg'] = Data::where('user_id', 0)->where('type', 'cg')->where('network', 2)->first();
        $data['glo_cg_lite'] = Data::where('user_id', 0)->where('type', 'cg_lite')->where('network', 2)->first();
        $data['glo_direct'] = Data::where('user_id', 0)->where('type', 'direct')->where('network', 2)->first();

        $data['airtel_sme'] = Data::where('user_id', 0)->where('type', 'SME')->where('network', 3)->first();
        $data['airtel_cg'] = Data::where('user_id', 0)->where('type', 'cg')->where('network', 3)->first();
        $data['airtel_cg_lite'] = Data::where('user_id', 0)->where('type', 'cg_lite')->where('network', 3)->first();
        $data['airtel_direct'] = Data::where('user_id', 0)->where('type', 'direct')->where('network', 3)->first();

        $data['nmobile_sme'] = Data::where('user_id', 0)->where('type', 'SME')->where('network', 4)->first();
        $data['nmobile_cg'] = Data::where('user_id', 0)->where('type', 'cg')->where('network', 4)->first();
        $data['nmobile_cg_lite'] = Data::where('user_id', 0)->where('type', 'cg_lite')->where('network', 4)->first();
        $data['nmobile_direct'] = Data::where('user_id', 0)->where('type', 'direct')->where('network', 4)->first();


        return view('manager.plan_status', $data);
    }
    public function update_plan_status($network_id, $type)
    {
        // dd($network_id, $type);
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

    public function user_records() {
        $data['active'] = 'user_orders';
        $data['user'] = Auth::user();

        $data['total_users'] = count(User::all());
        $data['active_users'] = count(User::where('total_spent', '>', 0)->get());

        foreach (range(1, 12) as $month) {
            $monthName = strtolower(Carbon::createFromDate(2025, $month, 1)->format('F'));
        
            $data[$monthName] = User::whereBetween('created_at', [
                Carbon::createFromDate(2025, $month, 1)->startOfMonth(),
                Carbon::createFromDate(2025, $month, 1)->endOfMonth()
            ])->count();
        }
         return view('manager.user_records', $data);
    }
    public function user_records_2024() {
        $data['active'] = 'user_orders';
        $data['user'] = Auth::user();

        $data['total_users'] = count(User::all());
        $data['active_users'] = count(User::where('total_spent', '>', 0)->get());

        foreach (range(1, 12) as $month) {
            $monthName = strtolower(Carbon::createFromDate(2024, $month, 1)->format('F'));
        
            $data[$monthName] = User::whereBetween('created_at', [
                Carbon::createFromDate(2024, $month, 1)->startOfMonth(),
                Carbon::createFromDate(2024, $month, 1)->endOfMonth()
            ])->count();
        }
         return view('manager.user_records', $data);
    }
    public function purchase_records() {
        $data['active'] = 'user_orders';
        $data['user'] = Auth::user();

        $data['total_transactions'] = Transaction::where(function($query) {
            $query->where('title', 'Data Purchase')
                ->orWhere('title', 'Airtime Purchase')
                ->orWhere('title', 'Cable Subscription')
                ->orWhere('title', 'Electricity Payment')
                ->orWhere('title', 'Bulk SMS')
                ->orWhere('title', 'Examination Result Payment');
        })->whereYear('created_at', '2025')->count();
        
        foreach (range(1, 12) as $month) {
            $monthName = strtolower(Carbon::createFromDate(2024, $month, 1)->format('F'));
        
            $data[$monthName] = Transaction::where(function($query) {
                $query->where('title', 'Data Purchase')
                    ->orWhere('title', 'Airtime Purchase')
                    ->orWhere('title', 'Cable Subscription')
                    ->orWhere('title', 'Electricity Payment')
                    ->orWhere('title', 'Bulk SMS')
                    ->orWhere('title', 'Examination Result Payment');
            })->whereBetween('created_at', [
                Carbon::createFromDate(2025, $month, 1)->startOfMonth(),
                Carbon::createFromDate(2025, $month, 1)->endOfMonth()
            ])->count();
        }
        // dd($jan);
        return view('manager.purchase_records', $data);
    }
    public function purchase_records_2024() {
        $data['active'] = 'user_orders';
        $data['user'] = Auth::user();

        $data['total_transactions'] = Transaction::where(function($query) {
            $query->where('title', 'Data Purchase')
                ->orWhere('title', 'Airtime Purchase')
                ->orWhere('title', 'Cable Subscription')
                ->orWhere('title', 'Electricity Payment')
                ->orWhere('title', 'Bulk SMS')
                ->orWhere('title', 'Examination Result Payment');
        })->whereYear('created_at', '2024')->count();
        
        foreach (range(1, 12) as $month) {
            $monthName = strtolower(Carbon::createFromDate(2024, $month, 1)->format('F'));
        
            $data[$monthName] = Transaction::where(function($query) {
                $query->where('title', 'Data Purchase')
                    ->orWhere('title', 'Airtime Purchase')
                    ->orWhere('title', 'Cable Subscription')
                    ->orWhere('title', 'Electricity Payment')
                    ->orWhere('title', 'Bulk SMS')
                    ->orWhere('title', 'Examination Result Payment');
            })->whereBetween('created_at', [
                Carbon::createFromDate(2024, $month, 1)->startOfMonth(),
                Carbon::createFromDate(2024, $month, 1)->endOfMonth()
            ])->count();
        }
        // dd($jan);
        return view('manager.purchase_records', $data);
    }
    public function notifications()
    {
        //check if user have notifications
        $data['user'] = $user = Auth::user();
        $data['active'] = 'notifications';
        $notification = Notification::where('user_id', $user->id)->first();
        if ($notification) {
            $data['notifications'] = Notification::where('user_id', $user->id)->get();
        } else {
            //create notifications for users once there is non
            Notification::create([
                'user_id' => $user->id,
                'type' => "Airtime Notification",
            ]);
            Notification::create([
                'user_id' => $user->id,
                'type' => "Data Notification",
            ]);
            Notification::create([
                'user_id' => $user->id,
                'type' => "Cable Notification",
            ]);
            Notification::create([
                'user_id' => $user->id,
                'type' => "Electricity Notification",
            ]);
            Notification::create([
                'user_id' => $user->id,
                'type' => "Examination Notification",
            ]);
            Notification::create([
                'user_id' => $user->id,
                'type' => "Bulksms Notification",
            ]);
            Notification::create([
                'user_id' => $user->id,
                'type' => "General Notification",
            ]);
            Notification::create([
                'user_id' => $user->id,
                'type' => "Payment Notification",
            ]);
            $data['notifications'] = Notification::where('user_id', $user->id)->get();
        }
        // dd($data);
        return view('manager.notifications', $data);
    }
    public function update_data(Request $request)
    {
        // dd($request->all());

        $datas = Data::where('plan_id', $request->plan_id)
            ->where('user_id', '!=', 888)
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



    public function payment_transactions()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['payments'] = Transaction::where('title', 'Account Funding')
            ->orWhere('title', 'Fund Transfer')
            ->orWhere('title', 'Payment Received')
            ->orWhere('title', 'Funds Withdraw')
            ->latest()->take(100)->get();
        return view('manager.payment_transactions', $data);
    }

    public function user_management()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['allusers'] =  User::count();

        $data['users'] = User::where('total_spent', '!=', 0)->latest()->get();
        // $data['users'] = User::latest()->get();
        $data['active'] = 'super';

        return view('manager.user_management', $data);
    }
    public function new_users()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['allusers'] =  User::count();

        $data['users'] = User::latest()->take(100)->get();
        // $data['users'] = User::latest()->get();
        $data['active'] = 'super';

        return view('manager.user_management', $data);
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

        return view('manager.index', $data);
    }
   
    public function duplicate_transactions()
    {
        $data['user'] = $user =  Auth::user();

        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
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

        return view('manager.duplicate_transactions', $data);
    }
    public function contact_gain()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';

        return view('manager.contact_gain', $data);
    }
    public function admin_blog()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['blogs'] = Blog::latest()->get();

        return view('manager.admin_blog', $data);
    }
    public function create_blog()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || $user->email !== 'manager@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';

        return view('manager.create_blog', $data);
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
        return view('manager.editblog', $data);
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
                return redirect()->route('dashboard')->with('message', 'Pin updated successfully');
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
