<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\Proposal;
use App\Category;
use App\Settings;
use App\State;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user() && (auth()->user()->role_id ==2 || auth()->user()->role_id ==1)) {
                return redirect()->route('admin.proposal.index');
            }
            return $next($request);
        });
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
        $states = State::get();
        return view('user.home', compact('countries','proposals','categories','states'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
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

        if ($request->has('cropped_photo') && $request->cropped_photo) {
            // Get the cropped photo data from the request
            $croppedPhotoData = $request->input('cropped_photo');
    
            // Decode the base64-encoded data URL
            $croppedPhoto = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedPhotoData));
            
            // Retrieve the existing photo path from the user's database record
            $existingPhotoPath = $user->profile_photo;
            
            // Delete the previous photo file if it exists
            if ($existingPhotoPath) {
                Storage::delete('public/profiles/' . basename($existingPhotoPath));
            }
            
            // Generate a unique filename for the photo
            $filename = uniqid().'.jpg';
    
            // Define the storage path for the photo
            $storagePath = 'profiles/' . $filename;
    
            // Save the photo to the storage location
            Storage::disk('public')->put($storagePath, $croppedPhoto);
    
            // Update the user's profile photo
            $user->profile_photo = 'storage/'.$storagePath;
            $user->save();
        }
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
