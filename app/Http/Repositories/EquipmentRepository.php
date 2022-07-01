<?php

namespace App\Http\Repositories;

use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Models\User;

class EquipmentRepository
{
   
    protected $equipment;
    protected $user;

    public function __construct(Equipment $equipment, User $user)
    {
        $this->equipment = $equipment;
        $this->user = $user;
    }

    public function index(){
        return $this->equipment->paginate(10);
    }

    public function getAll() {
        return EquipmentResource::collection($this->equipment->all());
    }

    // search equipment
    public function find($string) {
        // ->join('users','user_id', '=', 'users.id')
        // ->orWhere('users.id','like','%' . $string . '%')
        $equipment = $this->equipment->where('serial_number','like','%' . strtoupper($string) . '%')
                                     ->orWhere('id','like','%' . $string . '%')
                                     ->orWhere('name', 'like', '%' . $string . '%')
                                     ->orWhere('description', 'like', '%' . $string . '%')
                                     ->paginate(10);
        return $equipment;
    }

    //search user 
    public function livesearch($string) {
        $equipment = $this->user->where('name', 'LIKE', '%' . $string . "%")->get();
        return $equipment;
    }


    public function store($data)
    {
        $equipment = new $this->equipment;

        $equipment->name = $data['name'];
        $equipment->status = $data['status'];
        $equipment->description = $data['description'];
        $equipment->user_id = $data['user_id'];
        $equipment->category_id = $data['category_id'];
        
        $equipment->save();
        return $equipment->fresh();
    }

    public function update($id,$data)
    {
        $equipment = $this->equipment->find($id);
        $equipment->name = $data['name'];
        $equipment->status = $data['status'];
        $equipment->description = $data['description'];
        $equipment->user_id = $data['user_id'];
        $equipment->category_id = $data['category_id'];
        
        $equipment->update();
        return $equipment;
    }

 
    public function destroy($id)
    {
        $equipment = $this->equipment->find($id);
        $equipment->delete();
        return $equipment;
    }
}
