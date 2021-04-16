<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'name' => 'required|min:2',
            'cnpj' => 'required', Rule::unique('clients')->ignore($this->id),
            'phone' => 'required',
            'responsible' => 'required|min:2',
            'email' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Este campo não pode ficar em branco.',
            'name.min' => 'O nome tem que ter mais de 2 caracteres.',
            'cnpj.required' => 'Este campo não pode ficar em branco.',
            'cnpj.unique' => 'Este número de CNPJ já possui cadastro.',
            'phone.required' => 'Este campo não pode ficar em branco.',
            'responsible.min' => 'O Responsável deve ter mais do que 2 caracteres.',
            'responsible.required' => 'Este campo não pode ficar em branco.',
            'email.required' => 'Este campo não pode ficar em branco.',
        ];
    }
}
