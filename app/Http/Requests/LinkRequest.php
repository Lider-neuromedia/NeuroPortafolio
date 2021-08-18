<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!\Auth::check()) {
            return false;

        }

        $projects = session('link.projects');

        if ($projects == null || count($projects) == 0) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => ['required', 'alpha_dash', 'string', 'max:50', 'unique:links,slug'],
        ];
    }
}
