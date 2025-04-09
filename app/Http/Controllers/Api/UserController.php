<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
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

    public function referral_details()
    {
        $data['user'] = $user = Auth::user();
        $data['referrals'] = User::where('referred_by', $user->brand_name)->latest()->get();
        $data['earnings'] = User::where('referred_by', $user->brand_name)->sum('earnings');

        return response()->json($data);
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

    public function updateprofile(Request $request)
    {
        try {
            $user = Auth::user();

            $brand_name = str_replace(' ', '-', $request->brand_name);
            $user->name = $request->name;
            $user->phone = $request->phone;
            // $user->brand_name = $brand_name;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile'
            ], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();

            if ($request->new_password == $request->confirm_password && Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Password updated successfully'
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Incorrect password or passwords do not match'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update password'
            ], 500);
        }
    }

    public function updatePin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_pin' => 'required|integer',
                'new_pin' => 'required|integer',
                'confirm_pin' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();

            if ($request->new_pin == $request->confirm_pin && hash('sha256', $request->current_pin) === $user->pin) {
                $user->pin = hash('sha256', $request->new_pin);
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'PIN updated successfully'
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Incorrect PIN or PINs do not match'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update PIN'
            ], 500);
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate password to confirm deletion
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid password. Account deletion cancelled.'
                ], 401);
            }

            // Check for pending transactions or balance
            if ($user->balance > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete account with existing balance. Please spend your funds first.'
                ], 400);
            }

            // Perform the deletion
            // $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Account deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete account'
            ], 500);
        }
    }

    public function generateVirtualAccount(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'amount' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();
            $str_name = explode(" ", $user->name);
            $first_name = $str_name[0];
            $last_name = end($str_name);
            $trx_ref = Str::random(7);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('FLW_SECRET_KEY')
            ])->post('https://api.flutterwave.com/v3/virtual-account-numbers/', [
                'email' => $user->email,
                'is_permanent' => false,
                'tx_ref' => $trx_ref,
                'phonenumber' => $user->phone,
                'amount' => $request->amount,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'narration' => 'VTUBIZ/' . $first_name . '-' . $last_name,
            ]);

            $responseData = $response->json();

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Virtual account generated successfully',
                    'data' => [
                        'account_number' => $responseData['data']['account_number'],
                        'bank_name' => $responseData['data']['bank_name'],
                        'amount' => $responseData['data']['amount'],
                        'expiry_date' => $responseData['data']['expiry_date']
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate virtual account',
                'errors' => $responseData['message'] ?? 'Unknown error occurred'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while generating virtual account'
            ], 500);
        }
    }

    public function oldgeneratePermanentAccount(Request $request)
    {
        // dd($request->all(),env('FLW_SECRET_KEY'));
        $user = Auth::user();
        $str_name = explode(" ", $user->name);
        $first_name = $str_name[0];
        $last_name = end($str_name);
        $trx_ref = Str::random(7);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('FLW_SECRET_KEY'), // Replace with your actual secret key
        ])
            ->post('https://api.flutterwave.com/v3/virtual-account-numbers/', [
                'email' => $user->email,
                'is_permanent' => true,
                'bvn' => $request->bvn,
                'tx_ref' => $trx_ref,
                'phonenumber' => $user->phone,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'narration' => 'VTUBIZ/' . $first_name . '-' . $last_name,
            ]);

        $responseData = $response->json(); // Converts JSON response to an array
        $user->bank_name = $responseData['data']['bank_name'];
        $user->account_no = $responseData['data']['account_number'];
        $user->account_name = 'VTUBIZ/' . $first_name . '-' . $last_name;
        $user->save();
        return redirect('/fundwallet')->with('message', 'Permanent Account Created Successfully!');
    }

    public function generatePermanentAccount(Request $request)
    {
        return $request->all();
        try {
            $user = Auth::user();
            $str_name = explode(" ", $user->name);
            $first_name = $str_name[0];
            $last_name = end($str_name);
            $trx_ref = Str::random(7);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('FLW_SECRET_KEY'),
            ])->post('https://api.flutterwave.com/v3/virtual-account-numbers/', [
                'email' => $user->email,
                'is_permanent' => true,
                'bvn' => $request->bvn,
                'tx_ref' => $trx_ref,
                'phonenumber' => $user->phone,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'narration' => 'VTUBIZ/' . $first_name . '-' . $last_name,
            ]);

            $responseData = $response->json();
            
            if ($response->successful()) {
                $user->bank_name = $responseData['data']['bank_name'];
                $user->account_no = $responseData['data']['account_number'];
                $user->account_name = 'VTUBIZ/' . $first_name . '-' . $last_name;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Virtual account generated successfully',
                    'data' => [
                        'bank_name' => $user->bank_name,
                        'account_no' => $user->account_no,
                        'account_name' => $user->account_name
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate virtual account',
                'errors' => $responseData['message'] ?? 'Unknown error occurred'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while generating virtual account'
            ], 500);
        }
    }
}
