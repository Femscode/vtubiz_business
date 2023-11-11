<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Airtime;
use App\Models\DataGroup;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\AirtimeGroup;
use Illuminate\Http\Request;
use App\Models\DataRecipient;
use App\Models\AirtimeRecipient;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function admin_data_group()
    {
        $data['user'] = $user = Auth::user();
        if($user->user_type == 'customer' || $user->user_type == 'client_customer') {
            return redirect('/premium-data_group');
        }
        $data['data_groups'] = DataGroup::where('user_id', $user->id)->latest()->get();
        return view('business_backend.data_group', $data);
    }
    public function data_group()
    {
        $data['active'] = 'data_group';
        $data['user'] = $user = Auth::user();
        $data['data_groups'] = DataGroup::where('user_id', $user->id)->latest()->get();
        return view('dashboard.data_group', $data);
    }
    public function admin_airtime_group()
    {
        $data['active'] = 'airtime_group';
        $data['user'] = $user = Auth::user();
        if($user->user_type == 'customer' || $user->user_type == 'client_customer') {
            return redirect('/premium-airtime_group');
        }
        $data['airtime_groups'] = AirtimeGroup::where('user_id', $user->id)->latest()->get();
        return view('business_backend.airtime_group', $data);
    }
    public function airtime_group()
    {
        $data['active'] = 'airtime_group';
        $data['user'] = $user = Auth::user();
        $data['airtime_groups'] = AirtimeGroup::where('user_id', $user->id)->latest()->get();
        return view('dashboard.airtime_group', $data);
    }

    public function admin_createGroup(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, ['name' => 'required']);
        DataGroup::create([
            'uid' => Str::uuid(),
            'user_id' => $user->id,
            'name' => $request->name
        ]);
        // dd($request->all());

        return redirect()->back()->with('message', 'Group Created Successfully!');
    }
    public function admin_createAirtimeGroup(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, ['name' => 'required']);
        AirtimeGroup::create([
            'uid' => Str::uuid(),
            'user_id' => $user->id,
            'name' => $request->name
        ]);
        // dd($request->all());

        return redirect()->back()->with('message', 'Group Created Successfully!');
    }
   public function admin_group_transactions($id) {
    $data['user'] = Auth::user();
    $data['transactions'] = Transaction::where('group_id',$id)->latest()->get();
    $data['group'] = DataGroup::where('uid',$id)->firstOrFail();
    return view('business_backend.group_transactions',$data);
   }
   public function admin_group_airtime_transactions($id) {
    $data['user'] = Auth::user();
    $data['transactions'] = Transaction::where('group_id',$id)->latest()->get();
    $data['group'] = AirtimeGroup::where('uid',$id)->firstOrFail();
    return view('business_backend.group_airtime_transactions',$data);
   }
   public function group_airtime_transactions($id) {
    $data['active'] = 'airtime_group';
    $data['user'] = Auth::user();
    $data['transactions'] = Transaction::where('group_id',$id)->latest()->get();
    $data['group'] = AirtimeGroup::where('uid',$id)->firstOrFail();
    return view('dashboard.group_airtime_transactions',$data);
   }
   public function group_transactions($id) {
    $data['active'] = 'data_group';
    $data['user'] = Auth::user();
    $data['transactions'] = Transaction::where('group_id',$id)->latest()->get();
    $data['group'] = DataGroup::where('uid',$id)->firstOrFail();
    return view('dashboard.group_transactions',$data);
   }
    public function deleteGroup($id)
    {
        $group = DataGroup::where('uid', $id)->firstOrFail();
        $recipient = DataRecipient::where('group_id', $group->id)->delete();
        $group->delete();
        return redirect()->back()->with('message', 'Group Deleted Successfully!');
    }
    public function admin_deleteAirtimeGroup($subdomain=null,$id)
    {
        $group = AirtimeGroup::where('uid', $id)->firstOrFail();
        $recipient = AirtimeRecipient::where('group_id', $group->id)->delete();
        $group->delete();
        return redirect()->back()->with('message', 'Group Deleted Successfully!');
    }
    public function admin_data_recipient($id)
    {
        $data['user'] = $user = Auth::user();
        $data['group'] = $group = DataGroup::where('uid', $id)->firstOrFail();
        $data['recipients'] = DataRecipient::where('group_id', $group->id)->latest()->get();
        return view('business_backend.data_recipient', $data);
    }
    public function admin_airtime_recipient($id)
    {
        $data['user'] = $user = Auth::user();
        if($user->user_type == 'customer' || $user->user_type == 'client_customer') {
            // dd('here');

            return redirect('/premium-airtime_recipients/'.$id);
        }
        $data['group'] = $group = AirtimeGroup::where('uid', $id)->firstOrFail();
        $data['recipients'] = AirtimeRecipient::where('group_id', $group->id)->latest()->get();
        return view('business_backend.airtime_recipients', $data);
    }
    public function airtime_recipients($id)
    {
        $data['active'] = 'airtime_group';
        $data['user'] = $user = Auth::user();
        $data['group'] = $group = AirtimeGroup::where('uid', $id)->firstOrFail();
        $data['recipients'] = AirtimeRecipient::where('group_id', $group->id)->latest()->get();
        return view('dashboard.airtime_recipients', $data);
    }
    public function data_recipient($id)
    {
        // dd('here',$id);
        $data['active'] = 'data_group';
        $data['user'] = $user = Auth::user();
      
        $data['group'] = $group = DataGroup::where('uid', $id)->firstOrFail();
        $data['recipients'] = DataRecipient::where('group_id', $group->id)->latest()->get();
        return view('dashboard.data_recipient', $data);
    }
    public function admin_saveRecipient(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required',
            'network' => 'required',
            'phone' => 'required',
            'plan_id' => 'required'
        ]);
        $data = Data::where('user_id', $user->company_id)->where('plan_id', $request->plan_id)->where('network', $request->network)->first();
        $amount =  $data->admin_price;
        $data = $request->all();
        $data['amount'] = $amount;
        $data['uid'] = Str::uuid();
        $saved_recipient = DataRecipient::create($data);
        return $saved_recipient;
    }
    public function admin_saveAirtimeRecipient(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required',
            'network' => 'required',
            'phone' => 'required',
            'amount' => 'required'
        ]);
        // dd($request->all());
        $amount =  $request->amount;
        $data = $request->all();
        $data['amount'] = $amount;
        $data['uid'] = Str::uuid();
        $saved_recipient = AirtimeRecipient::create($data);
        return $saved_recipient;
    }
    
    public function admin_deleteRecipient($id) {
        $recipient = DataRecipient::where('uid',$id)->firstOrFail();
        // dd($recipient);
        $recipient->delete();
        return redirect()->back()->with('message', 'Recipient Deleted Successfully!');
    }
    public function admin_deleteAirtimeRecipient($id) {
        $recipient = AirtimeRecipient::where('uid',$id)->firstOrFail();
        // dd($recipient);
        $recipient->delete();
        return redirect()->back()->with('message', 'Recipient Deleted Successfully!');
    }
}
