<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\Proposal;
use App\Category;
use App\SubCategory;
use App\Messages;
use App\State;
use App\LocalGovernmentAreas;
class ProposalController extends Controller
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

    public function proposalSubmit(Request $request)
    {
        $request->validate([
            'proposal_title' => 'required|max:255',
            'category' => 'required',
            'subcategory' => 'required',
            'description' => 'required_without:proposal_file',
            'proposal_file' => 'required_without:description|mimes:doc,docx,pdf|max:2048',
            'estimate' => 'required',
            'completion_timeline' => 'required',
            'jobs_created' => 'required',
        ], [
            'description.required_without' => 'Either Description or Proposal File is required.'
        ]);

        $proposal_title = $request->proposal_title;
        $description = $request->input('description');
        $proposal_file = $request->proposal_file;
        $category = $request->category;
        $subcategory = $request->subcategory;
        $is_gov_access = $request->is_gov_access;
        $estimate = $request->estimate;
        $completion_timeline = $request->completion_timeline;
        $jobs_created = $request->jobs_created;
        $is_federal = $request->is_federal ? 1 : 0;
        $is_state = $request->is_state ? 1 : 0;
        $state = $request->state;
        $localGovernment = $request->localGovernment;

        $proposal = new Proposal();
        $proposal->title = $proposal_title;
        $proposal->user_id = \Auth::id();
        $proposal->description = $description;
        $proposal->category_id = $category;
        $proposal->sub_category_id = $subcategory;
        $proposal->is_gov_access = $is_gov_access;
        $proposal->estimate = $estimate;
        $proposal->completion_timeline = $completion_timeline;
        $proposal->jobs_created = $jobs_created;
        $proposal->is_federal = $is_federal;
        $proposal->is_state = $is_state;
        $proposal->state_id = $state;
        $proposal->local_government_area_id = $localGovernment;
        $proposal->note = "We are delighted to let you know that we have received your proposal, and we appreciate your effort. We kindly ask you to bear with us as the administration is just settling down and has yet to name cabinets. We are grateful for your enthusiasm to work with us, though.

Please continue to improve on it.
Thank you!";
        $proposal->save();
       
        if ($request->hasFile('proposal_file')) {
            $file = $request->file('proposal_file');
            $extension = $file->getClientOriginalExtension();
            $filename = 'proposal_' . $proposal->id . '.' . $extension;
            $file->storeAs('public/proposals', $filename);
            $proposal->file_path = $filename;
            $proposal->save();
        }
        
        if ($request->isXmlHttpRequest()) {
            // Return the same request in an AJAX response
            return response()->json([
                'data' => $proposal
            ]);
        }
    }
    
    public function proposalUpdate(Request $request)
    {
        $rules = [
            'proposal_title' => 'required|max:255',
            'category' => 'required',
            'subcategory' => 'required',
            'description' => 'required_without:existing_file',
            'estimate' => 'required',
            'completion_timeline' => 'required',
            'jobs_created' => 'required',
        ];
        
        // Add validation rule for proposal_file only if existing_file is not present
        if (!$request->has('existing_file')) {
            $rules['proposal_file'] = 'required_without:description|mimes:doc,docx,pdf|max:2048';
        }
        
        $request->validate($rules, [
            'description.required_without' => 'Either Description or Proposal File is required.',
        ]);

        $proposal_title = $request->proposal_title;
        $description = $request->input('description');
        $proposal_file = $request->proposal_file;
        $category = $request->category;
        $subcategory = $request->subcategory;
        $is_gov_access = $request->is_gov_access;
        $estimate = $request->estimate;
        $completion_timeline = $request->completion_timeline;
        $jobs_created = $request->jobs_created;
        $is_federal = $request->is_federal ? 1 : 0;
        $is_state = $request->is_state ? 1 : 0;
        $state = $request->state;
        $localGovernment = $request->localGovernment;

        $proposal = Proposal::find($request->prop_id);
        if($proposal){
            $proposal->title = $proposal_title;
            $proposal->user_id = \Auth::id();
            $proposal->description = $description;
            $proposal->category_id = $category;
            $proposal->sub_category_id = $subcategory;
            $proposal->is_gov_access = $is_gov_access;
            $proposal->estimate = $estimate;
            $proposal->completion_timeline = $completion_timeline;
            $proposal->is_federal = $is_federal;
            $proposal->is_state = $is_state;
            $proposal->state_id = $state;
            $proposal->local_government_area_id = $localGovernment;

            if($is_gov_access==1){
                $proposal->is_access_request = 0;
                $proposal->access_request_note = null;
            }
            $proposal->save();
        
            if ($request->hasFile('proposal_file')) {
                $file = $request->file('proposal_file');
                $extension = $file->getClientOriginalExtension();
                $filename = 'proposal_' . $proposal->id . '.' . $extension;
                
                if ($proposal->file_path) {
                    \Storage::delete('public/proposals/' . $proposal->file_path);
                }

                $file->storeAs('public/proposals', $filename);
                $proposal->file_path = $filename;
                $proposal->save();
            }
            
            return redirect()->back()->with('success', 'Proposal updated successfully.');
        }else{
            return redirect()->back()->with('error', 'Proposal Not found.');
        }
    }
    
    

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }


    public function destroy($id)
    {
        $proposal = Proposal::find($id);
        if (!$proposal) {
            return response()->json(['error' => 'Proposal not found.'], 404);
        }
        $proposal->delete();
        return response()->json(['message' => 'Proposal deleted successfully.'], 200);
    }


    public function propChat($id){
        $proposal = Proposal::find($id);
        if($proposal){
            $messages = Messages::where('proposal_id',$id)->orderBy('id')->get();
            return view('user.proposals.chat',compact('proposal','messages'));
        }else{
            return redirect()->back()->with('error', 'Proposal Not found.');
        }
    }


    public function editProposal($id){
        $proposal = Proposal::find($id);
        if($proposal){
            $categories = Category::where('is_active',1)->get();
            $states = State::get();
            return view('user.proposals.edit',compact('proposal','categories','states'));
        }else{
            return redirect()->back()->with('error', 'Proposal Not found.');
        }
    }

    public function view($id){
        $proposal = Proposal::find($id);
        if($proposal){
            if($proposal->file_path){
                $url = '/admin/proposals/preview/'.$proposal->file_path;
                return redirect()->away($url)->withHeaders([
                    'Refresh' => '0;url=' . $url,
                    'Window-target' => '_blank'
                ]);
            }
            return view('user.proposals.preview', compact('proposal'));
        }else{
            return redirect()->back()->with('error', 'Proposal Not found.');
        }
    }

    public function getLocalGovernmentAreas(Request $request)
    {
        $selectedState = $request->input('state');
        
        // Fetch the local governments based on the selected state
        $localGovernments = LocalGovernmentAreas::where('state_id', $selectedState)->get();

        return response()->json($localGovernments);
    }

}
