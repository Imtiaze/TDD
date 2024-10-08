<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                // 'unique:departments,name,' . $this->department->uuid . ',uuid'
                Rule::unique('departments', 'name')->ignore($this->department),
            ],
            'description' => [
                'nullable',
                'sometimes',
                'string'
            ]
        ];
    }
}
