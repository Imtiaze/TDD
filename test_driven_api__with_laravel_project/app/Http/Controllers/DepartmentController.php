<?php

namespace App\Http\Controllers;

use App\Actions\CreateDepartmentAction;
use App\Actions\UpdateDepartmentAction;
use App\Actions\UpsertDepartmentAction;
use App\DataTransferObjects\DepartmentData;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpsertDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{

    public function __construct(
        private readonly upsertDepartmentAction $upsertDepartment,
    ) {}

    public function store(UpsertDepartmentRequest $request)
    {
        return DepartmentResource::make($this->upsert(new Department, $request))->response();
    }

    public function update(UpsertDepartmentRequest $request, Department $department): Response
    {
        $this->upsert($department, $request);
        return response()->noContent();
    }

    private function upsert(Department $department, UpsertDepartmentRequest $request)
    {
        $departmentData = new DepartmentData(...$request->validated());
        return $this->upsertDepartment->execute($department, $departmentData);
    }
}
