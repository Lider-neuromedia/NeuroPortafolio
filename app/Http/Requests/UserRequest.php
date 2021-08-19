<?php

namespace App\Http\Requests;

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
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation = [
            'name' => ['required', 'string', 'max:100', 'min:5'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        if ($this->has('id')) {
            $id = $this->get('id');
            $validation['email'] = ['required', 'string', 'email', "unique:users,email,$id"];
            $validation['password'] = ['nullable', 'string', 'min:8', 'confirmed'];
        }

        return $validation;
    }
}
