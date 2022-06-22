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
use App\Http\Services\UserService;
use Laravel\Ui\Presets\React;

class EquipmentController extends Controller
{

    protected $equipmentService;
    protected $categoryService;
    protected $userService;

    public function __construct(
        EquipmentService $equipmentService,
        CategoryService $categoryService,
        UserService $userSerivce
    ) {
        $this->equipmentService = $equipmentService;
        $this->userService = $userSerivce;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        try {
            $equipment = $this->equipmentService->index();
            $user = $this->userService->getAllUser();
            $category = $this->categoryService->getAllCategory();
            if ($equipment)
            return view('equipment', [
                'data' => $equipment,
                'user' => $user,
                'category' => $category
            ]);
            return redirect('/equipment')->with('failed', 'Empty');
        } catch (Exception $e) {
            return redirect('/equipment')->with('failed', $e->getMessage());
        }
    }

    public function findOne(Request $request)
    {
        try {
            $equipment = $this->equipmentService->findOne($request->id);
            $user = $this->userService->getAllUser();
            $category = $this->categoryService->getAllCategory();
            if ($equipment)
                return view('equipment_search', [
                    'data' => $equipment,
                    'user' => $user,
                    'category' => $category
                ]);
            return redirect('/equipment')->with('failed', 'Not found ID or Serial Number');
        } catch (Exception $e) {
            return redirect('/equipment')->with('failed', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $result['status'] = 'success';
        $result['message'] = 'Created Equipment';
        $data = $request->only(
            ['name', 'status', 'description', 'user_id', 'category_id']
        );
        try {
            $result['data'] = $this->equipmentService->saveEquipment($data);
        } catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
            ];
        }
        return redirect('/equipment')
            ->with($result['status'], $result['message']);
    }

    public function show($id)
    {
        try {
            $equipment = Equipment::where('user_id', $id)->get();
            if ($equipment)
                return view('equipment_user', [
                    'data' => EquipmentResource::collection($equipment),
                    'username' => User::find($id)->name
                ]);
            return redirect('/equipment_user')->with('failed', 'Not found');
        } catch (Exception $e) {
            return redirect('/equipment')->with('failed', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $result['status'] = 'success';
        $result['message'] = 'Updated Equipment';
        $data = $request->only(
            ['name', 'status', 'description', 'user_id', 'category_id']
        );
        try {
            $result['data'] = $this->equipmentService->updateEquipment($id, $data);
        } catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage(),
            ];
        }
        return redirect('/equipment')
            ->with($result['status'], $result['message']);
    }

    public function destroy($id)
    {
        $result['status'] = 'success';
        $result['message'] = 'Deleted category';
        try {
            $result['data'] = $this->equipmentService->destroyEquipment($id);
        } catch (Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => $e->getMessage()
            ];
        }

        return redirect('/equipment')
            ->with($result['status'], $result['message']);
    }
}
