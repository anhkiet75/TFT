<?php

namespace App\Http\Repositories;

use App\Models\Equipment;


class EquipmentRepository
{
   
    protected $equipment;

    public function __construct(Equipment $equipment)
    {
        $this->equipment = $equipment;
    }

    public function index(){
      
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