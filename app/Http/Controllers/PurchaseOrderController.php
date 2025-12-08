<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\Checkout;
use App\Models\PurchaseRequest;
use App\Services\PurchaseOrderService;

class PurchaseOrderController extends Controller
{

    protected $purchaseOrderService;

    public function __construct(PurchaseOrderService $purchaseOrderService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $purchaseRequestPendings  = PurchaseRequest::where('pr_status', 'COMPLETED')->orderBy('created_at', 'DESC')->paginate(10);

        return view('sidebar_links.purchase_orders.purchase-orders', ['purchaseRequestPendings' => $purchaseRequestPendings , ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPurchaseOrder($id)
    {
        $decryptedPurchaseRequestId = decrypt($id);
        $purchaseRequest = PurchaseRequest::findOrFail($decryptedPurchaseRequestId);
        $checkoutCartItems = Checkout::where('purchase_request_id', $purchaseRequest->id )->orderBy('created_at', 'DESC'); 

        return view('sidebar_links.purchase_orders.puchase-orders-form', ['purchaseRequest' => $purchaseRequest, 'checkoutCartItems' => $checkoutCartItems->paginate(5)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePurchaseOrder(StorePurchaseOrderRequest $storePurchaseOrderRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPurchaseOrder($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePurchaseOrder(UpdatePurchaseOrderRequest $updatePurchaseOrderRequest, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPurchaseOrder($id)
    {
        //
    }

    public function destroyPurchaseOrderItem($id){

        $decryptedPurchaseOrderItemId = decrypt($id);

        $checkoutCartItem = Checkout::findOrFail($decryptedPurchaseOrderItemId);
        $checkoutCartItem->delete();

        return redirect()->back()->with('success', 'Deleted Item Successfully !');
    }
}
