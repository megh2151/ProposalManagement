<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Mail\GovWelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class UsersController extends Controller
{

     //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            
            if (auth()->user() && auth()->user()->role_id ==2 && auth()->user()->role_id ==3 && $request->route()->getName()!='admin.profile' && $request->route()->getName()!='admin.profile.update') {
                return redirect()->route('admin.proposal.index')->with('error', 'You do not have permission to access this page.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::where('role_id',2)->get();
        return view('admin.users.index', compact('users'));
    }

    public function propUserindex()
    {
        $users = User::where('role_id',0)->get();
        return view('admin.proposals.users.index', compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('admin.users.edit', compact('user'));
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required | email|unique:users',
        ]);

        $name = $request->name;
        $email = $request->email;
        $status = $request->status;
        $password = \Str::random(8);
        $hash_password = Hash::make($password);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->is_active = $status;
        $user->role_id = 2;
        $user->password = $hash_password;
        $user->save();

        $user->password = $password;
        Mail::to($user->email)->send(new GovWelcomeMail($user));

        return redirect()->back()->with('success', 'User added successfully.');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $status = $request->status;
        $user = User::find($id);
        if ($user) {
            $user->name = $name;
            $user->is_active = $status;
            $user->save();
            return redirect()->back()->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }


    public function delete(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    public function propUserChat($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('admin.proposals.users.chat', compact('user'));
        }
    }

    public function profile(Request $request)
    {
        $user = \Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {   
        $user = auth()->user(); // Replace this with your own logic to retrieve the user
        
        if($request->change_password){
            // Server-side form validation
            $request->validate([
                'old_password' => ['required', 'string'],
                'new_password' => ['required', 'string', 'min:6', 'different:old_password'],
                'confirm_password' => ['required', 'string', 'min:6', 'same:new_password'],
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
        
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
        ]);

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->save();

        if ($request->has('cropped_photo')) {
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

        return redirect()->back()->with('success', 'Profile updated successfully.');
        
    }

    public function sendActivation(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            Mail::to($user->email)->send(new WelcomeMail($user));
            return redirect()->back()->with('success', 'Sent activation link.');
        }

        return redirect()->back()->with('error', 'User Not found.');
    }


}
