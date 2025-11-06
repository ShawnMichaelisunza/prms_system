<?php

namespace App\Services;

use App\Models\Supplier;

class SupplierService
{
    public function selectAllSupplierService()
    {
        $suppliers = Supplier::orderBy('created_at', 'DESC')->paginate(10);

        return $suppliers;
    }

    public function storeSupplierService($data)
    {
        $supplier = Supplier::create($data);

        return $supplier;
    }

    public function editSupplierService($id)
    {
        $decryptedEditSuppllierId = decrypt($id);
        $supplier = Supplier::findOrFail($decryptedEditSuppllierId);

        return $supplier;
    }

    public function updateSupplierService($data, $id)
    {
        $decryptedUpdateSuppllierId = decrypt($id);
        $supplier = Supplier::findOrFail($decryptedUpdateSuppllierId);
        $supplier->update($data);

        return $supplier;
    }

    public function destroySupplierService($id){

         $decryptedDeleteSuppllierId = decrypt($id);
         $supplier = Supplier::findOrFail($decryptedDeleteSuppllierId);
         $supplier->delete();

         return $supplier;
    }
}
