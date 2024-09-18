<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AddPermissionsRequest;
use App\Http\Requests\Role\IndexRoleRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Services\Role\AddPermissionsService;
use App\Services\Role\DeleteRoleService;
use App\Services\Role\IndexRoleService;
use App\Services\Role\StoreRoleService;
use App\Services\Role\UpdateRoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function index(
        IndexRoleRequest $indexRoleRequest,
        IndexRoleService $indexRoleService
    ): JsonResponse
    {
        $data = $indexRoleRequest->validated();
        $roles = $indexRoleService->run($data);
        return response()->json($roles);
    }

    public function store(
        StoreRoleRequest $storeRoleRequest,
        StoreRoleService $storeRoleService,
    ): JsonResponse
    {
        $data = $storeRoleRequest->validated();
        $role = $storeRoleService->run($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Cargo criado com sucesso',
            'data' => $role
        ]);
    }

    public function update(
        UpdateRoleRequest $updateRoleRequest,
        UpdateRoleService $updateRoleService,
        Role              $role
    ): JsonResponse
    {
        $data = $updateRoleRequest->validated();
        $role = $updateRoleService->run($data, $role);
        return response()->json([
            'status' => 'success',
            'message' => 'Cargo atualizado com sucesso',
            'data' => $role
        ]);
    }

    public function destroy(
        DeleteRoleService $deleteRoleService,
        Role              $role
    ): JsonResponse
    {
        if ($role->users()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível apagar, usuários vinculados'
            ]);
        }

        $role->permissions()->detach();
        $deleteRoleService->run($role);

        return response()->json([
            'status' => 'success',
            'message' => 'Cargo apagado com sucesso!'
        ]);
    }

    public function addPermissions(
        AddPermissionsRequest $addPermissionsRequest,
        AddPermissionsService $addPermissionsService,
    ): JsonResponse
    {
        $data = $addPermissionsRequest->validated();
        $role = $addPermissionsService->run($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Permissões adicionadas com sucesso',
            'data' => $role
        ]);
    }
}
