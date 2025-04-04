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
            $beneficiaries = Beneficiary::where('user_id', $user->id)->where('type', $type)->latest()->get();

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
                'type' => $request->type ?? 'data',
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

    public function removeBeneficiary(Request $request)
    {
        // dd($request->all());
        try {
            $user = Auth::user();
            $this->validate($request, [
                'phone' => 'required',
            ]);
            Beneficiary::where('phone', $request->phone)->where('user_id', $user->id)->delete();

            $response = [
                'success' => true,
                'message' => 'Beneficiary Removed Successfully',
            ];
            return response()->json([
                'success' => true,
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json([
                'success' => false,
                'status' => 'false',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
