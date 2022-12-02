<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = '';
        foreach ($validator->errors()->all() as $error) {
            $error = substr($error, 0, -1);
            $errors = $errors . $error . ', ';
        }

        $errors = substr($errors, 0, -2) . '.';
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $errors
        ], 400));
    }


}
