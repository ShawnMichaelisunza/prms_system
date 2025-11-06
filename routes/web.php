<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Procurement Cycle ------------

    Route::controller(PurchaseRequestController::class)->group(function () {

        Route::get('/purchase.requests', 'index')->name('purchase.requests');

        Route::get('/purchase.requests/create', 'createPurchaseRequest')->name('purchase.requests.create');
        Route::post('/purchase.requests/store', 'storePurchaseRequest')->name('purchase.requests.store');

        Route::get('/purchase.requests/show/{id}', 'showPurchaseRequest')->name('purchase.requests.show');

        Route::get('/purchase.requests/edit/{id}', 'editPurchaseRequest')->name('purchase.requests.edit');
        Route::put('/purchase.requests/update/{id}', 'updatePurchaseRequest')->name('purchase.requests.update');

        Route::delete('/purchase.requests/destroy/{id}', 'destroyPurchaseRequest')->name('purchase.requests.destroy');
    });

    // Actions ------------
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers', 'index')->name('suppliers');

        Route::get('/suppliers/create', 'createSupplier')->name('suppliers.create');
        Route::post('/suppliers/store', 'storeSupplier')->name('suppliers.store');

        Route::get('/suppliers/edit/{id}', 'editSupplier')->name('suppliers.edit');
        Route::put('/suppliers/update/{id}', 'updateSupplier')->name('suppliers.update');

        Route::delete('/suppliers/destroy/{id}', 'destroySupplier')->name('suppliers.destroy');
    });

    Route::controller(ItemController::class)->group(function () {
        Route::get('/items', 'index')->name('items');

        Route::get('/items/create', 'createItem')->name('items.create');
        Route::post('/items/store', 'storeItem')->name('items.store');

        Route::get('/items/edit/{id}', 'editItem')->name('items.edit');
        Route::put('/items/update/{id}', 'updateItem')->name('items.update');

        Route::delete('/items/destroy/{id}', 'destroyItem')->name('items.destroy');
    });

    // libraries ------------

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users');

        Route::get('/users/create', 'createUser')->name('users.create');
        Route::post('/users/store', 'storeUser')->name('users.store');

        Route::get('/users/edit/{id}', 'editUser')->name('users.edit');
        Route::put('/users/update/{id}', 'updateUser')->name('users.update');

        Route::delete('/users/destroy/{id}', 'destroyUser')->name('users.destroy');
    });

    Route::controller(OrganizationController::class)->group(function () {
        Route::get('/organizations', 'index')->name('organizations');

        Route::get('/organizations/create', 'createOrganization')->name('organizations.create');
        Route::post('/organizations/store', 'storeOrganization')->name('organizations.store');

        Route::get('/organizations/edit/{id}', 'editOrganization')->name('organizations.edit');
        Route::put('/organizations/update/{id}', 'updateOrganization')->name('organizations.update');

        Route::delete('/organizations/destroy/{id}', 'destroyOrganization')->name('organizations.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
