<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
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
    use CreateCategory;
    use ApiUser;


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
        // dd($request->all());
      
      
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required'],
            'restaurant_category' => ['required'],
          
            'phone' => ['required'],
            'school' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $random_id = mt_rand(5000, 20000);
        // dd($random_id);
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path() . '/profilePic', $imageName);
            $user = User::create([
                'id' => $random_id,
                'name' => $request->name,
                'slug' => ucwords(str_replace(' ', '-', $request->name)),
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'school' => $request->school,
                'image' => $imageName,
               
                'restaurant_category' => $request->restaurant_category,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([
                'id' => $random_id,
                'name' => $request->name,
                'slug' => ucwords(str_replace(' ', '', $request->name)),
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'school' => $request->school,
               'restaurant_category' => $request->restaurant_category,
                'password' => Hash::make($request->password),
            ]);
        }

        // dd($user);
       
        // event(new Registered($user));
        $email = $request->email;
        $this->create_working_hours($user->id);
        $this->create_category1($user->id, $request->selections);
        $this->create_category($user->id, $request->selections);

      
        Auth::login($user);
        
        
        $data = array('name' => $request->name, 'slug' => ucwords(str_replace(' ', '', $request->name)));
        Mail::send('mail.welcome', $data, function ($message) use ($email) {
            $message->to($email, '')->subject('Welcome to CT_Taste');
            $message->from('support@cttaste.com', 'CT_Taste');
        });
        // register on the app
        $app_response = $this->create_app_user($random_id,$user,$request->password);

        




        return redirect(RouteServiceProvider::HOME);
    }

    public function register_logistic(Request $request)
    {
        // dd($request->all());
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required'],
            'phone' => ['required'],
            'school' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'slug' => ucwords(str_replace(' ', '', $request->name)),
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'school' => $request->school,
            'vendor_id' => $request->vendor_id ?? null,
            'user_type' => 'logistic',
            'password' => Hash::make($request->password),
        ]);
        $email = $request->email;
      
        $data = array('name' => $request->name, 'slug' => ucwords(str_replace(' ', '', $request->name)));
        Auth::login($user);
        // Mail::send('mail.welcome_logistic', $data, function ($message) use ($email) {
        //     $message->to($email, '')->subject('Welcome to CT_Taste');
        //     $message->from('support@cttaste.com', 'CT_Taste');
        // });




        return redirect(RouteServiceProvider::HOME);
    }
    public function registerAppUser(Request $request)
    {
        try {
            // if ($request->bearerToken() == 'eyJhbPciOiJIUzI7NiIsInT5cCI6IkpXVCJ4') {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'address' => ['required'],
                'phone' => ['required'],
                'school' => ['required'],
                'password' => ['required'],
                'category_id' => ['required'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid input data',
                    'errors' => $validator->errors(),
                ], 400);
            }

            $user = User::create([
                'id' => $request->id,
                'name' => $request->name,
                'slug' => ucwords(str_replace(' ', '', $request->name)),
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'school' => $request->school,
                'restaurant_category' => $request->category_id ?? null,
                'password' => Hash::make($request->password),
            ]);
            $email = $request->email;

            $this->create_working_hours($user->id);
            $data = array('name' => $request->name, 'slug' => ucwords(str_replace(' ', '', $request->name)));
            Mail::send('mail.welcome', $data, function ($message) use ($email) {
                $message->to($email, '')->subject('Welcome to CT_Taste');
                $message->from('support@cttaste.com', 'CT_Taste');
            });

            return response()->json([
                'status' => true,
                'message' => 'User Saved Successfully',
                'data' => $user
            ], 200);
            // } else {
            //     return response()->json([
            //         'status' => true,
            //         'message' => 'Invalid Token, Unauthenticated',
            //     ], 401);
            // }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
