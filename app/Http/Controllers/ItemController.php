<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Supplier;
use App\Services\ItemService;

class ItemController extends Controller
{
    protected $itemServices;

    public function __construct(ItemService $itemService)
    {
        $this->itemServices = $itemService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemServices->selectAllItemService();
        return view('sidebar_links.items.items', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createItem()
    {
        $suppliers = Supplier::all();

        return view('sidebar_links.items.items-form', ['item' => [], 'suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeItem(StoreItemRequest $storeItemRequest)
    {
        $validatedItemStoreRequest = $storeItemRequest->validated();

        if ($storeItemRequest->hasFile('item_image')) {
            $itemPath = $storeItemRequest->file('item_image')->store('item_images', 'public');
            $validatedItemStoreRequest['item_image'] = $itemPath;
        }

        $this->itemServices->storeItemService($validatedItemStoreRequest);
        return redirect()->back()->with('success', 'Item created successfully!');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function editItem($id)
    {
        $item = $this->itemServices->editItemService($id);
        $suppliers = Supplier::all();

        return view('sidebar_links.items.items-form', ['item' => $item, 'suppliers' => $suppliers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateItem($id, UpdateItemRequest $updateItemRequest)
    {
        $validatedItemUpdateRequest = $updateItemRequest->validated();

        if ($updateItemRequest->hasFile('item_image')) {
            $itemPath = $updateItemRequest->file('item_image')->store('item_images', 'public');
            $validatedItemUpdateRequest['item_image'] = $itemPath;
        }

        $this->itemServices->updateItemService($id, $validatedItemUpdateRequest);

        return redirect()->back()->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyItem($id)
    {
        $this->itemServices->destroyItemService($id);
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }
}
