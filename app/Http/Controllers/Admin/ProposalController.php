<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proposal;

class ProposalController extends Controller
{

    public function index()
    {
        $proposals = Proposal::get();
        return view('admin.proposals.index', compact('proposals'));
    }

    public function update(Request $request)
    {
        $proposal = Proposal::find($request->proposalId);
       
        if($proposal){
            if(isset($request->status))
                $proposal->status = $request->status;
            if(isset($request->note))
                $proposal->note = $request->note;
            if(isset($request->is_followup))
                $proposal->is_followup = $request->is_followup;
                
            $proposal->save();
            if ($request->isXmlHttpRequest()) {
                // Return the same request in an AJAX response
                return response()->json([
                    'data' => $request->all()
                ]);
            }else{
                return redirect()->back()->with('success', 'Content updated');
            }
        }else{
            return redirect()->back()->with('error', 'Proposal Not found.');
        }
    }
    

}

?>