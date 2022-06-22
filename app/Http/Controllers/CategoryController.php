<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }

    public function index()
    {
        try {
            $result = $this->categoryService->index();  
            return view('category',[ 'data' => $result ]);
        } catch (Exception $e) {
            return redirect('/cetegory')->with('failed',  $e->getMessage());
        }
    }


    public function store(Request $request)
    {
        $data = $request->only('name');
        $result['status'] = 'success';
        $result['message'] = 'Created category';
        try {
            $result['data'] = $this->categoryService->saveCategory($data);
        } catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
                'data' => ''
            ];
        }
        return redirect('/category')
            ->with($result['status'],$result['message'])
            ->with('data',$result['data']);
    }

    // public function show($id)
    // {
    //     try {
    //         $category = Category::find($id);
    //         if ($category)
    //             return new CategoryResource($category);
    //         return response()->json(["Error" => "Not found"], 400);
    //     } catch (Exception $e) {
    //         return response()->json(["Error" => $e->getMessage()], 400);
    //     }
    // }


    public function update(Request $request, $id)
    {
        $data = $request->only('name');
        $result['status'] = 'success';
        $result['message'] = 'Updated category';
        try {
            $result['data'] = $this->categoryService->updateCategory($id, $data);
        } catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
                'data' => ''
            ];
        }

        return redirect('/category')
            ->with($result['status'],$result['message'])
            ->with('data',$result['data']);
    }

    public function destroy($id)
    {
        $result['status'] = 'success';
        $result['message'] = 'Deleted category';
        try {
            $result['data'] = $this->categoryService->destroyCategory($id);
        } catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
                'data' => ''
            ];
        }

        return redirect('/category')
            ->with($result['status'],$result['message'])
            ->with('data',$result['data']);
    }
}
