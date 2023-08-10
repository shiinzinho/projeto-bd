<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsuarioRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:80|min:5',
            'cellphone' => 'required|max:15|min:10',
            'cpf' => 'required|max:11|min:11|unique:usuarios,cpf',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required'
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }
        public function messages(){
            return [
                'name.required' => 'O campo nome é obrigatório',
                'name.max' => 'O campo nome deve conter no máximo 80 caracteres',
                'name.min' => 'O campo nome deve conter no mínimo 5 caracteres',
                'cellphone.required' => 'O número de telefone é obrigatório',
                'cellphone.max' => 'O número de telefone deve conter no máximo 15 caracteres',
                'cellphone.min' => 'O número de telefone deve conter no mínimo 10 caracteres',
                'cpf.required' => 'CPF obrigatório',
                'cpf.max' => 'CPF deve conter no máximo 11 caracteres',
                'cpf.min' => 'CPF deve conter no mínimo 11 caracteres',
                'cpf.unique' => 'CPF já cadastrado no sistema',
                'email.required' => 'CPF obrigatório',
                'email.unique' => 'O email já está cadastrado no sistema',
                'name.required' => 'O campo nome é obrigatório',
                'password.required' => 'Senha obrigatória',
            ];
        }
}