<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|unique:users,email|email:rfc,dns',
            'password' => ['required', 'confirmed', Password::min(3)
                ->mixedCase()
                ->letters()
                ->numbers(),],
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = '';
        foreach ($validator->errors()->all() as $error) {
            $error = substr($error,0,-1);
            $errors = $errors . $error . ', ';
        }
        $errors = substr($errors,0,-2) . '.';
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $errors
        ], 400));
    }
}
