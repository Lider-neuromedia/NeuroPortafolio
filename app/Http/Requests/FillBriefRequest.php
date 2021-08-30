<?php

namespace App\Http\Requests;

use App\ClientBrief;
use Illuminate\Foundation\Http\FormRequest;

class FillBriefRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $brief = ClientBrief::query()
            ->whereSlug($this->slug)
            ->notCompleted()
            ->first();

        return $brief !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $content = ClientBrief::query()
            ->whereSlug($this->slug)
            ->notCompleted()
            ->first();

        $validation = [];

        foreach ($content->brief->questions as $question) {
            if ($question->isOpen() || $question->isOpenArea()) {
                $validation[$question->tag_id] = ['nullable', 'string'];
            } else if ($question->isMultipleSelection()) {
                $options = implode(",", $question->options);
                $validation[$question->tag_id] = ['nullable', 'array', 'min:1', "in:$options"];
            } else if ($question->isUniqueSelection()) {
                $options = implode(",", $question->options);
                $validation[$question->tag_id] = ['nullable', 'array', 'min:1', 'max:1', "in:$options"];
            }
        }

        return $validation;
    }
}
