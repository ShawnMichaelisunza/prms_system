<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Purchase Orders' => route('purchase.orders'),
        ];
        if (request()->routeIs('purchase.orders.create')) {
            $links['Create Purchase Order'] = route('purchase.orders.create', $purchaseRequest->id);
        } else {
            $links['Edit Purchase Order'] = route('purchase.orders.edit', $purchaseOrder->id);
        }

        $grandTotal = $checkoutCartItems->sum('total_costs');
    @endphp
    <x-slot name="header">
        <x-breadcrumbs :links="$links" />
    </x-slot>

    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 grid gap-3">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <h2 class="font-bold text-xl text-gray-700">
                        {{ request()->routeIs('purchase.orders.create') ? 'Create Purchase Order' : 'Edit Purchase Order' }}
                    </h2>

                    <a href="{{ route('purchase.orders.pdf', encrypt($purchaseOrder->id)) }}" target="__blank"
                        class="text-white bg-blue-500 hover:bg-blue-400 p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                        </svg>
                    </a>

                </div>

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

                <form
                    action="{{ request()->routeIs('purchase.orders.create')
                        ? route('purchase.orders.store', encrypt($purchaseRequest->id))
                        : route('purchase.orders.update', encrypt($purchaseOrder->id)) }}"
                    method="post">
                    @csrf

                    @if (request()->routeIs('purchase.orders.edit'))
                        @method('put')
                    @endif

                    {{-- hidden input --}}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="purchase_request_id"
                        value="{{ request()->routeIs('purchase.orders.create', encrypt($purchaseRequest->id) ? $purchaseRequest->id : $purchaseOrder->purchase_request_id) }}">

                    <div class="grid grid-cols-3 gap-3 p-4" x-data="poCalculator({{ $grandTotal }})">

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Deliver To <span
                                    class="text-red-600">*</span></label>
                            <textarea name="deliver_to" id="" cols="30" rows="1" class="border border-red-200 rounded-md p-2 ">{{ old('deliver_to', optional($purchaseRequest)->user->organization->organization_name) }} </textarea>
                            @error('deliver_to')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Payment <span
                                    class="text-red-600">*</span></label>
                            <textarea name="payment_mode" id="" cols="30" rows="1"
                                class="border border-red-200 rounded-md p-2 ">{{ old('payment_mode', optional($purchaseOrder)->payment_mode) }} </textarea>
                            @error('payment_mode')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600"> Payee <span
                                    class="text-red-600">*</span></label>
                            <textarea name="payee" id="" cols="30" rows="1" class="border border-red-200 rounded-md p-2 ">{{ old('payee', optional($purchaseOrder)->payee) }} </textarea>
                            @error('payee')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Trade <span
                                    class="text-red-600">*</span></label>
                            <div x-data="searchBox('{{ old('trade', optional($purchaseOrder)->trade) }}')" class="relative w-full mx-auto">
                                <!-- Search Input -->
                                <input type="text" name="trade" x-model="query" @focus="open = true"
                                    @click.away="open = false" placeholder="Search..."
                                    class="border border-red-200 rounded-md p-2 w-full">

                                <!-- Dropdown -->
                                <div x-show="open" x-transition
                                    class="absolute left-0 right-0 top-8 bg-white shadow-lg rounded-b-xl mt-2 border-t-0 z-50">
                                    <template x-if="filtered.length === 0">
                                        <div class="p-3 text-sm text-gray-500">No results found...</div>
                                    </template>

                                    <div class="max-h-40 overflow-y-auto">
                                        <template x-for="item in filtered" :key="item">
                                            <div @click="select(item)"
                                                class="p-3 text-gray-700 hover:bg-gray-100 cursor-pointer flex items-center gap-2">
                                                <span class="text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                                    </svg>
                                                </span>
                                                <span x-text="item"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            @error('trade')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600"> Ship fee</label>
                            <input type="number" name="ship_fee" class="border border-red-200 rounded-md p-2 "
                                value="" placeholder="0.00" x-model.number="ship_fee">
                            @error('ship_fee')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600"> Other Cost </label>
                            <input type="number" name="other_cost" class="border border-red-200 rounded-md p-2 "
                                value="" placeholder="0.00" x-model.number="other_cost">
                            @error('other_cost')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600"> Discount </label>
                            <input type="number" name="discount" class="border border-red-200 rounded-md p-2 "
                                value="" placeholder="0.00" x-model.number="discount">
                            @error('discount')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1 col-span-2">
                            <label for="" class="text-md font-medium text-gray-600"> Total Cost </label>
                            <input type="number" readonly name="total_price"
                                class="border border-red-200 bg-gray-100 rounded-md p-2 "
                                value="{{ number_format($grandTotal, 2) }}" :value="totalPrice.toFixed(2)">
                            @error('total_price')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1 col-span-3">
                            <label for="" class="text-md font-medium text-gray-600"> Remarks</label>
                            <textarea name="remarks" id="" cols="30" rows="3"
                                class="border border-red-200 rounded-md p-2 ">{{ old('remarks', optional($purchaseOrder)->remarks) }}</textarea>
                            @error('remarks')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end p-4">
                        <button type="submit"
                            class="py-2 px-3 bg-blue-500 rounded-md text-sm text-white font-medium">{{ request()->routeIs('purchase.orders.create') ? 'Create Purchase Order' : 'Update Purchase Order' }}</button>
                    </div>
                </form>
            </div>

            {{-- purchase requested items --}}

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
                                            <td class="py-3 px-6 text-left">{{ $checkoutCartItem->item->item_name }}
                                            </td>
                                            <td class="py-3 px-6 text-left">₱
                                                {{ number_format($checkoutCartItem->item->price, 2) }}</td>
                                            <td class="py-3 px-6 text-left">
                                                {{ $checkoutCartItem->cart_requested_qty }}
                                            </td>
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

    <script>
        // search trade
        function searchBox(defaultValue = '') {
            return {
                open: false,
                query: defaultValue,
                // Sample data (you can replace with DB results)
                items: @json($suppliers->pluck('supplier_name')),

                get filtered() {
                    if (!this.query) return this.items;
                    return this.items.filter(i =>
                        i.toLowerCase().includes(this.query.toLowerCase())
                    );
                },

                select(value) {
                    this.query = value;
                    this.open = false;
                }
            };
        }

        // compute total
        function poCalculator(grandTotal) {
            return {
                grand_total: grandTotal,

                // Initialize values from old form or purchase order
                ship_fee: {{ old('ship_fee', optional($purchaseOrder)->ship_fee ?? 0) }},
                other_cost: {{ old('other_cost', optional($purchaseOrder)->other_cost ?? 0) }},
                discount: {{ old('discount', optional($purchaseOrder)->discount ?? 0) }}, // as %

                get totalPrice() {
                    let subtotal = this.grand_total + (this.ship_fee || 0) + (this.other_cost || 0);
                    let discountAmount = (subtotal * (this.discount || 0)) / 100; // discount %
                    return subtotal - discountAmount;
                }
            }
        }
    </script>
</x-app-layout>
