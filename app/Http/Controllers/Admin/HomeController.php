<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proposal;
use App\User;
use App\Category;

class HomeController extends Controller
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
            if (auth()->user()->role_id ==2) {
                return redirect()->route('admin.proposal.index')->with('error', 'You do not have permission to access this page.');
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
    public function index()
    {
        $proposal_count = Proposal::count();
        $user_count = User::where('role_id',0)->count();
        $gov_count = User::where('role_id',2)->count();
        $cat_count = Category::count();
        $proposals = Proposal::orderBy('no_of_times_viewed','desc')->get();
        return view('admin.home',compact('proposal_count','user_count','gov_count','cat_count','proposals'));
    }
}
