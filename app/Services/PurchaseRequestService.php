<?php

namespace App\Services;

use App\Models\PurchaseRequest;

class PurchaseRequestService
{
    public function selectAllPurchaseRequestService()
    {
        $purchaseRequests = PurchaseRequest::orderBy('created_at', 'DESC')->paginate(10);
        return $purchaseRequests;
    }

    public function storePurchaseRequestService($data)
    {
        $purchaseRequest = PurchaseRequest::create($data);
        return $purchaseRequest;
    }

    public function showPurchaseRequestService($id)
    {
        $decryptedPurchaseRequestShowId = decrypt($id);
        $purchaseRequest = PurchaseRequest::findOrFail($decryptedPurchaseRequestShowId);

        return $purchaseRequest;
    }

    public function editPurchaseRequestService($id)
    {
        $decryptedPurchaseRequestEditId = decrypt($id);
        $purchaseRequest = PurchaseRequest::findOrFail($decryptedPurchaseRequestEditId);

        return $purchaseRequest;
    }

    public function updatePurchaseRequestService($id, $data)
    {
        $decryptedPurchaseRequestUpdateId = decrypt($id);
        $purchaseRequest = PurchaseRequest::findOrFail($decryptedPurchaseRequestUpdateId);
        $purchaseRequest->update($data);

        return $purchaseRequest;
    }

    public function destroyPurchaseRequestService($id)
    {
        $decryptedPurchaseRequestDeleteId = decrypt($id);
        $purchaseRequest = PurchaseRequest::findOrFail($decryptedPurchaseRequestDeleteId);
        $purchaseRequest->delete();

        return $purchaseRequest;
    }
}
