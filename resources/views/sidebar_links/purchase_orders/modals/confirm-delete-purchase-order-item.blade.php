<button onclick="document.getElementById('confirmSupplierDelete{{ $checkoutCartItem->id }}').showModal()" type="button"
    class="w-4 mr-2 transform hover:text-red-400 hover:scale-110 text-red-500">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
        <path fill-rule="evenodd"
            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
            clip-rule="evenodd" />
    </svg>
</button>


<dialog id="confirmSupplierDelete{{ $checkoutCartItem->id }}" class="p-6 bg-white rounded-lg shadow-xl border border-gray-300">
    <form action="{{ route('purchase.orders.delete.item', encrypt($checkoutCartItem->id)) }}" method="POST">
        @method('DELETE')
        @csrf

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Delete Confirmation
            </h2>
            <button onclick="document.getElementById('confirmSupplierDelete{{ $checkoutCartItem->id }}').close()" type="button"
                class="text-gray-400 hover:text-gray-700 text-3xl font-bold leading-none focus:outline-none">&times;</button>
        </div>

        <div class="mb-6 text-gray-700 text-sm">
            Are you sure you want to delete suppplier <span class="font-semibold">{{ $checkoutCartItem->item->item_name }}</span>
            ? </br> This
            action cannot be undone.
        </div>

        <div class="flex justify-end gap-3">
            <button onclick="document.getElementById('confirmSupplierDelete{{ $checkoutCartItem->id }}').close()" type="button"
                class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                Cancel
            </button>
            <button type="submit"
                class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition flex items-center gap-2">
                Yes, Delete
            </button>
        </div>
    </form>
</dialog>
