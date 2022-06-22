<?php

namespace App\Http\Services;

use App\Http\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CategoryService
{
 
    protected $categoryRepository;

  
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function index()
    {
        return $this->categoryRepository->index();
    }

   
    public function updateCategory($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $category = $this->categoryRepository->update($id, $data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update ca data');
        }
        DB::commit();
        return $category;
    }

  
    public function saveCategory($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->categoryRepository->store($data);
        return $result;
    }

    public function destroyCategory($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->destroy($id);
        }
        catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete data');
        }

        DB::commit();
        return $category;
    }

}