<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
   
}
