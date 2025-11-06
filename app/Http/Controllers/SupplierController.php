<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Services\SupplierService;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $suppliers = $this->supplierService->selectAllSupplierService();
        return view('sidebar_links.suppliers.suppliers', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createSupplier()
    {
        return view('sidebar_links.suppliers.suppliers-form', ['supplier' => []]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSupplier(StoreSupplierRequest $storeSupplierRequest)
    {
        $validatedStoreSupplier = $storeSupplierRequest->validated();

        $this->supplierService->storeSupplierService($validatedStoreSupplier);
        return redirect()->back()->with('success', 'Supplier created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSupplier($id)
    {
        $supplier = $this->supplierService->editSupplierService($id);

        return view('sidebar_links.suppliers.suppliers-form', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSupplier(UpdateSupplierRequest $updateSupplierRequest, $id)
    {
        $validatedUpdateSupplier = $updateSupplierRequest->validated();
        $this->supplierService->updateSupplierService($validatedUpdateSupplier, $id);

        return redirect()->back()->with('success', 'Supplier updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroySupplier($id)
    {
        $this->supplierService->destroySupplierService($id);
        return redirect()->back()->with('success', 'Supplier deleted successfully!');
    }
}
