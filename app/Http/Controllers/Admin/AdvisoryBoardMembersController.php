<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
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
            return response()->json(['message' => 'Status updated sucessfully.']);
        }
        return response()->json(['message' => 'Member not found.']);
    }
}
