<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Payroll;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'brand_name' => ['unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $uid = Str::uuid();
        if (array_key_exists('company_id', $data)) {
            if(strlen($data['phone']) == 10) {
                $data['phone'] = "0".$data['phone'];
            }     

            $user = User::create([
                'name' => $data['name'],               
                'company_id' => $data['company_id'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'uuid' => $uid,
                'user_type' => 'client_customer',
                'password' => Hash::make($data['password']),
            ]);
        } else {
            $brand_name = str_replace(' ', '-', $data['brand_name']);
            $user = User::create([
                'name' => $data['name'],
                'brand_name' => $brand_name,             
                'email' => $data['email'],
                'phone' => $data['phone'],
                'uuid' => $uid,
                'password' => Hash::make($data['password']),
                'user_type' => 'customer',
            ]);
            $user->company_id = $user->id;
            $user->save();
        }

        event(new Registered($user));
        $user->sendEmailVerificationNotification();
        Auth::login($user);
        return $user;
    }
}
