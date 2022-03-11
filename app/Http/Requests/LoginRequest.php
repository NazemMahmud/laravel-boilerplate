<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
            'email' => 'required|email',
            'password' => 'required|string|min:6',
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
