<x-app-layout>
    <x-slot name="header">
        <x-breadcrumbs :links="[
            'Dashboard' => route('dashboard'),
            'Items' => route('items'),
        ]">

        </x-breadcrumbs>
    </x-slot>

    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <section class="container grid gap-5 mx-auto px-4">

                <div class="bg-white p-5 rounded-md">
                    <h1 class="mb-2 font-semibold text-lg text-gray-800">Inventory Purchase Records</h1>
                    <p class="text-sm text-gray-700 bg-blue-100 p-3 rounded-lg">Track all incoming stock purchases,
                        monitor supplier performance, and ensure accurate inventory levels.</p>
                </div>

                <div class="flex justify-between items-end bg-white p-5 rounded-md ">
                    <div>
                        @include('reusable_partials.search-form')
                    </div>

                    <a href="{{ route('items.create') }}"
                        class="flex items-center gap-3 bg-red-500 text-sm text-white px-2.5 py-1.5 rounded-md hover:bg-red-600 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Item
                    </a>
                </div>
                <!-- suppplier Table -->

                <div class="overflow-x-auto bg-white p-5 rounded-md ">
                    <div class="flex justify-center items-center">
                        <div class="grid grid-cols-4 gap-5">
                            @forelse ($items as $item)
                                <div
                                    class="rounded-md overflow-hidden border border-gray-300 shadow-sm shadow-red-300 w-[320px] mb-5 p-1.5">
                                    <img class="mb-5 h-[300px] w-full rounded-t-md"
                                        src="{{ asset('storage/'. $item->item_image ) }}">
                                    <div class="mt-3 px-3">
                                        <div class="flex justify-between items-center">
                                            <h1 class="font-semibold text-md uppercase text-gray-700">
                                                {{ Str::limit($item->item_name, 20, '...') }}
                                            </h1>
                                            <h1 class="font-semibold text-md uppercase text-gray-700">₱
                                                {{ $item->price }}
                                            </h1>
                                        </div>
                                        <p class="text-gray-500 font-medium">{{ $item->supplier->supplier_name }}</p>
                                    </div>
                                    <div class="flex justify-between items-end gap-2 px-3 mt-3 mb-1.5">
                                        <div>
                                            <p class="text-xs text-gray-600">Created By:
                                                <span>{{ $item->user->name }}</span>
                                            </p>
                                        </div>
                                        <div class="flex gap-1.5">
                                            <a href="{{ route('items.edit', encrypt($item->id)) }}" class="text-blue-500 hover:underline underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-5">
                                                    <path
                                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                    <path
                                                        d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                                </svg>

                                            </a>

                                            @include('sidebar_links.items.modals.confirm-delete-items')
                                        </div>
                                    </div>
                                </div>
                            @empty
                                {{-- no data --}}
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>


        </div>
</x-app-layout>
