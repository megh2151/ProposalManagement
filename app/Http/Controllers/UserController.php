<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\Proposal;
use App\Category;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $countries = Country::get();
        $proposals = Proposal::where('user_id',\Auth::id())->get();
        $categories = Category::where('is_active',1)->get();
        
        return view('user.home', compact('countries','proposals','categories'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'location' => 'required',
        ]);


        $first_name = $request->first_name;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $location = $request->location;
        $phone = $request->phone;
        $country_code = $request->country_code;
        $password = $request->password;

        $user = \Auth::user();
        $user->name = $first_name;
        $user->middle_name = $middle_name;
        $user->last_name = $last_name;
        $user->location = $location;
        $user->phone = $phone;
        if($password){
            $user->password = Hash::make($password);
        }
        $user->country_code = $country_code;
        $user->save();

        return redirect()->back()->with('success', 'Profile successfully.');
    }
    

}
