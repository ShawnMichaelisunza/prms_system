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

    public function selectAllPendingPurchaseRequestService()
    {
        $purchaseRequests = PurchaseRequest::where('pr_status', 'PENDING')->orderBy('created_at', 'DESC')->paginate(10);
        return $purchaseRequests;
    }

    public function selectAllCompletedPurchaseRequestService()
    {
        $purchaseRequests = PurchaseRequest::where('pr_status', 'COMPLETED')->orderBy('created_at', 'DESC')->paginate(10);
        return $purchaseRequests;
    }


    public function storePurchaseRequestService($data)
    {
        $purchaseRequest = PurchaseRequest::create($data);
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

    // add to cart

    public function showPurchaseRequestService($id)
    {
        $decryptedPurchaseRequestShowId = decrypt($id);
        $purchaseRequest = PurchaseRequest::findOrFail($decryptedPurchaseRequestShowId);

        return $purchaseRequest;
    }

    // cart

    public function addPurchaseRequestCartStoreService($id)
    {
        $decryptedPurchaseRequestCartShowId = decrypt($id);
        $purchaseRequestAddCart = PurchaseRequest::findOrFail($decryptedPurchaseRequestCartShowId);

        return $purchaseRequestAddCart;
    }

    public function viewCartPurchaseRequestCartItemService($id)
    {
        $decryptedPurchaseRequestCartShowId = decrypt($id);
        $purchaseRequestViewCart = PurchaseRequest::findOrFail($decryptedPurchaseRequestCartShowId);

        return $purchaseRequestViewCart;
    }

    // checkout

    public function storeCheckoutPurchaseRequestCartItemService($id)
    {
        $decryptedPurchaseRequestCheckoutStoreId = decrypt($id);
        $purchaseRequestViewCheckout = PurchaseRequest::findOrFail($decryptedPurchaseRequestCheckoutStoreId);

        return $purchaseRequestViewCheckout;
    }

    public function showCheckoutPurchaseRequestCartItemService($id)
    {
        $decryptedPurchaseRequestCheckoutStoreId = decrypt($id);
        $purchaseRequestShowCheckout = PurchaseRequest::findOrFail($decryptedPurchaseRequestCheckoutStoreId);

        return $purchaseRequestShowCheckout;
    }
}
