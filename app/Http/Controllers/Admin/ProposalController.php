<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proposal;
use App\Messages;
use App\Category;
use App\Mail\RequestAccess;
use Illuminate\Support\Facades\Mail;

class ProposalController extends Controller
{

    public function index()
    {
        $proposals = Proposal::with('category','subcategory','user','state','local_government_area')->get();
        $categories = Category::where('is_active',1)->get();
        return view('admin.proposals.index', compact('proposals','categories'));
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


    public function view($id){
        $proposal = Proposal::find($id);
        if($proposal){
            $proposal->no_of_times_viewed = $proposal->no_of_times_viewed + 1;
            $proposal->save();
            $url = '';
            if($proposal->file_path){
                $url = '/admin/proposals/preview/'.$proposal->file_path;
            }

            return view('admin.proposals.preview', compact('proposal','url'));
        }else{
            return redirect()->back()->with('error', 'Proposal Not found.');
        }
    }
    
    public function chat($id)
    {
        $proposal = Proposal::find($id);
        if($proposal){
            $messages = Messages::where('proposal_id',$id)->orderBy('id')->get();
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
                        'avatar' => $message->from->profile_photo ? asset($message->from->profile_photo) : asset('storage/profiles/default_user.jpg')
                    ],
                    'message' => $message->message,
                    'created_at' => $message->created_at->toDateTimeString()
                ];
            }
            
        }
        return response()->json($transformedMessages);
    }


    public function updateRating(Request $request,$id){
        $proposal = Proposal::find($id);
        if($proposal){
            $proposal->rating = $request->rating;
            $proposal->save();
            return response()->json(['message' => 'Rating Updated']);
        }
    }

    public function sendAccessRequest(Request $request){
        $propId = $request->propId;

        $proposal = Proposal::find($propId);
        if($proposal){
            $proposal->access_request_note = $request->request_note;
            $proposal->is_access_request = 1;
            $proposal->save();
            Mail::to($proposal->user->email)->send(new RequestAccess($proposal));
            return redirect()->back()->with('success', 'Request Send to the User.');
        }
    }

    public function search(Request $request)
    {
        $authorLastName = $request->input('author_last_name');
        $authorFirstName = $request->input('author_first_name');
        $email = $request->input('email');
        $category = $request->input('category');
        $dateSubmitted = $request->input('date_submitted');

        $query = Proposal::query();

        if ($authorFirstName || $authorLastName || $email) {
            $query->whereHas('user', function ($subquery) use ($authorFirstName, $authorLastName, $email) {
                if ($authorFirstName) {
                    $subquery->where('name', 'LIKE', "%$authorFirstName%");
                }
                if ($authorLastName) {
                    $subquery->where('last_name', 'LIKE', "%$authorLastName%");
                }
                if ($email) {
                    $subquery->where('email', 'LIKE', "%$email%");
                }
            });
        }
    
        if ($category) {
            $query->where('category_id', $category);
        }
    
        if ($dateSubmitted) {
            $query->whereDate('created_at', $dateSubmitted);
        }

        $proposals = $query->get();

        // Pass the $proposals variable to your view and update the table accordingly
        $categories = Category::where('is_active',1)->get();
        return view('admin.proposals.index', compact('proposals','categories'));
    }
}

?>