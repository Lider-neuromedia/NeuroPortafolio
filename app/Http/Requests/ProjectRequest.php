<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'description' => ['nullable'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['required', 'exists:categories,id'],
            'videos' => ['nullable', 'array'],
            'videos.*' => ['nullable', 'string', 'max:250'],
        ];

        if ($this->get('id')) {
            $validation['title'] = ['required', 'string', 'max:100', "unique:projects,title," . $this->get('id')];
            $validation['logo'] = ['nullable', 'image', 'dimensions:min_width=400,min_height=400', 'max:2048'];
            $validation['images'] = ['nullable', 'array'];
            $validation['images.*'] = ['required', 'image', 'dimensions:min_width=400,min_height=400', 'max:2048'];
        } else {
            $validation['title'] = ['required', 'string', 'max:100', 'unique:projects,title'];
            $validation['logo'] = ['required', 'image', 'dimensions:min_width=400,min_height=400', 'max:2048'];
            $validation['images'] = ['required', 'array', 'min:1'];
            $validation['images.*'] = ['required', 'image', 'dimensions:min_width=400,min_height=400', 'max:2048'];
        }

        return $validation;
    }
}
