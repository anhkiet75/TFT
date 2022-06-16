<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
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
            $equipment = Equipment::latest()->paginate(10);
            if ($equipment) 
                return view('equipment',['data' => $equipment]);
                // return new EquipmentResource($equipment);
            return response()->json(["Error" => "Empty"],400);
        }
        catch (Exception $e) {
            return response()->json(["Error" => $e->getMessage()],400);
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
            'status' => 'required|max:255',
            'description'  => 'required|max:255',
            'user_id' => 'numeric|nullable',
            'category_id' => 'required|numeric'
        ]);
        
        $input = $request->only(
            ['name', 'status', 'description', 'user_id', 'category_id']
        );

        try {
            $equipment = Equipment::create($input);
            return new EquipmentResource($equipment);
        }
        catch (Exception $e) {
            return response()->json(["Error" => $e->getMessage()],400);
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
            $equipment = Equipment::find($id);
            if ($equipment) 
                return new EquipmentResource($equipment);
            return response()->json(["Error" => "Not found"],400);
        }
        catch (Exception $e) {
             return response()->json(["Error" => $e->getMessage()],400);
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
            'user_id' => 'numeric|nullable',
            'category_id' => 'required|numeric'
        ]);

        $input = $request->only(
            ['name', 'status', 'description', 'user_id', 'category_id']
        );

        try {
            $equipment = Equipment::find($id);
            if ($equipment) {
                $equipment->update($input);
                return new EquipmentResource($equipment);
            }
            return response()->json(["Error" => "Not found"],400);
        }
        catch (Exception $e) {
             return response()->json(["Error" => $e->getMessage()],400);
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
            $equipment = Equipment::find($id);
            if ($equipment) {
                $equipment->delete();
                return response()->json(["Successfully" => "Deleted "],200);
            }
            return response()->json(["Error" => "Empty"],400);
        }
        catch (Exception $e) {
             return response()->json(["Error" => $e->getMessage()],400);
       }
    }
}
