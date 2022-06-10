<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_contact;
use Illuminate\Http\Request;
use App\Http\Resources\UserContactResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Ramsey\Collection\CollectionInterface;
use Symfony\Component\HttpFoundation\Response;

class UserContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new UserContactResource(User_contact::find(1));
        $id = Auth::id();
        $contact = User_contact::where('user_id',$id)->get();
        return UserContactResource::collection($contact);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $user_contact = User_contact::create([
            'user_id' => Auth::user()->id,
            'contact_id' =>  $request->contact_id,
            'custom_name' =>  $request->custom_name
        ]);

        return response()->json([
            'status' => 'success',
            'user_contact' => $user_contact,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
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
        $contact = User_contact::where('contact_id', $id)->first();
        $contact->custom_name =$request->custom_name;
        $contact->save();
        if (!$contact->custom_name) 
            return new \Exception('message',Response::HTTP_BAD_REQUEST);
        return response()->json([
            'status'   => 'success',
            'contact'  =>  $contact,
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
        $contact = User_contact::where('contact_id', $id)->first();
        $contact->delete();

        return response()->json([
            'status'   => 'success',
            'contact'  =>  $contact,
        ]);

    }   
}
