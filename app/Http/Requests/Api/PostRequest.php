<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Ei, a notícia precisa de um título',
            'content.required' => 'Ei, o resumo precisa de um conteúdo',
            'category_id.required' => 'Você precisa selecionar uma categoria',
            'category_id.exists' => 'Essa categoria não existe no sistema',
            'author_id.required' => 'A notícia precisa de um autor',
            'author_id.exists' => 'Este autor não está cadastrado',
            'image.image' => 'O arquivo enviado deve ser uma imagem',
            'image.max' => 'A imagem não pode ter mais de 2MB',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Erro de validação nos dados enviados',
            'errors' => $validator->errors(),
        ], 422));
    }
}
