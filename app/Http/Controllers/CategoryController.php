<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        try {
            $category = Category::paginate(5);
            if ($category) {
                return view('category', ['data' => $category]);
            }
            // return response()->json(["Error" => "Empty"],400);
            return redirect('/cetegory')->with('failed', "Empty");
        } catch (Exception $e) {
            // return response()->json(["Error" => $e->getMessage()],400);
            return redirect('/cetegory')->with('failed',  $e->getMessage());
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
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $input = $request->only('name');

        try {
            $category = Category::create($input);
            // return view('category', ['data' => $category, 'success' => 'Category is successfully created']);
            return redirect('/category')->with('success', 'Category is successfully created');


            // return new CategoryResource($category);
        } catch (Exception $e) {
            // return response()->json(["Error" => $e->getMessage()],400);
            return redirect('/category')->with('failed',  $e->getMessage());
        }
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
    //         $category = Category::find($id);
    //         if ($category)
    //             return new CategoryResource($category);
    //         return response()->json(["Error" => "Not found"], 400);
    //     } catch (Exception $e) {
    //         return response()->json(["Error" => $e->getMessage()], 400);
    //     }
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
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $input = $request->only('name');

        try {
            $category = Category::find($id);
            if ($category) {
                $category->update($input);
                // return new CategoryResource($category);
                return redirect('/category')->with('success', 'Category is successfully updated');
            }
            // return response()->json(["Error" => "Not found"],400);
            return redirect('/category')->with('failed', 'Not found');
        } catch (Exception $e) {
            //  return response()->json(["Error" => $e->getMessage()],400);
            return redirect('/category')->with('failed',  $e->getMessage());
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
            $category = Category::find($id);
            if ($category) {
                $category->delete();
                // return response()->json(["Successfully" => "Deleted "],200);
                return redirect('/category')->with('success', 'Category is successfully deleted');
            }
            // return response()->json(["Error" => "Empty"],400);
            return redirect('/category')->with('success', 'Category is successfully updated');
        } catch (Exception $e) {
            //  return response()->json(["Error" => $e->getMessage()],400);
            return redirect('/category')->with('failed',  $e->getMessage());
        }
    }
}
