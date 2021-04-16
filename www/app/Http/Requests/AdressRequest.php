<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdressRequest extends FormRequest
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
            'cep' => 'required',
            'patio' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'cep.required' => 'Este campo não pode ficar em branco.',
            'patio.required' => 'Este campo não pode ficar em branco.',
            'district.required' => 'Este campo não pode ficar em branco.',
            'city.required' => 'Este campo não pode ficar em branco.',
            'state.required' => 'Este campo não pode ficar em branco.',
        ];
    }
}
