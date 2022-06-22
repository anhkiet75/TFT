<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService
{ 
    protected $userRepository;
  
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->index();
    }

    public function getAllUser()
    {
        return $this->userRepository->getAll();
    }
   
    public function updateUser($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'gender' => 'required|boolean',
            'email'  => 'required|email',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $user = $this->userRepository->update($id, $data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update user');
        }
        DB::commit();

        return $user;
    }

  
    // public function saveUser($data)
    // {
    //     $validator = Validator::make($data, [
    //         'name' => 'required|max:255',
    //         'status' => 'required|max:255',
    //         'description'  => 'required|max:255',
    //         'user_id' => 'nullable',
    //         'category_id' => 'required'
    //     ]);
        
    //     if ($validator->fails()) {
    //         throw new InvalidArgumentException($validator->errors()->first());
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $user = $this->userRepository->store($data);
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::info($e->getMessage());
    //         throw new InvalidArgumentException('Unable to save user');
    //     }
    //     DB::commit();

    //     return $user;
    // }

    public function destroyUser($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->destroy($id);
        }
        catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete data');
        }

        DB::commit();
        return $user;
    }

}