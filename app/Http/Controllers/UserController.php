<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class userController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = User::all();
            // if ($user) 
            return UserResource::collection($user);
            // return response()->json(["Error" => "Empty"],400);
        }
        catch (Exception $e) {
            return response()->json(["Error" => $e->getMessage()],400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|max:255',
        // ]);
        
        // $input = $request->only('name');

        // try {
        //     $user = User::create($input);
        //     return new UserResource($user);
        // }
        // catch (Exception $e) {
        //     return response()->json(["Error" => $e->getMessage()],400);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::find($id);
            if ($user) 
                return new UserResource($user);
            return response()->json(["Error" => "Not found"],400);
        }
        catch (Exception $e) {
             return response()->json(["Error" => $e->getMessage()],400);
       }
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
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $input = $request->only('name','email','gender','birthdate');

        try {
            $user = User::find($id);
            if ($user) {
                $user->update($input);
                return new UserResource($user);
            }
            return response()->json(["Error" => "Not found"],400);
        }
        catch (Exception $e) {
             return response()->json(["Error" => $e->getMessage()],400);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return response()->json(["Successfully" => "Deleted "],200);
            }
            return response()->json(["Error" => "Empty"],400);
        }
        catch (Exception $e) {
             return response()->json(["Error" => $e->getMessage()],400);
       }
    }
}
