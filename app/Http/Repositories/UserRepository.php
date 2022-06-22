<?php

namespace App\Http\Repositories;

use App\Http\Resources\UserResource;
use App\Models\User;


class UserRepository
{
   
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index() {
        return $this->user->paginate(10);
    }

    public function getAll() {
        return UserResource::collection($this->user->all());
    }



    // public function store($data)
    // {
    //     $user = new $this->user;

    //     $user->name = $data['name'];
    //     $user->gender = $data['gender'];
    //     $user->birthdate = $data['birthdate'];
    //     $user->email = $data['email'];

    //     $user->save();
    //     return $user->fresh();
    // }

    public function update($id,$data)
    {
        $user = $this->user->find($id);
        
        $user->name = $data['name'];
        $user->gender = $data['gender'];
        // $user->birthdate = $data['birthdate'];
        $user->email = $data['email'];
        
        $user->update();
        return $user;
    }

 
    public function destroy($id)
    {
        $user = $this->user->find($id);
        $user->delete();
        return $user;
    }
}
