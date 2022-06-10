<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function react(Request $request)
    {
        $react = Reaction::create([
            'user_id' => $request->user_id,
            'message_id'=> $request->message_id,
            'type' => $request->type
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $react,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unreact(Request $request)
    {
        $react = Reaction::where('user_id',$request->user_id)
                            ->where('message_id',$request->message_id)->first();
        $react->delete();
        return response()->json([
            'status' => 'success',
            'message' => $react,
        ]);
    }

}
