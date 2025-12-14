<div>
    <table class="w-full table-auto">
        <thead>
            <tr class="bg-red-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Created By</th>
                <th class="py-3 px-6 text-left">Purpose/Reason</th>
                <th class="py-3 px-6 text-left">Purchase Request No.</th>
                <th class="py-3 px-6 text-left">Purchase Order No.</th>
                <th class="py-3 px-6 text-left">Received Request No.</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 bg-white text-sm">
            @forelse ($purchaseRequests as $purchaseRequest)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $purchaseRequest->user->name }}</td>
                    <td class="py-3 px-6 text-left">
                        {{ Str::limit($purchaseRequest->purpose, 20, '...') }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseRequest->pr_no }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseRequest->po_no }}</td>
                    <td class="py-3 px-6 text-left">{{ $purchaseRequest->rr_no }}</td>
                    <td class="py-3 px-6 text-left">
                        @if ($purchaseRequest->pr_status == 'PENDING')
                            <span class="text-blue-500">{{ $purchaseRequest->pr_status }}</span>
                        @else
                            <span class="text-green-500">{{ $purchaseRequest->pr_status }}</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">

                            @if ($purchaseRequest->pr_no != 'No PR-NO' && $purchaseRequest->pr_status != 'PENDING')
                                {{-- show checkout --}}
                                <a href="{{ route('purchase.requests.checkout.show', encrypt($purchaseRequest->id)) }}"
                                    class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </a>
                            @else
                                {{-- edit and add cart --}}
                                <a href="{{ route('purchase.requests.show', encrypt($purchaseRequest->id)) }}"
                                    class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </a>

                                <a href="{{ route('purchase.requests.edit', encrypt($purchaseRequest->id)) }}"
                                    class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            @endif
                            <div>
                                @include('sidebar_links.purchase_requests.modals.confirm-delete-purchase-request')
                            </div>
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
