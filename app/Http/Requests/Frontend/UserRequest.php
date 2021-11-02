<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Spatie\Permission\Models\Role;

class UserRequest extends FormRequest
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
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'max:255', 'unique:users'],
                    'username' => ['required', 'string', 'max:255', 'unique:users'],
                    'role' => ['required', Rule::in($this->roles())],
                    'password' => ['required', 'string', new Password, 'confirmed'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'max:255', 'unique:users,email,' . $this->route()->user->id],
                    'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $this->route()->user->id],
                    'role' => ['required', Rule::in($this->roles())],
                ];
            }
            default: break;
        }
    }

    private function roles()
    {
        $roles = Cache::get("roles_request");
        if (!$roles) {
            $roles = Role::whereNotIn('name', ['admin'])->pluck('name');
            Cache::forever("roles_request", $roles);
        }
        return ($roles);
    }
}
