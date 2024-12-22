<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {


        // dd($request->all());
        try {


            // Validate the request

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if ($validator->fails()) {

                return response()->json(['message' => $validator->errors()], 400);
            }


            $data = $request->all();
            $uid = Str::uuid();
            // dd($request->all()); $uid = Str::uuid();

            $user = User::create([
                'name' => $data['name'],
                'referred_by' => $data['referred_by'] ?? "VTUBIZ",
                'email' => $data['email'],
                'phone' => $data['phone'],
                'uuid' => $uid,
                'password' => Hash::make($data['password']),
                'user_type' => 'customer',
            ]);
            $pelumi = User::where('email', 'fasanyafemi@gmail.com')->first();
            $user->company_id = $pelumi->id;
            $user->save();

            // Return the response
            try {
                $email = $user->email;
                $data = array('name' => $user->first_name, 'uuid' => $user->uuid, 'email' => $email);
                Mail::send('mail.welcome', $data, function ($message) use ($email) {
                    // $message->to($email)->subject('Welcome to VTUBIZ');
                    $message->to('fasanyafemi@gmail.com')->subject('Welcome to VTUBIZ');
                    $message->from('support@vtubiz.com', 'VTUBIZ');
                });
                $data['message'] = 'Welcome Mail Sent Successfully!';
            } catch (\Exception $e) {
                $data['message'] = $e->getMessage();
            }

            $transactions = Transaction::where('user_id', $user->id)->latest()->take(10)->get();

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'mail_status' => $data['message'],
                'data' => $user,
                'transactions' => $transactions,
                'token' =>  $user->createToken('AuthToken')->plainTextToken, // Generate authentication token
            ], 201);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Check the user's credentials
            $user = User::where('email', $request->email)->first();


            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Generate authentication token
            $token = $user->createToken('AuthToken')->plainTextToken;

            $transactions = Transaction::where('user_id', $user->id)->latest()->take(10)->get();
            // Return the response
            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'data' => $user,
                'transactions' => $transactions,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return response()->json([
                'message' => 'Failed to log in user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function setpin(Request $request)
    {
        try {


            $user = Auth::user();
            $this->validate($request, [

                'pin' => 'required'
            ]);

            $hashed_pin = hash('sha256', $request->pin);
            $user->pin = $hashed_pin;
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'Pin set successfully!',
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to set pin',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {

        Auth::guard('web')->logout();

        return response()->json([
            "data" => "User logged out successfully!",
            "status" => true
        ]);
    }
}
