<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{
    public function selectAllItemService()
    {
        $items = Item::with('supplier')->orderBy('created_at', 'DESC')->paginate(10);

        return $items;
    }

    public function storeItemService($data)
    {
        $item = Item::create($data);
        return $item;
    }

    public function editItemService($id)
    {
        $decryptedEditItemId = decrypt($id);
        $item = Item::findOrFail($decryptedEditItemId);

        return $item;
    }

    public function updateItemService($id, $data)
    {
        $decryptedUpdateItemId = decrypt($id);
        $item = Item::findOrFail($decryptedUpdateItemId);
        $item->update($data);

        return $item;
    }

    public function destroyItemService($id)
    {
        $decryptedDeleteItemId = decrypt($id);
        $item = Item::findOrFail($decryptedDeleteItemId);
        $item->delete();
        
    }
}
