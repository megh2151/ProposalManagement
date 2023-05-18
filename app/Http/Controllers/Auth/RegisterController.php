<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //

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


    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'location' => 'required',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'location' => $request['location'] ?? 'India', // provide a default value of '' if $request['location'] is null
            'phone' => $request['phone'],
            'country_code' => $request['country_code'] ?? "+91",
            'role_id' => $request['role_id'],
            'activation_token' => Str::random(60),
            'is_active'=>'0'
        ]);
       
        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('login')->with('success', 'Registration successful! Please check your email for verification.');
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
