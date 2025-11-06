<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Purchase Requests' => route('purchase.requests'),
        ];
        if (request()->routeIs('purchase.requests.create')) {
            $links['Create Purchase Request'] = route('purchase.requests.create');
        } else {
            $links['Edit Purchase Request'] = route('purchase.requests.edit', $purchaseRequest->id);
        }
    @endphp
    <x-slot name="header">
        <x-breadcrumbs :links="$links" />
    </x-slot>

    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <h2 class="font-bold text-xl text-gray-700">
                        {{ request()->routeIs('purchase.requests.create') ? 'Create Purchase Request' : 'Edit Purchase Request' }}
                    </h2>

                    <div class="bg-blue-100 p-3 rounded-lg mt-3">
                        <p class="mb-2 font-semibold text-gray-800">
                            Please ensure the purchase request details are correct before submitting:
                            <li class="text-sm text-gray-700 mb-1 ml-4">Item names and descriptions are accurate and
                                complete</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Quantities and unit prices are verified</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Required delivery dates are clearly stated</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">All necessary approvals or justifications are
                                included</li>
                        </p>
                    </div>
                </div>

                <form
                    action="{{ request()->routeIs('purchase.requests.create') ? route('purchase.requests.store') : route('purchase.requests.update', encrypt($purchaseRequest->id)) }}"
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

                    <div class="p-4">
                        <button type="submit"
                            class="py-2 px-3 bg-blue-500 rounded-md text-sm text-white font-medium">{{ request()->routeIs('purchase.requests.create') ? 'Create Purchase Request' : 'Update Purchase Request' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
