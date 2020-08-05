<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NavigationRequest extends FormRequest
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
            'parent_id' => ['required','max:20'],
            'name' => ['required', 'string', 'max:191','unique:navigations'],
            'url'   => ['required','string','max:191'],
            'order'   => ['required','integer','max:11'],
            'icon'   => ['required','string','max:191'],
            'permission_name'   => ['required','string','max:191'],
        ];
        if ($this->getMethod() == 'PUT') {
            $rules = [
                'parent_id' => ['required','max:20'],
                'name' => ['required', 'string', 'max:191'],
                'url'   => ['required','string','max:191'],
                'order'   => ['required','integer','max:11'],
                'icon'   => ['required','string','max:191'],
                'permission_name'   => ['required','string','max:191'],
            ];
        }
        return $rules; 
    }
}
