<?php

namespace App\Services;

use App\Models\PurchaseOrder;

class PurchaseOrderService
{
    public function selectAllPurchaseOrder()
    {
        $purchaseOrders = PurchaseOrder::orderBy('created_at', 'DESC')->paginate(10);

        return $purchaseOrders;
    }

    public function storePurchaseOrderService($data)
    {
        $purchaseOrder = PurchaseOrder::create($data);
        return $purchaseOrder;
    }

    public function editPurchaseOrderService($id)
    {
        $decryptedPurchaseOrderId = decrypt($id);
        $purchaseOrder = PurchaseOrder::findOrFail($decryptedPurchaseOrderId);

        return $purchaseOrder;
    }

    public function updatePurchaseOrderService($id, $data)
    {
        $decryptedPurchaseOrderId = decrypt($id);
        $purchaseOrder = PurchaseOrder::findOrFail($decryptedPurchaseOrderId);
        $purchaseOrder->update($data);

        return $purchaseOrder;
    }

    public function showPurchaseOrderPdfService($id){
        
        $decryptedPurchaseOrderId = decrypt($id);
        $purchaseOrder = PurchaseOrder::findOrFail($decryptedPurchaseOrderId);
        
        return $purchaseOrder;
    }
}
