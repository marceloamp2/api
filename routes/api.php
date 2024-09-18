<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BillsToPayController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\InputController;
use App\Http\Controllers\API\LegalPersonController;
use App\Http\Controllers\API\NaturalPersonController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\StockController;
use App\Http\Controllers\API\StockMovementController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetPasswordLink'])->name('password.email');
    Route::get('/reset-password/{token}/{email?}', [ResetPasswordController::class, 'tokenResetEmail'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::prefix('bills-to-pays')->name('bills-to-pays.')->group(function () {
        Route::get('/', [BillsToPayController::class, 'index']);
        Route::post('/', [BillsToPayController::class, 'store']);
        Route::put('/{bills_to_pay}', [BillsToPayController::class, 'update']);
        Route::delete('/{bills_to_pay}', [BillsToPayController::class, 'destroy']);
    });

    Route::prefix('companies')->name('companies.')->group(function () {
        Route::get('/', [CompanyController::class, 'index']);
    });

    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::post('/', [CustomerController::class, 'store']);
        Route::put('/{customer}', [CustomerController::class, 'update']);
        Route::delete('/{customer}', [CustomerController::class, 'destroy']);
    });

    Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::get('/', [ExpenseController::class, 'index']);
        Route::post('/', [ExpenseController::class, 'store']);
        Route::put('/{expense}', [ExpenseController::class, 'update']);
        Route::delete('/{expense}', [ExpenseController::class, 'destroy']);
    });

    Route::prefix('inputs')->name('inputs.')->group(function () {
        Route::get('/', [InputController::class, 'index']);
        Route::post('/', [InputController::class, 'store']);
        Route::put('/{input}', [InputController::class, 'update']);
        Route::delete('/{input}', [InputController::class, 'destroy']);
    });

    Route::prefix('legal-person')->name('legal-person.')->group(function () {
        Route::get('/search-by-cnpj', [LegalPersonController::class, 'searchByCnpj']);
    });

    Route::prefix('natural-person')->name('natural-person.')->group(function () {
        Route::get('/search-by-cpf', [NaturalPersonController::class, 'searchByCpf']);
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::put('/{order}', [OrderController::class, 'update']);
        Route::delete('/{order}', [OrderController::class, 'destroy']);
    });

    Route::prefix('payment-methods')->name('payment-methods.')->group(function () {
        Route::get('/', [PaymentMethodController::class, 'index']);
    });

    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index']);
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::post('/add-permissions', [RoleController::class, 'addPermissions']);
        Route::put('/{role}', [RoleController::class, 'update']);
        Route::delete('/{role}', [RoleController::class, 'destroy']);
    });

    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index']);
        Route::post('/', [ServiceController::class, 'store']);
        Route::put('/{service}', [ServiceController::class, 'update']);
        Route::delete('/{service}', [ServiceController::class, 'destroy']);
    });

    Route::prefix('stocks')->name('stocks.')->group(function () {
        Route::get('/', [StockController::class, 'index']);
    });

    Route::prefix('stock-movements')->name('stock-movements.')->group(function () {
        Route::get('/', [StockMovementController::class, 'index']);
        Route::post('/', [StockMovementController::class, 'store']);
        Route::put('/{stock_movement}', [StockMovementController::class, 'update']);
        Route::delete('/{stock_movement}', [StockMovementController::class, 'destroy']);
    });

    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [SupplierController::class, 'index']);
        Route::post('/', [SupplierController::class, 'store']);
        Route::put('/{supplier}', [SupplierController::class, 'update']);
        Route::delete('/{supplier}', [SupplierController::class, 'destroy']);
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });
});
