<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService){}

    public function login(AuthRequest $request)
    {
        $result = $this->authService->login( $request->only(['email', 'password']));

        return response()->json( $result, $result['success'] ? 200 : 403 );
    }
}
