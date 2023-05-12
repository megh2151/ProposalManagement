<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proposal;
use App\Messages;


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
    
    public function chat($id)
    {
        $proposal = Proposal::find($id);
        if($proposal){
            $messages = Messages::where('proposal_id',$id)->get();
            return view('admin.proposals.chat',compact('proposal','messages'));
        }else{
            return redirect()->back()->with('error', 'Proposal Not found.');
        }
    }


    public function sendMessage(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'from_id' => 'required|integer',
            'to_id' => 'required|integer',
            'proposal_id' => 'required|integer',
            'message' => 'required|string|max:255'
        ]);
        
        // Create a new message with the validated data
        $message = new Messages($validatedData);
        
        // Save the message to the database
        $message->save();
        
        // Return a JSON response with a success message
        return response()->json(['message' => 'Message sent successfully','id'=>$message->id]);
    }

    public function getNewMessages(Request $request)
    {
        $lastMessageId = $request->input('last_message_id');
        $toId = auth()->user()->id;
         // Transform the new messages into a format that can be sent to the client
         $transformedMessages = [];
        if($lastMessageId)
        {
            // Fetch new messages from the database
            $newMessages = Messages::where('to_id', $toId)
                                ->where('id', '>', $lastMessageId)
                                ->get();
            
           
            foreach ($newMessages as $message) {
                $transformedMessages[] = [
                    'id' => $message->id,
                    'from' => [
                        'id' => $message->from_id,
                        'name' => $message->from->name,
                        'avatar' => asset('admin/assets/img/user/u2.jpg')
                    ],
                    'message' => $message->message,
                    'created_at' => $message->created_at->toDateTimeString()
                ];
            }
            
        }
        return response()->json($transformedMessages);
    }

}

?>