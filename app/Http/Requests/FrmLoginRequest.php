<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrmLoginRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:50'],
            'senha' => 'required'
        ];
    }

    /**
     * Validations messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail não é válido.',
            'email.max' => 'O campo e-mail não pode ter mais de 50 caracteres.',
            'senha.required' => 'O campo senha é obrigatório.'
        ];
    }
}
