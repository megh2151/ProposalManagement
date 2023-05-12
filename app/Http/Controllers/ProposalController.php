<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\Proposal;
use App\SubCategory;

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
            'proposal_file' => 'required_without:description|mimes:doc,docx,pdf|max:2048'
        ], [
            'description.required_without' => 'Either Description or Proposal File is required.'
        ]);

        $proposal_title = $request->proposal_title;
        $description = $request->input('description');
        $proposal_file = $request->proposal_file;
        $category = $request->category;
        $subcategory = $request->subcategory;

        $proposal = new Proposal();
        $proposal->title = $proposal_title;
        $proposal->user_id = \Auth::id();
        $proposal->description = $description;
        $proposal->category_id = $category;
        $proposal->sub_category_id = $subcategory;
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

}
