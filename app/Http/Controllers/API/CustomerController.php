<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\IndexCustomerRequest;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\Address\StoreAddressService;
use App\Services\Address\UpdateAddressService;
use App\Services\Customer\DeleteCustomerService;
use App\Services\Customer\IndexCustomerService;
use App\Services\Customer\StoreCustomerService;
use App\Services\Customer\UpdateCustomerService;
use App\Services\LegalPerson\StoreLegalPersonService;
use App\Services\LegalPerson\UpdateLegalPersonService;
use App\Services\NaturalPerson\StoreNaturalPersonService;
use App\Services\NaturalPerson\UpdateNaturalPersonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(
        IndexCustomerRequest $indexCustomerRequest,
        IndexCustomerService $indexCustomerService
    ): JsonResponse
    {
        $data = $indexCustomerRequest->validated();
        $customers = $indexCustomerService->run($data);
        return response()->json($customers);
    }

    public function store(
        StoreCustomerRequest      $storeCustomerRequest,
        StoreCustomerService      $storeCustomerService,
        StoreNaturalPersonService $storeNaturalPersonService,
        StoreLegalPersonService   $storeLegalPersonService,
        StoreAddressService       $storeAddressService
    ): JsonResponse
    {
        return DB::transaction(function () use (
            $storeCustomerRequest,
            $storeCustomerService,
            $storeNaturalPersonService,
            $storeLegalPersonService,
            $storeAddressService
        ) {
            $data = $storeCustomerRequest->validated();

            $customer = $storeCustomerService->run($data['customer']);

            if ($data['customer']['person_type'] === 'pf') {
                $data['natural_person']['customer_id'] = $customer->id;
                $storeNaturalPersonService->run($data['natural_person'], $customer->id, 'customer');
            }

            if ($data['customer']['person_type'] === 'pj') {
                $data['legal_person']['customer_id'] = $customer->id;
                $storeLegalPersonService->run($data['legal_person'], $customer->id, 'customer');
            }

            $storeAddressService->run($data['address'], $customer->id, 'customer');

            $customer->load('naturalPerson', 'legalPerson', 'address');

            return response()->json([
                'status' => 'success',
                'message' => 'Cliente criado com sucesso',
                'data' => $customer
            ]);
        });
    }

    public function update(
        UpdateCustomerRequest      $updateCustomerRequest,
        UpdateCustomerService      $updateCustomerService,
        UpdateNaturalPersonService $updateNaturalPersonService,
        UpdateLegalPersonService   $updateLegalPersonService,
        UpdateAddressService       $updateAddressService,
        Customer                   $customer
    ): JsonResponse
    {
        return DB::transaction(function () use (
            $updateCustomerRequest,
            $updateCustomerService,
            $updateNaturalPersonService,
            $updateLegalPersonService,
            $updateAddressService,
            $customer
        ) {
            $data = $updateCustomerRequest->validated();

            $customer = $updateCustomerService->run($data['customer'], $customer);

            if ($customer->naturalPerson) {
                $data['natural_person']['customer_id'] = $customer->id;
                $updateNaturalPersonService->run($data['natural_person'], $customer->naturalPerson);
                $customer->load('naturalPerson');
            }

            if ($customer->legalPerson) {
                $data['legal_person']['customer_id'] = $customer->id;
                $updateLegalPersonService->run($data['legal_person'], $customer->legalPerson);
                $customer->load('legalPerson');
            }

            $updateAddressService->run($data['address'], $customer->address);
            $customer->load('address');

            return response()->json([
                'status' => 'success',
                'message' => 'Cliente atualizado com sucesso',
                'data' => $customer
            ]);
        });
    }

    public function destroy(
        DeleteCustomerService $deleteCustomerService,
        Customer              $customer
    ): JsonResponse
    {
        if ($customer->orders()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível apagar, pedidos vinculados'
            ]);
        }

        if ($customer->legalPerson()->count() > 0) {
            $customer->legalPerson()->delete();
        }

        if ($customer->naturalPerson()->count() > 0) {
            $customer->naturalPerson()->delete();
        }

        $customer->address()->delete();

        $deleteCustomerService->run($customer);

        return response()->json([
            'status' => 'success',
            'message' => 'Cliente apagado com sucesso!'
        ]);
    }
}
