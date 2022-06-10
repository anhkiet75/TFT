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

    public function index(Request $request)
    {
        // $mess = Message::all();
        $mess = Message::where('conversation_id',$request->conversation_id)
                        ->orderBy('created_at', 'DESC')
                        ->get();
        return response()->json([
            'status' => 'success',
            'message' => $mess,
        ]);
    }

    public function create()
    {
        
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
            'conversation_id' => $request->conversation_id,
            'sender_id' => Auth::id()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Message created successfully',
            'message' => $mess,
        ]);
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mess = Message::find($id);
        $mess->update([
            'message' => $request->message,
            'message_type' => $request->message_type
        ]);
        return response()->json([
            'status'   => 'update success',
            'contact'  =>  $mess,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mess = Message::find($id);
        $mess->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted message',
            'message' => $mess,
        ]); 
    }
    
}
