<?php

namespace App\Http\Requests;

use App\Question;
use Illuminate\Foundation\Http\FormRequest;

class BriefRequest extends FormRequest
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
        $types = implode(",", collect(Question::types())->pluck('id')->toArray());
        $id = $this->get('id');

        return [
            'name' => ['required', 'string', 'max:200', "unique:briefs,name,$id"],
            'questions' => ['required', 'array', 'min:1'],
            'questions.*.id' => ['nullable', 'integer', 'exists:questions,id'],
            'questions.*.question' => ['required', 'string', 'max:190'],
            'questions.*.type' => ['required', "in:$types"],
            'questions.*.options' => ['nullable', 'array', 'min:1'],
            'questions.*.options.*' => ['required', 'string', 'max:190'],
        ];
    }
}
