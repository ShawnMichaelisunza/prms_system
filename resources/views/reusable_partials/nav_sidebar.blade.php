@php

    use App\Models\Item;
    use App\Models\Supplier;
    use App\Models\User;
    use App\Models\Organization;
    use App\Models\PurchaseRequest;
    use App\Models\PurchaseOrder;

    $suppliers = Supplier::count();
    $items = Item::count();
    $users = User::count();
    $organizations = Organization::count();
    $purchaseRequests = PurchaseRequest::count();
    $purchaseOrders = PurchaseOrder::count();
@endphp

<div class="w-72 bg-gray-50 h-screen p-4 flex flex-col">

    <!-- Compose Button -->
    <a class="bg-red-100 hover:bg-red-200 text-red-800 font-medium py-2 px-4 rounded-full w-full text-left mb-4 flex items-center space-x-2"
        :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <span>Dashboard</span>
    </a>

    <!-- Menu Items -->
    <nav class="flex-1">
        <ul class="space-y-1">
            {{-- <li class="bg-red-100 text-red-900 font-semibold rounded-md px-3 py-2 flex justify-between">
                <span>Inbox</span>
                <span class="bg-red-200 text-red-900 px-2 py-0.5 text-xs rounded-full">5,396</span>
            </li> --}}

            <h1 class=" text-sm px-3 py-2 text-red-600">Procurement Cycle</h1>

            <li
                class="hover:bg-red-200 rounded-md px-3 py-2 {{ request()->routeIs('purchase.requests') || request()->routeIs('purchase.requests.create') || request()->routeIs('purchase.requests.show') ? 'bg-red-200' : '' }}">
                <a href="{{ route('purchase.requests') }}" class="flex justify-between items-center text-sm">
                    <span class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                        Purchase Request
                    </span>
                    @if ($purchaseRequests)
                        <span class="text-gray-700 text-sm">{{ $purchaseRequests }}</span>
                    @endif
                </a>
            </li>

            <li
                class="hover:bg-red-200 rounded-md px-3 py-2 {{ request()->routeIs('purchase.orders') || request()->routeIs('purchase.orders.create') ? 'bg-red-200' : '' }}">
                <a href="{{ route('purchase.orders') }}" class="flex justify-between items-center text-sm">
                    <span class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>

                        Purchase Order
                    </span>
                    @if ($purchaseOrders)
                        <span class="text-gray-700 text-sm">{{ $purchaseOrders }}</span>
                    @endif
                </a>
            </li>

            <li
                class="hover:bg-red-200 rounded-md px-3 py-2 {{ request()->routeIs('suppliers') || request()->routeIs('suppliers.create') ? 'bg-red-200' : '' }}">
                <a href="{{ route('suppliers') }}" class="flex justify-between items-center text-sm">
                    <span class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>

                        Suppliers
                    </span>
                    @if ($suppliers)
                        <span class="text-gray-700 text-sm">{{ $suppliers }}</span>
                    @endif
                </a>
            </li>

            <h1 class=" text-sm px-3 py-2 text-red-600">Actions</h1>

            <li
                class="hover:bg-red-200 rounded-md px-3 py-2  {{ request()->routeIs('items') || request()->routeIs('items.create') ? 'bg-red-200' : '' }}">
                <a href="{{ route('items') }}" class="flex justify-between items-center text-sm">
                    <span class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                        Items
                    </span>
                    @if ($items)
                        <span class="text-gray-700 text-sm">{{ $items }}</span>
                    @endif
                </a>
            </li>

            <li
                class="hover:bg-red-200 rounded-md px-3 py-2 {{ request()->routeIs('suppliers') || request()->routeIs('suppliers.create') ? 'bg-red-200' : '' }}">
                <a href="{{ route('suppliers') }}" class="flex justify-between items-center text-sm">
                    <span class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>

                        Suppliers
                    </span>
                    @if ($suppliers)
                        <span class="text-gray-700 text-sm">{{ $suppliers }}</span>
                    @endif
                </a>
            </li>

            <h1 class=" text-sm px-3 py-2 text-red-600">Libraries</h1>

            <li
                class="hover:bg-red-200 rounded-md px-3 py-2  {{ request()->routeIs('users') || request()->routeIs('users.create') ? 'bg-red-200' : '' }}">
                <a href="{{ route('users') }}" class="flex justify-between items-center text-sm">
                    <span class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>

                        Users
                    </span>
                    @if ($users)
                        <span class="text-gray-700 text-sm">{{ $users }}</span>
                    @endif
                </a>
            </li>

            <li
                class="hover:bg-red-200 rounded-md px-3 py-2 {{ request()->routeIs('suppliers') || request()->routeIs('suppliers.create') ? 'bg-red-200' : '' }}">
                <a href="{{ route('suppliers') }}" class="flex justify-between items-center text-sm">
                    <span class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                        </svg>

                        Roles
                    </span>
                    @if ($suppliers)
                        <span class="text-gray-700 text-sm">{{ $suppliers }}</span>
                    @endif
                </a>
            </li>

            <li
                class="hover:bg-red-200 rounded-md px-3 py-2 {{ request()->routeIs('organizations') || request()->routeIs('organizations.create') ? 'bg-red-200' : '' }}">
                <a href="{{ route('organizations') }}" class="flex justify-between items-center text-sm">
                    <span class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>

                        Organizations
                    </span>
                    @if ($organizations)
                        <span class="text-gray-700 text-sm">{{ $organizations }}</span>
                    @endif
                </a>
            </li>


            {{-- <li class="hover:bg-gray-100 rounded-md px-3 py-2 flex justify-between">
                <span>Drafts</span>
                <span class="text-gray-500 text-sm">31</span>
            </li>
            <li class="hover:bg-gray-100 rounded-md px-3 py-2 flex justify-between">
                <span>Purchases</span>
                <span class="text-gray-500 text-sm">88</span>
            </li> --}}
        </ul>
    </nav>

    <!-- Labels -->
    <div class="mt-6">
        <div class="flex items-center justify-between text-gray-600 text-sm font-medium mb-2">
            <span>Labels</span>
            <button class="hover:text-gray-800">+</button>
        </div>
    </div>
</div>
