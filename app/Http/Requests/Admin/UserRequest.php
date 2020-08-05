<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'min:8|required_with:password-confirm|same:password-confirm',
            'password-confirm' => 'min:8',
            "role"    => "required|array|min:1",
            "role.*"  => "required|string|distinct|min:1",
        ];
        if ($this->getMethod() == 'PUT') {
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                "role"    => "required|array|min:1",
                "role.*"  => "required|string|distinct|min:1",
            ];
        }
        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'email has registered.',
            'password.min'  => 'password minimum length 8 chars',
            'role.required' => ' The roles field is required'
        ];
    }
}
