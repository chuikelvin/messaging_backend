<?php

namespace App\Http\Controllers;

use App\Models\CustomerMessage;
use App\Models\ResponseChat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    //
    public function getCustomers()
    {
        $userIds = CustomerMessage::distinct('customer_id')->pluck('customer_id')->toArray();

        return response()->json(['status' => 200, 'message' => $userIds]);
    }
    public function getMessages($customer_id)
    {

        $messages = CustomerMessage::where('customer_id', $customer_id)
            // ->orderBy('timestamp_utc', 'desc')
            ->get()->toArray();

        $responses = ResponseChat::where('customer_id', $customer_id)
            // ->orderBy('timestamp_utc', 'desc')
            ->get()->toArray();



        if ($messages) {
            return response()->json(['status' => 200, 'message' => $messages, 'responses' => $responses])->header('X-CSRF-TOKEN', csrf_token());
        }
    }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required', // Assuming users table for user_id
            'message' => 'required',
            'responder_id' => 'required',
        ]);
        // return response()->json(['status' => 200, 'message' => $data]);
        $data['timestamp_utc'] =  Carbon::now('UTC');

        $responseChat = ResponseChat::create($data);

        if ($responseChat) {
            return response()->json(['status' => 200, 'message' => 'message sent successfuly']);
            // return $message->message_body;
        }

    }
}
