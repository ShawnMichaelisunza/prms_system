<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequestRequest;
use App\Http\Requests\UpdatePurchaseRequestRequest;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Item;
use App\Services\PurchaseRequestService;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
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
        $purchaseRequestPendings = $this->purchaseRequestService->selectAllPendingPurchaseRequestService();
        $purchaseRequestCompletes = $this->purchaseRequestService->selectAllCompletedPurchaseRequestService();
        return view('sidebar_links.purchase_requests.purchase-requests', ['purchaseRequests' => $purchaseRequests, 'purchaseRequestPendings' => $purchaseRequestPendings, 'purchaseRequestCompletes' => $purchaseRequestCompletes]);
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

        return redirect()
            ->route('purchase.requests.show', ['id' => encrypt($purchaseRequest->id)])
            ->with('success', 'Purchase Request created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function showPurchaseRequest($id)
    {
        $purchaseRequest = $this->purchaseRequestService->showPurchaseRequestService($id);
        $items = Item::orderBy('created_at', 'DESC')->paginate(10);
        $totalCarts = Cart::where('purchase_request_id', $purchaseRequest->id)->count();

        // Fetch all item IDs currently in the cart for this purchase request
        $cartItems = Cart::where('purchase_request_id', $purchaseRequest->id)->pluck('item_id')->toArray();

        return view('sidebar_links.purchase_requests.purchase-request-show', ['purchaseRequest' => $purchaseRequest, 'items' => $items, 'totalCarts' => $totalCarts, 'cartItems' => $cartItems]);
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

    // add to cart

    public function addCartPurchaseRequest(Request $request, $id)
    {
        $validatedCartItem = $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $purchaseRequestId = $this->purchaseRequestService->addPurchaseRequestCartStoreService($id);

        Cart::create([
            'user_id' => Auth::id(),
            'purchase_request_id' => $purchaseRequestId->id,
            'item_id' => $request->item_id,
            'qty' => $validatedCartItem['qty'],
        ]);

        return redirect()->back()->with('success', 'Purchase request added to cart successfully!');
    }

    // delete cart item
    public function destroyCartPurchaseRequest($id, Request $request)
    {
        $purchaseRequestId = decrypt($id);

        Cart::where('purchase_request_id', $purchaseRequestId)->where('item_id', $request->item_id)->delete();

        return redirect()->back()->with('success', 'Cart Item removed successfully!');
    }

    // view and store checkout
    public function viewCheckoutPurchaseRequest($id)
    {
        $purchaseRequest = $this->purchaseRequestService->viewCartPurchaseRequestCartItemService($id);
        $cartItems = Cart::where('purchase_request_id', $purchaseRequest->id)->orderBy('created_at', 'DESC')->get();
        $totalCarts = Cart::where('purchase_request_id', $purchaseRequest->id)->count();

        return view('sidebar_links.purchase_requests.partials.purchase-request-checkout', ['cartItems' => $cartItems, 'totalCarts' => $totalCarts, 'purchaseRequest' => $purchaseRequest]);
    }
    public function storeCheckoutPurchaseRequest(Request $request, $id)
    {
        $purchaseRequest = $this->purchaseRequestService->storeCheckoutPurchaseRequestCartItemService($id);
        $purchaseRequest->pr_status = 'COMPLETED';
        $purchaseRequest->update([
            'pr_no' => 'PR' . now()->format('Y') . ' - ' . str_pad($purchaseRequest->id, 5, '0', STR_PAD_LEFT),
        ]);

        $totalCost = 0;

        foreach ($request->cart_item_id as $index => $itemId) {
            $qty = $request->cart_requested_qty[$index];
            $cost = $request->cart_item_cost[$index] * $qty;

            $totalCost += $cost;

            Checkout::create([
                'user_id' => Auth::id(),
                'purchase_request_id' => $purchaseRequest->id,
                'cart_item_id' => $itemId,
                'cart_requested_qty' => $qty,
                'total_costs' => $cost,
            ]);
        }

        Cart::where('purchase_request_id', $purchaseRequest->id)->delete();

        return redirect()
            ->route('purchase.requests.checkout.show', encrypt($purchaseRequest->id))
            ->with('success', 'Purchase Request Completed!');
    }

    public function showCheckoutPurchaseRequest($id)
    {
        $PurchaseRequestCheckout = $this->purchaseRequestService->showCheckoutPurchaseRequestCartItemService($id);
        $checkoutCartItems = Checkout::where('purchase_request_id', $PurchaseRequestCheckout->id)->orderBy('created_at', 'DESC')->get();
        $totalcheckoutItems = Checkout::where('purchase_request_id', $PurchaseRequestCheckout->id)->count();

        return view('sidebar_links.purchase_requests.partials.purchase-request-show-checkout', ['PurchaseRequestCheckout' => $PurchaseRequestCheckout, 'checkoutCartItems' => $checkoutCartItems, 'totalcheckoutItems' => $totalcheckoutItems]);
    }

    // show pdf
    public function pdfCheckoutPurchaseRequest($id)
    {
        $PurchaseRequestCheckout = $this->purchaseRequestService->showCheckoutPurchaseRequestCartItemService($id);
        $checkoutCartItems = Checkout::where('purchase_request_id', $PurchaseRequestCheckout->id)->orderBy('created_at', 'DESC')->get();
        $totalcheckoutItems = Checkout::where('purchase_request_id', $PurchaseRequestCheckout->id)->count();

        $data = ['PurchaseRequestCheckout' => $PurchaseRequestCheckout, 'checkoutCartItems' => $checkoutCartItems, 'totalcheckoutItems' => $totalcheckoutItems];

        $pdf = SnappyPdf::loadView('sidebar_links.purchase_requests.pdf.purchase-request-details-pdf', $data)->setOption('orientation', 'portrait')->setOption('footer-html', view('sidebar_links.purchase_requests.pdf.purchase-request-footer-pdf')->render())->setOption('enable-local-file-access', true)
        ->setOption('margin-bottom', '50');

        return $pdf->inline();
    }
}
