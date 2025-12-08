<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
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
        // view all data
        Route::get('/purchase-requests', 'index')->name('purchase.requests');

        Route::get('/purchase-requests/create', 'createPurchaseRequest')->name('purchase.requests.create');
        Route::post('/purchase-requests/store', 'storePurchaseRequest')->name('purchase.requests.store');

        Route::get('/purchase-requests/show/{id}', 'showPurchaseRequest')->name('purchase.requests.show');

        Route::get('/purchase-requests/edit/{id}', 'editPurchaseRequest')->name('purchase.requests.edit');
        Route::put('/purchase-requests/update/{id}', 'updatePurchaseRequest')->name('purchase.requests.update');

        Route::delete('/purchase-requests/destroy/{id}', 'destroyPurchaseRequest')->name('purchase.requests.destroy');

        // add to cart

        Route::post('/purchase-requests/cart/store/{id}', 'addCartPurchaseRequest')->name('purchase.requests.cart.store');

        // delete cart item 

        Route::delete('/purchase-request/cart/delete/{id}', 'destroyCartPurchaseRequest')->name('purchase.requests.cart.destroy');

        // checkout

        Route::get('purchase-requests/view/checkout/{id}', 'viewCheckoutPurchaseRequest')->name('purchase.requests.checkout.view');
        Route::post('purchase-requests/store/checkout/{id}', 'storeCheckoutPurchaseRequest')->name('purchase.requests.checkout.store');

        // show checkout
        Route::get('purchase-requests/show/checkout/{id}', 'showCheckoutPurchaseRequest')->name('purchase.requests.checkout.show');
        
        // checkout pdf
        Route::get('/purchase-request-completed/pdf/{id}', 'pdfCheckoutPurchaseRequest')->name('purchase.requests.checkout.pdf');
    });

    // Purchase Order ------------
    Route::controller(PurchaseOrderController::class)->group(function(){

        Route::get('/purchase-orders', 'index')->name('purchase.orders');

        Route::get('/purchase-orders/create/{id}', 'createPurchaseOrder')->name('purchase.orders.create');
        Route::post('/purchase-orders/store/{id}', 'storePurchaseOrder')->name('purchase.orders.store');

        Route::get('/purchase-orders/edit/{id}', 'editPurchaseOrder')->name('purchase.orders.edit');
        Route::put('/purchase-orders/update/{id}', 'updatePurchaseOrder')->name('purchase.orders.update');

        Route::delete('/purchase-orders/destroy/{id}', 'destroyPurchaseOrder')->name('purchase.orders.destroy');


        // checkout items 
        Route::delete('/purchase-order/delete-item/{id}', 'destroyPurchaseOrderItem')->name('purchase.order.delete.item');

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
