<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proposal;
use App\User;
use App\Category;
use App\Settings;


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
            if (auth()->user() && auth()->user()->role_id ==2) {
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
        $approved_proposal_count = Proposal::where('status','approved')->count();
        $pending_proposal_count = Proposal::where('status','pending')->count();
        $cancel_proposal_count = Proposal::where('status','cancel')->count();

        // Fetch pending and approved proposals grouped by date
        $pendingProposals = Proposal::where('status', 'pending')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        $approvedProposals = Proposal::where('status', 'approved')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        // Format the data for the chart
        $activityData = [
            'pending' => [],
            'approved' => [],
            'labels' => []
        ];

        // Merge the pending and approved proposals data into a single dataset
        foreach ($pendingProposals as $pending) {
            $activityData['pending'][] = $pending->count;
            $activityData['labels'][] = $pending->date;
        }

        foreach ($approvedProposals as $approved) {
            $activityData['approved'][] = $approved->count;
            if (!in_array($approved->date, $activityData['labels'])) {
                $activityData['labels'][] = $approved->date;
            }
        }
        

        // Sort the labels array in ascending order
        sort($activityData['labels']);

        $show_activity_summary = Settings::where('show_activity_summary',1)->value('show_activity_summary');
        return view('admin.home',compact('proposal_count','user_count','gov_count','cat_count','proposals','approved_proposal_count','pending_proposal_count','activityData','cancel_proposal_count','show_activity_summary'));
    }
}
