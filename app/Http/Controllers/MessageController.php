<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $mess = Message::all();
        return response()->json([
            'status' => 'success',
            'message' => $mess,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'message_type' => 'required|string|max:255',
        ]);

        $mess = Message::create([
            'message' => $request->message,
            'message_type' => $request->message_type,
            'conversation_id' => '1',
            'sender_id' => Auth::id()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Todo created successfully',
            'message' => $mess,
        ]);
    }
}
