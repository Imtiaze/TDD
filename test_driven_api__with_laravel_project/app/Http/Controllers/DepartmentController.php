<?php

namespace App\Http\Controllers;

use App\Actions\CreateDepartmentAction;
use App\DataTransferObjects\DepartmentData;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{

    public function __construct(
        private readonly CreateDepartmentAction $createDepartment
    ) {}

    public function store(StoreDepartmentRequest $request)
    {
        $departmentData = new DepartmentData(...$request->validated());
        $department = $this->createDepartment->execute($departmentData);

        return DepartmentResource::make($department)->response();
    }
}
