<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\User;
class EmailController extends Controller
{
    //
    public function showForm()
    {
         $users = User::where('role_id','!=',1)->where('is_active',1)->get();
        return view('admin.email.index',compact('users'));
    }

    public function sendEmail(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'users' => 'nullable|array',
            'users.*' => 'exists:users,email',
            'prop-users' => 'required_without_all:users,gov-users|in:on',
            'gov-users' => 'required_without_all:users,prop-users|in:on',
            'subject' => 'required',
            'content' => 'required',
        ]);

        $propUsers = User::where('role_id', 0)->where('is_active',1)->get();
        $govUsers = User::where('role_id', 2)->where('is_active',1)->get();

        if ($request->has('prop-users') && $request->has('gov-users')) {
            $users = $propUsers->merge($govUsers);
        } elseif ($request->has('prop-users')) {
            $users = $propUsers;
        } elseif ($request->has('gov-users')) {
            $users = $govUsers;
        } else {
            $users = User::whereIn('email', $validatedData['users'])->get();
        }

        $subject = $validatedData['subject'];
        $content = $validatedData['content'];

        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendEmail($subject, $content));
        }

        return redirect()->back()->with('success', 'Email sent successfully.');
    }

        public function autocomplete(Request $request)
    {
        $term = $request->input('search');
        $users = User::where('email', 'LIKE', '%' . $term . '%')->pluck('email');
        
        return response()->json($users);
    }
}
