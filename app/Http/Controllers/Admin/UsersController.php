<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::where('role_id',2)->get();
        return view('admin.users.index', compact('users'));
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
            'email' => 'required | email',
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
}
