<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $rules = array(
           'email' => 'required|email',
            'password' => 'required',
        );
        $this->validate( $request , $rules);

        $fieldData = $request->all();

        if(auth()->attempt(array('email' => $fieldData['email'], 'password' => $fieldData['password']))){
            if(auth()->user()->role_id == 1){
                return redirect()->route('admin.route');
            } elseif(auth()->user()->role_id == 0){
                return redirect()->route('user.route');
            } else {
                return redirect()->route('home');
            }

        }else{
            return redirect()->route('login')->with('error','Your provided information wrong!');
        }

    }
}