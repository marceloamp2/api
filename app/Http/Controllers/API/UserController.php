<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\User\DeleteUserService;
use App\Services\User\IndexUserService;
use App\Services\User\StoreUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(
        IndexUserRequest $indexUserRequest,
        IndexUserService $indexUserService
    ): JsonResponse
    {
        $data = $indexUserRequest->validated();
        $users = $indexUserService->run($data);
        return response()->json($users);
    }

    public function store(
        StoreUserRequest $storeUserRequest,
        StoreUserService $storeUserService,
    ): JsonResponse
    {
        $data = $storeUserRequest->validated();
        $user = $storeUserService->run($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Usuário criado com sucesso',
            'data' => $user
        ]);
    }

    public function update(
        UpdateUserRequest $updateUserRequest,
        UpdateUserService $updateUserService,
        User              $user
    ): JsonResponse
    {
        $data = $updateUserRequest->validated();
        $user = $updateUserService->run($data, $user);
        return response()->json([
            'status' => 'success',
            'message' => 'Usuário atualizado com sucesso',
            'data' => $user
        ]);
    }

    public function destroy(
        DeleteUserService $deleteUserService,
        User              $user
    ): JsonResponse
    {
        $deleteUserService->run($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Usuário apagado com sucesso!'
        ]);
    }
}
