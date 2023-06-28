<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Mail\AdvisoryAccountActivation;
use Illuminate\Support\Facades\Mail;
class AdvisoryBoardMembersController extends Controller
{
    //
    public function index()
    {
        $members = User::where('role_id',3)->get();
        return view('admin.boardmember.index', compact('members'));
    }

    public function updateUser(Request $request)
    {
        // Retrieve the value from the request
        $is_active = $request->input('is_active')=='true' ? 1 : 0;
        $member = User::where('role_id',3)->find($request->user_id);
        if($member){
            $member->is_active = $is_active;
            $member->save();
            $message = $is_active ? 'User activated successfully.' : 'User deactivated successfully.';
            if(!$member->is_adv_activation_mail_send && $is_active){
                Mail::to($member->email)->send(new AdvisoryAccountActivation($member));
                $member->is_adv_activation_mail_send = 1;
                $member->save();
            }
            return response()->json(['message' => $message]);
        }
        return response()->json(['message' => 'Member not found.']);
    }
}
