<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'titulo' => 'required|max:120',
            'descricao' => 'required|min:20',
            'imagem' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Ops, é necessário informar o título!',
            'descricao.required' => 'Ops, é necessário informar a descrição!',
            'descricao.min' => 'Ops, é necessário informar pelo menos 20 caracteres na descrição!',
            'imagem.required' => 'Ops, é necessário enviar uma imagem!',
            'imagem.image' => 'Ops, somente imagens são aceitas!',
        ];
    }
}
