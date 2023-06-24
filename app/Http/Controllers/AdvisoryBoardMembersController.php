<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdvisoryBoardMembersController extends Controller
{
    //
    public function index()
    {
        $members = User::where('role_id',3)->where('is_active',1)->get();
        return view('boardmember.index', compact('members'));
    }

    public function advisoryBoardApplication()
    {
        return view('boardmember.application');
    }

    public function joinBoardForm()
    {
        $countries = Country::get();
        return view('boardmember.register', compact('countries'));
    }
    
    public function joinBoardFormSubmit(Request $request)
    {
         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'location' => 'required',
            'video' => 'nullable|mimetypes:video/mp4,video/mpeg,video/quicktime|max:60000', // Maximum size: 60MB
            'biography' => 'nullable|string|min:100',
        ]);

        $user = User::create([
            'designation' => $request['designation'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'location' => $request['location'] ?? 'India', // provide a default value of '' if $request['location'] is null
            'phone' => $request['phone'],
            'country_code' => $request['country_code'] ?? "+91",
            'role_id' => $request['role_id'],
            'biography' => $request['biography'],
            'activation_token' => Str::random(60),
            'is_active'=>'0'
        ]);

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
       if ($request->hasFile('video')) {
            $video = $request->file('video');
            // Generate a unique filename for the video
            $filename = uniqid() . '.' . $video->getClientOriginalExtension();

            // Define the storage path for the video
            $storagePath = 'videos/' . $filename;

            // Save the video to the storage location
            Storage::disk('public')->put($storagePath, file_get_contents($video));

            // Update the user record in the database with the video file path
            $user->video = 'storage/'.$storagePath;
            $user->save();
        }

        // Handle if no video file is provided
        return redirect()->back()->with('success', 'Registered successfully!');
    }

}
