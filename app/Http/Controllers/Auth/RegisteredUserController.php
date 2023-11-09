<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Traits\ApiUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Traits\CreateCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;


class RegisteredUserController extends Controller
{
  


    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $uid = Str::uuid();
        // dd($request->all()); $uid = Str::uuid();
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
