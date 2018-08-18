<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MessagesController extends Controller
{

    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            if( isset($user) ) {
                $messages = $user->feed_messages()->orderBy('created_at', 'desc')->paginate(5);
    
                $data = [
                    'user' => $user,
                    'messages' => $messages,
                ];
            }
        }
        //return $data;
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->messages()->create([
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $message = \App\Message::find($id);
        
        if( isset($message) ) {
            if (\Auth::id() === $message->user_id) {
                $message->delete();
            }
        }
        
        return redirect()->back();
    }
    
}
