<?php

namespace App\Http\Requests\Web\Series;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:1|max:250'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!'
        ];
    }
}
