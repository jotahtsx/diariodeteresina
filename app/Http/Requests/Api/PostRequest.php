<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|min:5|max:255',
            'resumo' => 'required|min:10',
            'categoria_id' => 'required|exists:categorias,id'
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'Ei, a notícia precisa de um título',
            'categoria_id.exists' => 'Essa categoria não existe no sistema'
        ]
    }
}
