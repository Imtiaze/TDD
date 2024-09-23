<?php

namespace App\Http\Controllers;

use App\Actions\CreateDepartmentAction;
use App\Actions\UpdateDepartmentAction;
use App\DataTransferObjects\DepartmentData;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{

    public function __construct(
        private readonly CreateDepartmentAction $createDepartment,
        private readonly UpdateDepartmentAction $updateDepartment
    ) {}

    public function store(StoreDepartmentRequest $request)
    {
        $departmentData = new DepartmentData(...$request->validated());
        $department = $this->createDepartment->execute($departmentData);

        return DepartmentResource::make($department)->response();
    }

    public function update(UpdateDepartmentRequest $request, Department $department): Response
    {
        $departmentData = new DepartmentData($request->name, $request->description);
        $department = $this->updateDepartment->execute($department, $departmentData);
        // dd(response()->noContent());
        return response()->noContent();
    }
}
