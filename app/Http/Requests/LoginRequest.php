<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|string|min:6|exists:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages() {
        return [
            'email.min' => 'email is invalid',
            'password.min' => 'password is invalid',
            'email.exists' => 'model not found',
        ];
    }

    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
         'status'   => ($validator->errors()->first() == 'model not found') ? 404 : 422,
         'message'   => $validator->errors()->first(),
       ]));
    }
}
