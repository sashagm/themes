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
            'name' => 'required|string|unique:themes|max:255',

        ];
    }

    public function attribute()
    {

    }

    public function messages()
    {
       return [
            'name.required'     => 'Вы не указали название.',
            'name.unique'       => 'Указанное название должно быть уникальным.',

        ];        
    }
}
