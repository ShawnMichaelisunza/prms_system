<?php

namespace App\Services;

use App\Models\PurchaseOrder;

class PurchaseOrderService{

    public function selectAllPurchaseOrder(){

        $purchaseOrders = PurchaseOrder::orderBy('created_at', 'DESC')->paginate(10);

        return $purchaseOrders;
    }
}