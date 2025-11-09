<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Purchase Requests' => route('purchase.requests'),
            'Show Purchase Requests' => route('purchase.requests.show', encrypt($PurchaseRequestCheckout->id)),
        ];
        $links['Checkout'] = route('purchase.requests.checkout.show', encrypt($PurchaseRequestCheckout->id));
    @endphp
    <x-slot name="header">
        <x-breadcrumbs :links="$links" />
    </x-slot>

    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <section class="container grid gap-5 mx-auto px-4">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <strong>Whoops! Something went wrong:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-white p-5 rounded-md">
                    <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Complete Your Purchase</h1>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-gray-700 dark:text-gray-300">
                        <div class="p-3 bg-blue-100 dark:bg-gray-700/50 rounded-md">
                            <p class="font-medium text-gray-600 dark:text-gray-400">Created By</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ $PurchaseRequestCheckout->user->name }}</p>
                        </div>

                        <div class="p-3 bg-blue-100 dark:bg-gray-700/50 rounded-md">
                            <p class="font-medium text-gray-600 dark:text-gray-400">Organization</p>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ $PurchaseRequestCheckout->organization->organization_name }}</p>
                        </div>

                        <div class="p-3 bg-blue-100 dark:bg-gray-700/50 rounded-md">
                            <p class="font-medium text-gray-600 dark:text-gray-400">Purchase Request No</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ $PurchaseRequestCheckout->pr_no }}</p>
                        </div>

                        <div class="sm:col-span-2 lg:col-span-3 p-3 bg-blue-100 dark:bg-gray-700/50 rounded-md">
                            <p class="font-medium text-gray-600 dark:text-gray-400">Purpose</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ $PurchaseRequestCheckout->purpose }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-end bg-white p-5 rounded-md ">
                    <div>
                        @include('reusable_partials.search-form')
                    </div>
                    <div class="flex gap-3">
                        <p class="bg-blue-100 text-sm text-gray-600 font-medium p-2.5 rounded-md">Items in Cart : <span
                                class="text-white bg-red-500 p-1 text-xs px-2 rounded-full">{{ $totalcheckoutItems }}</span>
                        </p>

                    </div>
                </div>

                <!-- item Table -->

                <div class="overflow-x-auto bg-white rounded-md ">

                    <div class="grid grid-cols-1 gap-3 p-5 overflow-y-auto h-[350px]">
                        @forelse ($checkoutCartItems as $checkoutCartItem)
                            <div
                                class="flex justify-between gap-3 bg-gray-100 shadow-md shadow-red-100 p-1.5 rounded-md">
                                <div class="w-3/12">
                                    <img src="{{ asset('storage/' . $checkoutCartItem->item->item_image) }}"
                                        alt="" class="h-[120px] w-[150px] rounded-l-md">
                                </div>

                                <div class="grid gap-1.5 w-full">
                                    <p class="text-sm font-medium text-gray-800">
                                        Item name: <span
                                            class="text-gray-700">{{ $checkoutCartItem->item->item_name }}</span>
                                    </p>
                                    <p class="text-sm font-medium text-gray-800">
                                        Type UOM: <span
                                            class="text-gray-700">{{ $checkoutCartItem->item->item_uom }}</span>
                                    </p>
                                    <p class="text-sm font-medium text-gray-800">
                                        Price: <span class="text-gray-700">₱{{ $checkoutCartItem->item->price }}</span>
                                    </p>
                                    <p class="text-sm font-medium text-gray-800">
                                        Supplier: <span
                                            class="text-gray-700">{{ $checkoutCartItem->item->supplier->supplier_name }}</span>
                                    </p>
                                </div>

                                <div class="px-2 w-full flex justify-end">
                                    <div class="grid gap-5 items-end p-1">
                                        {{-- Quantity Controls --}}
                                        <p class="font-semibold text-md">{{ $checkoutCartItem->cart_requested_qty }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center m-auto text-[30px] text-gray-500">No Item List</p>
                        @endforelse
                    </div>
                </div>

            </section>
        </div>

    </div>

    {{-- JS to make + / - buttons work --}}
    <script>
        document.querySelectorAll('[data-number]').forEach(wrapper => {
            let number = parseInt(wrapper.dataset.number);
            const input = wrapper.querySelector('.qty');
            const dec = wrapper.querySelector('.btn-dec');
            const inc = wrapper.querySelector('.btn-inc');

            // Initialize display
            input.value = number;

            // Decrease
            dec.addEventListener('click', () => {
                if (number > 0) number--;
                input.value = number;
            });

            // Increase
            inc.addEventListener('click', () => {
                number++;
                input.value = number;
            });
        });
    </script>
</x-app-layout>
