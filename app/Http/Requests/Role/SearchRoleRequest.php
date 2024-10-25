<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class SearchRoleRequest extends FormRequest
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
            'draw' => 'required|integer',
            'start' => 'required|integer',
            'length' => 'required|integer',
            'search.value' => 'nullable|string',
            'order' => 'array',
            'order.*.column' => 'integer',
            'order.*.dir' => 'in:asc,desc',
            'columns' => 'required_with:order|array',
            'columns.*.data' => 'string',
        ];
    }
}
