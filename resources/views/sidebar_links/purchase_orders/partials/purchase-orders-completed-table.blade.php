<div>
    <table class="w-full table-auto">
        <thead>
            <tr class="bg-red-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Created By</th>
                <th class="py-3 px-6 text-left">Purchase Request No.</th>
                <th class="py-3 px-6 text-left">Purchase Order No.</th>
                <th class="py-3 px-6 text-left">Received Request No.</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm bg-white">
            @forelse ($purchaseOrders as $purchaseOrder)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $purchaseOrder->user->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseOrder->purchaseRequest->pr_no }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseOrder->purchaseRequest->po_no }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseOrder->purchaseRequest->rr_no }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            {{-- edit purchase order --}}
                            <a href="{{ route('purchase.orders.edit', encrypt($purchaseOrder->id)) }}"
                                class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-lg py-5 font-semibold text-gray-700">
                        No Data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
