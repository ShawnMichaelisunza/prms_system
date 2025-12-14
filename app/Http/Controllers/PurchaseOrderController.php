<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\Checkout;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use App\Services\PurchaseOrderService;
use Barryvdh\Snappy\Facades\SnappyPdf;

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
        $purchaseRequestPendings = PurchaseRequest::where('pr_no', '!=', 'No PR-NO')->where('po_no', 'No PO-NO')->orderBy('created_at', 'DESC')->paginate(10);
        $purchaseOrders = $this->purchaseOrderService->selectAllPurchaseOrder();

        return view('sidebar_links.purchase_orders.purchase-orders', ['purchaseRequestPendings' => $purchaseRequestPendings, 'purchaseOrders' => $purchaseOrders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPurchaseOrder($id)
    {
        $decryptedPurchaseRequestId = decrypt($id);
        $purchaseRequest = PurchaseRequest::findOrFail($decryptedPurchaseRequestId);
        $suppliers = Supplier::all();
        $checkoutCartItems = Checkout::where('purchase_request_id', $purchaseRequest->id)->orderBy('created_at', 'DESC');

        return view('sidebar_links.purchase_orders.puchase-orders-form', ['purchaseRequest' => $purchaseRequest, 'checkoutCartItems' => $checkoutCartItems->paginate(5), 'suppliers' => $suppliers, 'purchaseOrder' => null]);
    }

    public function storePurchaseOrder($id, StorePurchaseOrderRequest $storePurchaseOrderRequest)
    {
        $decryptedPurchaseRequestId = decrypt($id);
        $validatedPurchaseOrder = $storePurchaseOrderRequest->validated();
        // Save PO with purchase_request_id
        $validatedPurchaseOrder['purchase_request_id'] = $decryptedPurchaseRequestId;

        $purchaseOrder = $this->purchaseOrderService->storePurchaseOrderService($validatedPurchaseOrder);

        // Update PR with PO number
        $purchaseRequest = PurchaseRequest::findOrFail($decryptedPurchaseRequestId);
        $purchaseRequest->po_no = 'PO' . now()->format('Y') . ' - ' . str_pad($purchaseOrder->id, 5, '0', STR_PAD_LEFT);
        $purchaseRequest->save();

        return redirect()
            ->route('purchase.orders.edit', encrypt($purchaseOrder->id))
            ->with('success', 'Created Purchase Order Successfully !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPurchaseOrder($id)
    {
        $purchaseOrder = $this->purchaseOrderService->editPurchaseOrderService($id);
        $purchaseRequest = PurchaseRequest::findOrFail($purchaseOrder->purchase_request_id);
        $checkoutCartItems = Checkout::where('purchase_request_id', $purchaseOrder->purchase_request_id)->orderBy('created_at', 'DESC');
        $suppliers = Supplier::all();

        return view('sidebar_links.purchase_orders.puchase-orders-form', ['checkoutCartItems' => $checkoutCartItems->paginate(5), 'suppliers' => $suppliers, 'purchaseOrder' => $purchaseOrder, 'purchaseRequest' => $purchaseRequest]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePurchaseOrder($id, UpdatePurchaseOrderRequest $updatePurchaseOrderRequest)
    {
        $validatedPurchaseOrder = $updatePurchaseOrderRequest->validated();
        $this->purchaseOrderService->updatePurchaseOrderService($id, $validatedPurchaseOrder);

        return redirect()->back()->with('success', 'Updated Purchase Order Successfully !');
    }

    public function destroyPurchaseOrderItem($id)
    {
        $decryptedPurchaseOrderItemId = decrypt($id);

        $checkoutCartItem = Checkout::findOrFail($decryptedPurchaseOrderItemId);
        $checkoutCartItem->delete();

        return redirect()->back()->with('success', 'Deleted Item Successfully !');
    }

    public function pdfPurchaseOrder($id)
    {
        $purchaseOrder = $this->purchaseOrderService->showPurchaseOrderPdfService($id);
        $purchaseRequest = PurchaseRequest::findOrFail($purchaseOrder->purchase_request_id);
        $checkoutCartItems = Checkout::where('purchase_request_id', $purchaseOrder->purchase_request_id)->get();

        $data = ['purchaseOrder' => $purchaseOrder, 'purchaseRequest' => $purchaseRequest, 'checkoutCartItems' => $checkoutCartItems];

        $pdf = SnappyPdf::loadView('sidebar_links.purchase_orders.pdf.purchase-order-details-pdf', $data)->setOption('orientation', 'portrait')->setOption('footer-html', view('sidebar_links.purchase_orders.pdf.purchase-order-footer-pdf')->render())->setOption('enable-local-file-access', true)
        ->setOption('margin-bottom', '50');

        return $pdf->inline();
    }
}
