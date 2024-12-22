<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->latest()->take(10)->get();

        return response()->json([
            'status' => true,
            'message' => 'User profile fetched successfully',
            'data' => $user,
            'transactions' => $transactions,

        ], 201);
    }
}
