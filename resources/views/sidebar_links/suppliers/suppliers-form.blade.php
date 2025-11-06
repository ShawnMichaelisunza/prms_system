<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Suppliers' => route('suppliers'),
        ];
        if (request()->routeIs('suppliers.create')) {
            $links['Create Supplier'] = route('suppliers.create');
        } else {
            $links['Edit Supplier'] = route('suppliers.edit', $supplier->id);
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
                        {{ request()->routeIs('suppliers.create') ? 'Create Supplier' : 'Edit Supplier' }}</h2>
                    <div class="bg-blue-100 p-3 rounded-lg mt-3">
                        <p class="mb-2 font-semibold text-gray-800"> Make sure you have accurate details ready:
                            <li class="text-sm text-gray-700 mb-1 ml-4">Legal name of the supplier (must
                                match business registration)</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Business address (head office +
                                branch if applicable)</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Contact details (phone, email,
                                website, contact person)</li>
                        </p>
                    </div>
                </div>

                <form
                    action="{{ request()->routeIs('suppliers.create') ? route('suppliers.store') : route('suppliers.update', encrypt($supplier->id)) }}"
                    method="post">
                    @csrf

                    @if (request()->routeIs('suppliers.edit'))
                        @method('put')
                    @endif

                    <div class="grid grid-cols-2 gap-3 p-4">
                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Supplier name <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="supplier_name" class="border border-red-200 rounded-md p-2"
                                value="{{ old('supplier_name', optional($supplier)->supplier_name) }}"
                                placeholder="Example..">
                            @error('supplier_name')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Supplier Type <span
                                    class="text-red-600">*</span></label>
                            <select name="supplier_type" id="" class="border border-red-200 rounded-md p-2">
                                <option value="" selected disabled>Select Type</option>
                                <option value="Electronics"
                                    {{ optional($supplier)->supplier_type == 'Electronics' ? 'selected' : '' }}>Electronics
                                </option>
                                <option value="Furniture"
                                    {{ optional($supplier)->supplier_type == 'Furniture' ? 'selected' : '' }}>Furniture</option>
                                <option value="Agriculture"
                                    {{ optional($supplier)->supplier_type == 'Agriculture' ? 'selected' : '' }}>Agriculture
                                </option>
                            </select>
                            @error('supplier_type')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Supplier Address <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="address" class="border border-red-200 rounded-md p-2"
                                value="{{ old('address', optional($supplier)->address) }}" placeholder="Address.....">
                            @error('address')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Supplier Contact <span
                                    class="text-red-600">*</span></label>
                            <input type="number" name="contact" class="border border-red-200 rounded-md p-2"
                                placeholder="09******" value="{{ old('contact', optional($supplier)->contact) }}">
                            @error('contact')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-4">
                        <button type="submit"
                            class="py-2 px-3 bg-blue-500 rounded-md text-sm text-white font-medium">{{ request()->routeIs('suppliers.create')
                                ? 'Create
                                                        Supplier'
                                : 'Update Supplier' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
