<?php

namespace App\Services\Auth;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            return [
                'success' => false,
                'message' => 'Invalid Credentials'
            ];
        }
        
        $user = Auth::user();
        $token = $user->createToken('webToken');
        return [
            'success' => true, 
            'message' => 'Login successful.', 
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
}