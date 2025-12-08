<div>
    <table class="w-full table-auto">
        <thead>
            <tr class="bg-red-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Created By</th>
                <th class="py-3 px-6 text-left">Purpose/Reason</th>
                <th class="py-3 px-6 text-left">Purchase Request No.</th>
                <th class="py-3 px-6 text-left">Purchase Order No.</th>
                <th class="py-3 px-6 text-left">Received Request No.</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm bg-white">
            @forelse ($purchaseRequestPendings as $purchaseRequest)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $purchaseRequest->user->name }}</td>
                    <td class="py-3 px-6 text-left">
                        {{ Str::limit($purchaseRequest->purpose, 40, '...') }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseRequest->pr_no }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseRequest->po_no }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseRequest->rr_no }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            {{-- show checkout --}}
                            <a href="{{ route('purchase.orders.create', encrypt($purchaseRequest->id)) }}"
                                class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
