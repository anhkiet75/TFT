<?php

namespace App\Http\Repositories;

use App\Http\Resources\CategoryResource;
use App\Models\Category;


class CategoryRepository
{
    /**
     * @var Category
     */

    protected $category;

    /**
     * PostRepository constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(){
        return $this->category->paginate(5);
    }

    public function getAll() {
        return CategoryResource::collection($this->category->all());
    }
    /**
     * Save Category
     *
     * @param $data
     * @return Category
     */
    public function store($data)
    {
        $category = new $this->category;
        $category->name = $data['name'];
        $category->save();
        return $category->fresh();
    }

    /**
     * Update Category
     *
     * @param $id
     * @param $data
     * @return Category
     */
    public function update($id,$data)
    {
        $category = $this->category->find($id);
        $category->name = $data['name'];
        $category->update();
        return $category;
    }

    /**
     * Update Category
     *
     * @param $id
     * @return Category
     */
    public function destroy($id)
    {
        $category = $this->category->find($id);
        $category->delete();
        return $category;
    }
}
