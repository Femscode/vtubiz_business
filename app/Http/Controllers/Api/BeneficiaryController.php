<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends Controller
{
    public function index($type)
    {
        try {
            $user = Auth::user();
            $beneficiaries = Beneficiary::where('user_id', $user->id)->latest()->get();

            return response()->json([
                'status' => 'success',
                'data' => $beneficiaries
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function create_beneficiary(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required'
        ]);
        try {
            $user = Auth::user();
            Beneficiary::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'user_id' => $user->id
            ]);

            $beneficiaries = Beneficiary::where('user_id', $user->id)->latest()->get();

            return response()->json([
                'status' => 'success',
                'data' => $beneficiaries
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
