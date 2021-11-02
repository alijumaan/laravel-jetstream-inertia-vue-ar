<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuildingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|string|max:255',
                    'number' => 'required|string|max:255',
                    'period_id' => 'required',
                    'notes' => 'nullable|max:5000',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|max:255',
                    'slug' => 'nullable',
                    'number' => 'required|string|max:255',
                    'status' => 'required|numeric|min:0|max:1',
                    'period_id' => 'required',
                    'notes' => 'nullable|max:5000',
                ];
            }
            default: break;
        }
    }
}
