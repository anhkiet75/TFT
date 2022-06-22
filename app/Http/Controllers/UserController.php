<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function index()
    {
        try {
            $result = $this->userService->index();  
            return view('user',[ 'data' => $result ]);
        } catch (Exception $e) {
            return redirect('/user')->with('failed',  $e->getMessage());
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
    // public function show($id)
    // {
    //     try {
    //         $user = User::find($id);
    //         if ($user) 
    //             return new UserResource($user);
    //         return response()->json(["Error" => "Not found"],400);
    //     }
    //     catch (Exception $e) {
    //          return response()->json(["Error" => $e->getMessage()],400);
    //    }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $result['status'] = 'success';
        $result['message'] = 'Updated User';
        $data = $request->only(
            ['name', 'email', 'gender', 'birthdate']
        );  
        try {
            $this->userService->updateUser($id,$data);
        }
        catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
            ];
        }
        return redirect('/user')
            ->with($result['status'],$result['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result['status'] = 'success';
        $result['message'] = 'Deleted User';
        try {
            $this->userService->destroyUser($id);
        } catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage()
            ];
        }

        return redirect('/user')
            ->with($result['status'],$result['message']);
    }
}
