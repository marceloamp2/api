<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\IndexSupplierRequest;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Services\Address\StoreAddressService;
use App\Services\Address\UpdateAddressService;
use App\Services\LegalPerson\StoreLegalPersonService;
use App\Services\LegalPerson\UpdateLegalPersonService;
use App\Services\NaturalPerson\StoreNaturalPersonService;
use App\Services\NaturalPerson\UpdateNaturalPersonService;
use App\Services\Supplier\DeleteSupplierService;
use App\Services\Supplier\IndexSupplierService;
use App\Services\Supplier\StoreSupplierService;
use App\Services\Supplier\UpdateSupplierService;
use Illuminate\Http\JsonResponse;

class SupplierController extends Controller
{
    public function index(
        IndexSupplierRequest $indexSupplierRequest,
        IndexSupplierService $indexSupplierService
    ): JsonResponse
    {
        $data = $indexSupplierRequest->validated();
        $suppliers = $indexSupplierService->run($data);
        return response()->json($suppliers);
    }

    public function store(
        StoreSupplierRequest      $storeSupplierRequest,
        StoreSupplierService      $storeSupplierService,
        StoreNaturalPersonService $storeNaturalPersonService,
        StoreAddressService       $storeAddressService,
        StoreLegalPersonService   $storeLegalPersonService,
    ): JsonResponse
    {
        $data = $storeSupplierRequest->validated();

        $supplier = $storeSupplierService->run($data['supplier']);

        if ($data['supplier']['person_type'] === 'pf') {
            $data['natural_person']['supplier_id'] = $supplier->id;
            $storeNaturalPersonService->run($data['natural_person'], $supplier->id, 'supplier');
        }

        if ($data['supplier']['person_type'] === 'pj') {
            $data['legal_person']['supplier_id'] = $supplier->id;
            $storeLegalPersonService->run($data['legal_person'], $supplier->id, 'supplier');
        }

        $storeAddressService->run($data['address'], $supplier->id, 'supplier');

        $supplier->load('naturalPerson', 'legalPerson', 'address');

        return response()->json([
            'status' => 'success',
            'message' => 'Fornecedor criado com sucesso',
            'data' => $supplier
        ]);
    }

    public function update(
        UpdateSupplierRequest      $updateSupplierRequest,
        UpdateSupplierService      $updateSupplierService,
        UpdateAddressService       $updateAddressService,
        UpdateNaturalPersonService $updateNaturalPersonService,
        UpdateLegalPersonService   $updateLegalPersonService,
        Supplier                   $supplier
    ): JsonResponse
    {
        $data = $updateSupplierRequest->validated();
        $supplier = $updateSupplierService->run($data['supplier'], $supplier);

        if ($supplier->naturalPerson) {
            $data['natural_person']['supplier_id'] = $supplier->id;
            $updateNaturalPersonService->run($data['natural_person'], $supplier->naturalPerson);
            $supplier->load('naturalPerson');
        }

        if ($supplier->legalPerson) {
            $data['legal_person']['supplier_id'] = $supplier->id;
            $updateLegalPersonService->run($data['legal_person'], $supplier->legalPerson);
            $supplier->load('legalPerson');
        }

        $updateAddressService->run($data['address'], $supplier->address);
        $supplier->load('address');

        return response()->json([
            'status' => 'success',
            'message' => 'Fornecedor atualizado com sucesso',
            'data' => $supplier
        ]);
    }

    public function destroy(
        DeleteSupplierService $deleteSupplierService,
        Supplier              $supplier
    ): JsonResponse
    {
        if ($supplier->stockMovements()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível apagar, movimentação do estoque vinculado'
            ]);
        }

        $supplier->address()->delete();

        if ($supplier->legalPerson()->count() > 0) {
            $supplier->legalPerson()->delete();
        }

        if ($supplier->naturalPerson()->count() > 0) {
            $supplier->naturalPerson()->delete();
        }

        $deleteSupplierService->run($supplier);

        return response()->json([
            'status' => 'success',
            'message' => 'Fornecedor apagado com sucesso!'
        ]);
    }
}
