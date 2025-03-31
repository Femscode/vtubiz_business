<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
       
        return response()->json([
            'status' => true,
            'message' => 'User profile fetched successfully',
            'data' => $user,

        ], 201);
    }

    public function referral_details() {
        $data['user'] = $user = Auth::user();
        $data['referrals'] = User::where('referred_by', $user->brand_name)->latest()->get();
        $data['earnings'] = User::where('referred_by', $user->brand_name)->sum('earnings');
       
        return response()->json($data);
    }

    public function oldremitearning()
    {
        $user = Auth::user();
        $earnings = User::where('referred_by', $user->brand_name)->sum('earnings');
        if ($earnings == 0) {
            return redirect()->back()->with('error', 'You do not have any amount to remit!');
        }
        // dd($earnings);

        $client_reference = "RefEarn_" . Str::random(5);
        $details = "Referral Earning (NGN" . $earnings . ") added to balance";
        $trans_id = $this->create_transaction('Remit Earning', $client_reference, $details, 'credit', $earnings, $user->id, 1);

        $data['users'] = User::where('referred_by', $user->brand_name)->update(['earnings' => 0]);
        return redirect()->route('dashboard')->with('message', 'Referral Earnings remitted successfully!');
    }
    public function remitearning()
    {
        try {
            $user = Auth::user();
            $earnings = User::where('referred_by', $user->brand_name)->sum('earnings');
            
            if ($earnings == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have any amount to remit'
                ], 400);
            }

            $client_reference = "RefEarn_" . Str::random(5);
            $details = "Referral Earning (NGN" . $earnings . ") added to balance";
            $trans_id = $this->create_transaction('Remit Earning', $client_reference, $details, 'credit', $earnings, $user->id, 1);

            User::where('referred_by', $user->brand_name)->update(['earnings' => 0]);

            return response()->json([
                'success' => true,
                'message' => 'Referral Earnings remitted successfully',
                'data' => [
                    'amount' => $earnings,
                    'transaction_id' => $trans_id
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request'
            ], 500);
        }
    }
   
}
