<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Http\Requests\StorePurchaseRequestRequest;
use App\Http\Requests\UpdatePurchaseRequestRequest;
use App\Models\Cart;
use App\Models\Item;
use App\Services\PurchaseRequestService;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{

    protected $purchaseRequestService;

    public function __construct(PurchaseRequestService $purchaseRequestService)
    {
        $this->purchaseRequestService = $purchaseRequestService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseRequests = $this->purchaseRequestService->selectAllPurchaseRequestService();
        return view('sidebar_links.purchase_requests.purchase-requests', ['purchaseRequests' => $purchaseRequests]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPurchaseRequest()
    {
    
        return view('sidebar_links.purchase_requests.purchase-request-form', ['purchaseRequest' => []]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePurchaseRequest(StorePurchaseRequestRequest $storePurchaseRequestRequest)
    {
        
        $validatedStorePurchaseRequest = $storePurchaseRequestRequest->validated();
        $purchaseRequest = $this->purchaseRequestService->storePurchaseRequestService($validatedStorePurchaseRequest);

        return redirect()->route('purchase.requests.show', [ 'id' => encrypt($purchaseRequest->id) ])->with('success', 'Purchase Request created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function showPurchaseRequest($id)
    {

        $purchaseRequest = $this->purchaseRequestService->showPurchaseRequestService($id);
        $items = Item::orderBy('created_at', 'DESC')->paginate(10);

        return view('sidebar_links.purchase_requests.purchase-request-show', ['purchaseRequest' => $purchaseRequest, 'items' => $items]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPurchaseRequest($id)
    {

        $purchaseRequest = $this->purchaseRequestService->editPurchaseRequestService($id);
         return view('sidebar_links.purchase_requests.purchase-request-form', ['purchaseRequest' => $purchaseRequest]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePurchaseRequest($id, UpdatePurchaseRequestRequest $updatePurchaseRequestRequest)
    {
        $validatedUpdatePurchaseRequest = $updatePurchaseRequestRequest->validated();
        $this->purchaseRequestService->updatePurchaseRequestService($id, $validatedUpdatePurchaseRequest);

        return redirect()->back()->with('success', 'Purchase Request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPurchaseRequest($id)
    {
        $this->purchaseRequestService->destroyPurchaseRequestService($id);
        return redirect()->back()->with('success', 'Purchase Request deleted successfully!');
    }
}
