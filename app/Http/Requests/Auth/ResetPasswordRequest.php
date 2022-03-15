<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class ResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|confirmed|min:6',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new HttpResponseException(
                response()->json([
                    'data' => [
                        'message' => $errors->first()
                    ]
                ], 422)
            );
        }
    }
}
