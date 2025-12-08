<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Purchase Requests' => route('purchase.requests'),
        ];
        $links['Show Purchase Request'] = route('purchase.requests.show', $purchaseRequest->id);
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

                <div class="bg-white p-5 rounded-md">
                    <h1 class="mb-2 font-semibold text-lg text-gray-800">Add Purchase Request Item</h1>
                    <p class="text-sm text-gray-700 bg-blue-100 p-3 rounded-lg">
                        Add items required for this purchase request. Provide clear specifications and cost details to
                        assist in budgeting and procurement accuracy.
                    </p>
                </div>

                <div class="flex justify-between items-end bg-white p-5 rounded-md ">
                    <div>
                        @include('reusable_partials.search-form')
                    </div>
                    <div class="flex gap-3">
                        <p class="bg-blue-100 text-sm text-gray-600 font-medium p-2.5 rounded-md">Items in Cart : <span
                                class="text-white bg-red-500 p-1 text-xs px-2 rounded-full">{{ $totalCarts }}</span>
                        </p>
                        <p class="bg-blue-100 text-sm text-gray-600 font-medium p-2.5 rounded-md">Total Items : <span
                                class="text-white bg-blue-500 p-1 text-xs px-2 rounded-full">{{ $items->count() }}</span>
                        </p>

                    </div>
                </div>

                <!-- item Table -->

                <div class="overflow-x-auto bg-white p-5 rounded-md ">
                    <div class="flex justify-center items-center">
                        <div class="grid grid-cols-4 gap-5">
                            @forelse ($items as $item)
                                <div x-data="{ inCart: {{ in_array($item->id, $cartItems) ? 'true' : 'false' }} }"
                                    class="rounded-md overflow-hidden border border-gray-300 shadow-sm shadow-red-300 w-[320px] mb-5 p-1.5">
                                    <form
                                        action="{{ route('purchase.requests.cart.store', encrypt($purchaseRequest->id)) }}"
                                        method="POST">
                                        @csrf

                                        <img class="mb-5 h-[300px] w-full rounded-t-md"
                                            src="{{ asset('storage/' . $item->item_image) }}">

                                        <div class="mt-3 px-3">
                                            <div class="flex justify-between items-center">
                                                <h1 class="font-semibold text-md uppercase text-gray-700">
                                                    {{ Str::limit($item->item_name, 20, '...') }}
                                                </h1>
                                                <h1 class="font-semibold text-md uppercase text-gray-700">
                                                    ₱{{ $item->price }}</h1>
                                            </div>
                                            <p class="text-gray-500 font-medium">{{ $item->supplier->supplier_name }}
                                            </p>
                                        </div>

                                        <div class="flex justify-between items-end gap-2 px-3 mt-3 mb-1.5">
                                            <div class="grid">
                                                <input type="hidden" value="{{ $item->id }}" name="item_id">
                                                <input type="hidden" name="qty" value="{{ old('qty', 1) }}"
                                                    min="1"
                                                    class="w-[70px] py-1 pl-2 text-sm border border-red-200 rounded-md text-gray-600">
                                            </div>

                                            {{-- ADD TO CART BUTTON --}}
                                            <button type="submit" x-show="!inCart" x-transition
                                                class="text-white text-sm px-3 py-1 rounded-md bg-blue-600 no-underline hover:bg-blue-500 flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                </svg>
                                                Add to Cart
                                            </button>
                                    </form>
                                    {{-- CANCEL BUTTON --}}
                                    <form x-show="inCart"
                                        action="{{ route('purchase.requests.cart.destroy', encrypt($purchaseRequest->id)) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <button type="submit"
                                            class="text-white text-sm px-3 py-1 rounded-md bg-red-600 no-underline hover:bg-red-500 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                            </svg>
                                            Cancel
                                        </button>
                                    </form>
                                </div>

                        </div>
                    @empty
                        <p>No items available.</p>
                        @endforelse
                    </div>



                </div>


                {{-- checkout or edit cart --}}

                <div class="flex justify-end gap-3 m-5">
                    <a href="{{ route('purchase.requests.checkout.view', encrypt($purchaseRequest->id)) }}"
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-500">Go to
                        Checkout
                    </a>
                </div>
        </div>

        </section>


    </div>
</x-app-layout>
