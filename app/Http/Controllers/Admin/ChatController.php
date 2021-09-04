<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewMessageAdded;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request){

        $message = Message::create([
            'user_id' => Auth::user()->id,
            'content' => $request->message
        ]);
        return redirect()->back();
//        if (! $request->filled('message')) {
//            return response()->json([
//                'message' => 'No message to send'
//            ], 422);
//        }
//
//        event(new ($request->message, $request->user));
//
//        return response()->json([], 200);
//
//
//        $message = $request->input('message', '');
//        if (strlen($message)) {
//            event(new NewMessageAdded($message));
//        }


    }

    public function index(){
        return view('test');
    }
}
