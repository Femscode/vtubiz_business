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
       
        return response()->json([
            'status' => true,
            'message' => 'User profile fetched successfully',
            'data' => $user,

        ], 201);
    }
   
}
