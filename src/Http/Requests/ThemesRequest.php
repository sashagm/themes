<?php

namespace Sashagm\Themes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|unique:themes|max:255',
            'description' => 'nullable',
            'author' => 'nullable',
            'version' => 'nullable',
            'active' => 'boolean',
        ];
    }

    public function attribute()
    {

    }

    public function messages()
    {
       return [
            'title.required'     => 'Вы не указали название.',
            'title.unique'       => 'Указанное название должно быть уникальным.',

        ];        
    }
}
