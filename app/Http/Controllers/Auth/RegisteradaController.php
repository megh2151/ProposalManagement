<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $countries = Country::get();
        return view('auth.register', compact('countries'));
    }

    public function getPhoneCode($id)
    {
        $country = Country::where('id', $id)->first();
        return response()->json(['phone_code' => $country->phonecode]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(array $data)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:6', 'confirmed'],
        //     'middle_name' => 'nullable|string|max:255',
        //     'last_name' => 'nullable|string|max:255',
        //     'phone' => 'required|string|max:255',
        // ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'location' => $data['location'] ?? 'India', // provide a default value of '' if $data['location'] is null
            'phone' => $data['phone'],
            'country_code' => $data['country_code'] ?? "+91",
            'role_id' => $data['role_id'],
            'activation_token' => Str::random(60),
            'is_active'=>'0'
        ]);
       
        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('login')->with('success', 'Registration successful! Please login to continue.');

    }

    public function activateUser($token){
        $user = User::where('activation_token',$token)->first();
        
        if($user){
            $user->is_active = 1;
            $user->save();
            auth()->login($user); // log in the user
            return redirect('/user/dashboard')->with('success','Your account now activated!!');
        }else{
            
             return redirect('/')->with('error','User Not found!');
        }
    }
    
}
