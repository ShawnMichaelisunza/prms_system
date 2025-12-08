<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Purchase Orders' => route('purchase.orders'),
        ];
        if (request()->routeIs('purchase.orders.create')) {
            $links['Create Purchase Order'] = route('purchase.orders.create', $purchaseRequest->id);
        } else {
            $links['Edit Purchase Order'] = route('purchase.orders.edit', $purchaseRequest->id);
        }
    @endphp
    <x-slot name="header">
        <x-breadcrumbs :links="$links" />
    </x-slot>

    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 grid gap-3">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <h2 class="font-bold text-xl text-gray-700">
                        {{ request()->routeIs('purchase.orders.create') ? 'Create Purchase Order' : 'Edit Purchase Order' }}
                    </h2>

                    {{-- <div class="bg-blue-100 p-3 rounded-lg mt-3">
                        <p class="mb-2 font-semibold text-gray-800">
                            Please ensure the purchase request details are correct before submitting:
                            <li class="text-sm text-gray-700 mb-1 ml-4">Item names and descriptions are accurate and
                                complete</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Quantities and unit prices are verified</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Required delivery dates are clearly stated</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">All necessary approvals or justifications are
                                included</li>
                        </p>
                    </div> --}}
                </div>

                <form
                    action="{{ request()->routeIs('purchase.orders.create') ? route('purchase.requests.store') : route('purchase.requests.update', encrypt($purchaseRequest->id)) }}"
                    method="post">
                    @csrf

                    @if (request()->routeIs('purchase.requests.edit'))
                        @method('put')
                    @endif

                    {{-- hidden input --}}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">

                    <div class="grid grid-cols-2 gap-3 p-4">
                        <div class="grid gap-1 col-span-2">
                            <label for="" class="text-md font-medium text-gray-600">Purpose / Reason <span
                                    class="text-red-600">*</span></label>
                            <textarea name="purpose" id="" cols="30" rows="2" class="border border-red-200 rounded-md p-2 ">{{ old('purpose', optional($purchaseRequest)->purpose) }} </textarea>
                            @error('purpose')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end p-4">
                        <button type="submit"
                            class="py-2 px-3 bg-blue-500 rounded-md text-sm text-white font-medium">{{ request()->routeIs('purchase.requests.create') ? 'Create Purchase Order' : 'Update Purchase Order' }}</button>
                    </div>
                </form>
            </div>
            {{--  --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    <h2 class="font-bold text-xl text-gray-700">
                        Purchase Requested Items
                    </h2>

                    <div class="p-3 mt-3">
                        <div>
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-red-100 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Item No.</th>
                                        <th class="py-3 px-6 text-left">Item name</th>
                                        <th class="py-3 px-6 text-left">Price</th>
                                        <th class="py-3 px-6 text-left">Requested QTY</th>
                                        <th class="py-3 px-6 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm bg-white">
                                    @forelse ($checkoutCartItems as $checkoutCartItem)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left">{{ $checkoutCartItem->item->id }}</td>
                                            <td class="py-3 px-6 text-left">{{ $checkoutCartItem->item->item_name }}</td>
                                            <td class="py-3 px-6 text-left">₱ {{ number_format($checkoutCartItem->item->price, 2) }}</td>
                                            <td class="py-3 px-6 text-left">{{ $checkoutCartItem->cart_requested_qty }}</td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex item-center justify-center">
                                                    {{-- show checkout --}}
                                                    @include('sidebar_links.purchase_orders.modals.confirm-delete-purchase-order-item')
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"
                                                class="text-center text-lg py-5 font-semibold text-gray-700">
                                                No Data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
