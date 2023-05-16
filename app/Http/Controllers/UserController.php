<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\Proposal;
use App\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id, 'id'),
            ],
            'location' => 'required',
        ]);
    


        $first_name = $request->first_name;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $location = $request->location;
        $phone = $request->phone;
        $country_code = $request->country_code;

        $user = \Auth::user();
        $user->name = $first_name;
        $user->middle_name = $middle_name;
        $user->last_name = $last_name;
        $user->location = $location;
        $user->phone = $phone;
        $user->country_code = $country_code;
        $user->save();

        return redirect()->back()->with('success', 'Profile successfully.');
    }


    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Server-side form validation
        $request->validate([
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'different:old_password'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        // Verify the old password
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Incorrect old password.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
    

}
