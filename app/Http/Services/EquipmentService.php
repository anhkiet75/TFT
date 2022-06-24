<?php

namespace App\Http\Services;

use App\Http\Repositories\EquipmentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class EquipmentService
{
 
    protected $equipmentRepository;

  
    public function __construct(EquipmentRepository $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }


    public function index()
    {
        return $this->equipmentRepository->index();
    }

    public function getAllEquipment()
    {
        return $this->equipmentRepository->getAll();
    }


    public function search($string)
    {
        if ($string == "") return $this->equipmentRepository->getAll(); // If string is empty return all equipment
        return $this->equipmentRepository->find($string);
    }

    public function livesearch($string) {
        $equipment = $this->equipmentRepository->livesearch($string);
        return $equipment;
    }

   
    public function updateEquipment($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'status' => 'required|max:255',
            'description'  => 'required|max:255',
            'user_id' => 'nullable',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $equipment = $this->equipmentRepository->update($id, $data);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update equipment');
        }
        DB::commit();

        return $equipment;
    }

  
    public function saveEquipment($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'status' => 'required|max:255',
            'description'  => 'required|max:255',
            'user_id' => 'nullable',
            'category_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $equipment = $this->equipmentRepository->store($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to save equipment');
        }
        DB::commit();

        return $equipment;
    }

    public function destroyEquipment($id)
    {
        DB::beginTransaction();
        try {
            $equipment = $this->equipmentRepository->destroy($id);
        }
        catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete data');
        }

        DB::commit();
        return $equipment;
    }
}