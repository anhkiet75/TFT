<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\User;
use Exception;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $equipment = Equipment::orderBy('id')->paginate(10);
            if ($equipment) 
                return view('equipment',[
                    'data' => EquipmentResource::collection($equipment),
                    'user' => UserResource::collection(User::all()),
                    'category' => CategoryResource::collection(Category::all())
                ]);
                // return new EquipmentResource($equipment);
            // return response()->json(["Error" => "Empty"],400);
            return redirect('/equipment')->with('failed', 'Empty');

        }
        catch (Exception $e) {
            // return response()->json(["Error" => $e->getMessage()],400);
            return redirect('/equipment')->with('failed', $e->getMessage());
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
        
        try {
            $request->validate([
                'name' => 'required|max:255',
                'status' => 'required|max:255',
                'description'  => 'required|max:255',
                'user_id' => 'nullable',
                'category_id' => 'required'
            ]);
    
            $input = $request->only(
                ['name', 'status', 'description', 'user_id', 'category_id']
            );  
            Equipment::create($input);
            // dd($input);
            // return new EquipmentResource($equipment);
            return redirect('/equipment')->with('success', 'Equipment is successfully created');
        }
        catch (Exception $e) {
            // return response()->json(["Error" => $e->getMessage()],400);
            return redirect('/equipment')->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $equipment = Equipment::where('user_id',$id)->get();
            if ($equipment) 
                return view('equipment_user',[
                    'data' => EquipmentResource::collection($equipment),
                    'username' => User::find($id)->name
                ]);
            return redirect('/equipment_user')->with('failed', 'Not found');
            // return response()->json(["Error" => "Not found"],400);            
        }
        catch (Exception $e) {
            return redirect('/equipment')->with('failed', $e->getMessage());
            // return response()->json(["Error" => $e->getMessage()],400);
       }
    }

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
            'status' => 'required|max:255',
            'description'  => 'required|max:255',
            'user_id' => 'nullable',
            'category_id' => 'required'
        ]);

        $input = $request->only(
            ['name', 'status', 'description', 'user_id', 'category_id']
        );

        try {
            $equipment = Equipment::findOrFail($id);
            if ($equipment) {
                $equipment->update($input);
                // return new EquipmentResource($equipment);
            return redirect('/equipment')->with('success', 'Equipment is successfully updated');

            }
            // return response()->json(["Error" => "Not found"],400);
            return redirect('/equipment')->with('error', 'Not found');

        }
        catch (Exception $e) {
            //  return response()->json(["Error" => $e->getMessage()],400);
            return redirect('/equipment')->with('success',  $e->getMessage());

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
            $equipment = Equipment::findOrFail($id);
            if ($equipment) {
                $equipment->delete();
                // return response()->json(["Successfully" => "Deleted "],200);
            return redirect('/equipment')->with('success', 'Equipment is successfully deleted');

            }
            // return response()->json(["Error" => "Empty"],400);
            return redirect('/equipment')->with('error', 'Not found');

        }
        catch (Exception $e) {
             return response()->json(["Error" => $e->getMessage()],400);
             return redirect('/equipment')->with('success',  $e->getMessage());
       }
    }
}
