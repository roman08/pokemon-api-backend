<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class CoachRequest extends FormRequest
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

            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:coaches',
            'surnames' => 'required|string',
            'birth_date' => 'required',
            'role' => 'required',

        ];
    }

    public function messages()

    {

        return [

            'email.unique' => 'EL correo ya existe',
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El correo es requerido',
            'surnames.required' => 'Los apellidos son requeridos',
            'birth_date.required' => 'La fecha de nacimiento es requerida',
            'role.required' => 'El rol es requerido',
            'nombre.string' => 'El nombre debe ser texto',
            'email.string' => 'El correo debe ser texto',
            'surnames.string' => 'Los apellidos  deben ser texto',
            'nombre.max' => 'El nombre debe  tener maximo 100 caracteres',

        ];

    }
    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([
            'status'    => 'error',
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));

    }
}
