<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest, LoginService $loginService): JsonResponse
    {
        $data = $loginRequest->validated();
        $token = $loginService->run($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Usuário logado com sucesso',
            'data' => $token
        ]);
    }

    public function logout(LogoutService $logoutService): JsonResponse
    {
        $logoutService->run();
        return response()->json([
            'status' => 'success',
            'message' => 'Usuario deslogado com sucesso!'
        ]);
    }

    public function user(): JsonResponse
    {
        $user = auth()->user();
        $user->load('role');
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
}
