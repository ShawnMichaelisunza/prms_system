<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Purchase Requests' => route('purchase.requests'),
            'Show Purchase Requests' => route('purchase.requests.show', encrypt($purchaseRequest->id)),
        ];
        $links['Items Summary'] = route('purchase.requests.checkout.view', encrypt($purchaseRequest->id));
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
                    <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Information Summary</h1>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-gray-700 dark:text-gray-300">
                        <div class="p-3 bg-blue-100 dark:bg-gray-700/50 rounded-md">
                            <p class="font-medium text-gray-600 dark:text-gray-400">Created By</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ $purchaseRequest->user->name }}</p>
                        </div>

                        <div class="p-3 bg-blue-100 dark:bg-gray-700/50 rounded-md">
                            <p class="font-medium text-gray-600 dark:text-gray-400">Organization</p>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ $purchaseRequest->organization->organization_name }}</p>
                        </div>

                        <div class="p-3 bg-blue-100 dark:bg-gray-700/50 rounded-md">
                            <p class="font-medium text-gray-600 dark:text-gray-400">Purchase Request No</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ $purchaseRequest->pr_no }}</p>
                        </div>

                        <div class="sm:col-span-2 lg:col-span-3 p-3 bg-blue-100 dark:bg-gray-700/50 rounded-md">
                            <p class="font-medium text-gray-600 dark:text-gray-400">Purpose</p>
                            <p class="text-gray-900 dark:text-gray-100">{{ $purchaseRequest->purpose }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-end bg-white p-5 rounded-md ">
                    <div>
                        @include('reusable_partials.search-form')
                    </div>
                    <div class="flex gap-3">
                        <p class="bg-blue-100 text-sm text-gray-600 font-medium p-2.5 rounded-md">Items in Cart : <span
                                class="text-white bg-red-500 p-1 text-xs px-2 rounded-full">{{ $totalCarts }}</span>
                        </p>

                    </div>
                </div>

                <!-- item Table -->

                <div class="overflow-x-auto bg-white rounded-md ">
                    <form action="{{ route('purchase.requests.checkout.store', encrypt($purchaseRequest->id)) }}"
                        method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-1 p-5 overflow-y-auto h-[350px]">
                            @forelse ($cartItems as $cartItem)
                                <div
                                    class="flex justify-between gap-3 bg-gray-100 shadow-md shadow-red-100 p-1.5 rounded-md h-[135px]">
                                    <div class="w-3/12">
                                        <img src="{{ asset('storage/' . $cartItem->item->item_image) }}" alt=""
                                            class="h-[120px] w-[150px] rounded-l-md">
                                    </div>

                                    <div class="grid gap-1.5 w-full">
                                        <p class="text-sm font-medium text-gray-800">
                                            Item name: <span
                                                class="text-gray-700">{{ $cartItem->item->item_name }}</span>
                                        </p>
                                        <p class="text-sm font-medium text-gray-800">
                                            Type UOM: <span class="text-gray-700">{{ $cartItem->item->item_uom }}</span>
                                        </p>
                                        <p class="text-sm font-medium text-gray-800">
                                            Price: <span class="text-gray-700">₱{{ $cartItem->item->price }}</span>
                                        </p>
                                        <p class="text-sm font-medium text-gray-800">
                                            Supplier: <span
                                                class="text-gray-700">{{ $cartItem->item->supplier->supplier_name }}</span>
                                        </p>
                                    </div>

                                    <div class="px-2 w-full flex justify-end">
                                        <div class="grid gap-5 justify-between p-1">
                                            <div class="flex justify-end">
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </div>

                                            {{-- Quantity Controls --}}
                                            <div class="flex items-center gap-2 justify-center">
                                                <div class="flex items-center space-x-1"
                                                    data-number="{{ $cartItem->qty }}">
                                                    <button type="button"
                                                        class="btn-dec px-3 py-1 bg-red-400 hover:bg-red-500 text-white rounded">-</button>

                                                    {{-- hidden Inputs --}}
                                                    <input type="hidden" name="cart_item_id[]"
                                                        value="{{ $cartItem->item->id }}">
                                                    <input type="hidden" name="cart_item_cost[]"
                                                        value="{{ $cartItem->item->price }}">

                                                    <input type="text" name="cart_requested_qty[]"
                                                        class="qty w-9 text-center border border-gray-300 rounded text-xs"
                                                        readonly>

                                                    <button
                                                        type="button"class="btn-inc px-3 py-1 bg-green-400 hover:bg-green-500 text-white rounded">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center m-auto text-[30px] text-gray-500">No Item List</p>
                            @endforelse
                        </div>

                        {{-- Checkout Button --}}
                        <div class="flex justify-end gap-3 mx-5 mt-7 mb-5">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-500">
                                Checkout
                            </button>
                        </div>
                    </form>
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
