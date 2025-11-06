<x-app-layout>
    <x-slot name="header">
        <x-breadcrumbs :links="[
            'Dashboard' => route('dashboard'),
            'Purchase Request' => route('purchase.requests'),
        ]">

        </x-breadcrumbs>
    </x-slot>

    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <section class="container grid gap-5 mx-auto px-4">
                <div class="bg-white p-5 rounded-md">
                    <h1 class="mb-2 font-semibold text-lg text-gray-800">Purchase Request</h1>
                    <p class="text-sm text-gray-700 bg-blue-100 p-3 rounded-lg">
                        Create, manage, and track purchase requests to ensure timely procurement of goods and services.
                        Streamline approval workflows and maintain transparency in purchasing operations.
                    </p>
                </div>

                <div class="flex justify-between items-end bg-white p-5 rounded-md">
                    <div>
                        @include('reusable_partials.search-form')
                    </div>

                    <a href="{{ route('purchase.requests.create') }}"
                        class="flex items-center gap-3 bg-red-500 text-sm text-white px-2.5 py-1.5 rounded-md hover:bg-red-600 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Request
                    </a>
                </div>
                <!-- suppplier Table -->

                <div class="overflow-x-auto bg-white p-5 rounded-md">
                    <div class="flex justify-center items-center">
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
                            <tbody class="text-gray-600 text-sm">
                                @forelse ($purchaseRequests as $purchaseRequest)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $purchaseRequest->user->name }}</td>
                                        <td class="py-3 px-6 text-left">
                                            {{ Str::limit($purchaseRequest->purpose, 40, '...') }}</td>
                                        <td class="py-3 px-6 text-left">{{ $purchaseRequest->pr_no }}</td>
                                        <td class="py-3 px-6 text-left">{{ $purchaseRequest->po_no }}</td>
                                        <td class="py-3 px-6 text-left">{{ $purchaseRequest->rr_no }}</td>
                                        <td class="py-3 px-6 text-left">{{ $purchaseRequest->pr_status }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">

                                                <a href="{{ route('purchase.requests.show', encrypt($purchaseRequest->id)) }}"
                                                    class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                                    </svg>

                                                </a>

                                                <a href="{{ route('purchase.requests.edit', encrypt($purchaseRequest->id)) }}"
                                                    class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>

                                                <div>
                                                    @include('sidebar_links.purchase_requests.modals.confirm-delete-purchase-request')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-lg py-5 font-semibold text-gray-700">
                                            No
                                            Data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>


        </div>
    </div>
</x-app-layout>
