<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "role" => [
                'required', 
                'string', 
                Rule::unique('roles', 'role')->withoutTrashed()
            ],
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $itemId = $this->route()->parameter('role');
            $rules['role'] = ['required', 'string', Rule::unique('roles', 'role')->ignore($itemId, 'id')->withoutTrashed()];
        }
        return $rules;
    }
}
