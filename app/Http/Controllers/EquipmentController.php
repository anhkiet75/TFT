<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\UserResource;
use App\Http\Services\CategoryService;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\User;
use Exception;
use App\Http\Services\EquipmentService;


class EquipmentController extends Controller
{

    protected $equipmentService;
    protected $categoryService;
    protected $username;

    public function __construct(EquipmentService $service)
    {
        $this->equipmentService = $service;
    }

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
            return redirect('/equipment')->with('failed', 'Empty');
        }
        catch (Exception $e) {
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
        $result['status'] = 'success';
        $result['message'] = 'Created Equipment';
        $data = $request->only(
            ['name', 'status', 'description', 'user_id', 'category_id']
        );  
        try {
            $result['data'] = $this->equipmentService->saveEquipment($data);
        }
        catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
            ];
        }
        return redirect('/equipment')
            ->with($result['status'],$result['message']);
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
        }
        catch (Exception $e) {
            return redirect('/equipment')->with('failed', $e->getMessage());
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
        $result['status'] = 'success';
        $result['message'] = 'Updated Equipment';
        $data = $request->only(
            ['name', 'status', 'description', 'user_id', 'category_id']
        );  
        try {
            $result['data'] = $this->equipmentService->updateEquipment($id,$data);
        }
        catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
                'data' => ''
            ];
        }
        return redirect('/equipment')
            ->with($result['status'],$result['message'])
            ->with('data',$result['data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result['status'] = 'success';
        $result['message'] = 'Deleted category';
        try {
            $result['data'] = $this->equipmentService->destroyEquipment($id);
        } catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
                'data' => ''
            ];
        }

        return redirect('/equipment')
            ->with($result['status'],$result['message'])
            ->with('data',$result['data']);
    }
}
