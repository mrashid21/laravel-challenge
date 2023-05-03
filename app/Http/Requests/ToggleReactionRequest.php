<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ToggleReactionRequest extends FormRequest {
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
            'post_id' => 'required|int|exists:posts,id',
            'like' => 'required|boolean',
        ];
    }

    public function messages() {
        return [
            'post_id.exists' => 'model not found',
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
