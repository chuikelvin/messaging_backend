<?php

namespace App\Http\Controllers;

use App\Models\CustomerMessage;
use App\Models\ResponseChat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function getCustomers(){
        $userIds = CustomerMessage::distinct('customer_id')->pluck('customer_id')->toArray();

        return response()->json(['status' => 200, 'message' => $userIds]);
    }
    public function getMessages($customer_id){

        $messages = CustomerMessage::where('customer_id', $customer_id)
            ->orderBy('timestamp_utc', 'desc')
            ->get();

        if ($messages) {
            return response()->json(['status' => 200, 'message' => $messages]);
            // return $message->message_body;
        }
        $messages =CustomerMessage::all();
        // dd($messages);

        // return $messages;
    }

    public function sendMessage(Request $request,$customer_id){

        $request->validate([
            'customer_id' => 'required', // Assuming users table for user_id
            'message' => 'required|string',
        ]);

        $responseChat = ResponseChat::create([$request]);

        if ($responseChat) {
            return response()->json(['status' => 200, 'message' => 'message sent successfuly']);
            // return $message->message_body;
        }

    }
}
