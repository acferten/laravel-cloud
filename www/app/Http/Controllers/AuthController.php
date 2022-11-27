<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name']
        ]);

        $response = [
            'status' => true,
            'message' => 'Your account has been successfully created'
        ];
        return response($response, 201);
    }
}
