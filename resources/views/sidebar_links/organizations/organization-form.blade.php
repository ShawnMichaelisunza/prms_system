<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Organizations' => route('organizations'),
        ];
        if (request()->routeIs('organizations.create')) {
            $links['Create Organization'] = route('organizations.create');
        } else {
            $links['Edit Organization'] = route('organizations.edit', $organization->id);
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
                        {{ request()->routeIs('organizations.create') ? 'Create Organization' : 'Edit Organization' }}
                    </h2>
                    <div class="bg-blue-100 p-3 rounded-lg mt-3">
                        <p class="mb-2 font-semibold text-gray-800"> Please ensure the organization details are correct
                            before submitting:
                            <li class="text-sm text-gray-700 mb-1 ml-4">Official name of the organization (as registered
                                legally)</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Head office and branch addresses (if applicable)
                            </li>
                        </p>
                    </div>
                </div>

                <form
                    action="{{ request()->routeIs('organizations.create') ? route('organizations.store') : route('organizations.update', encrypt($organization->id)) }}"
                    method="post">
                    @csrf

                    @if (request()->routeIs('organizations.edit'))
                        @method('put')
                    @endif

                    <div class="grid grid-cols-2 gap-3 p-4">
                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Organization Acronym <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="acronym" class="border border-red-200 rounded-md p-2"
                                value="{{ old('acronym', optional($organization)->acronym) }}" placeholder="Example..">
                            @error('acronym')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Organization Name <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="organization_name" class="border border-red-200 rounded-md p-2"
                                value="{{ old('organization_name', optional($organization)->organization_name) }}"
                                placeholder="organization_name.....">
                            @error('organization_name')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid gap-1 col-span-2">
                            <label for="" class="text-md font-medium text-gray-600">Organization Address <span
                                    class="text-red-600">*</span></label>
                            <textarea name="organization_address" id="" cols="30" rows="2"
                                class="border border-red-200 rounded-md p-2 ">{{ old('organization_address', optional($organization)->organization_address) }} </textarea>
                            @error('organization_address')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-4">
                        <button type="submit"
                            class="py-2 px-3 bg-blue-500 rounded-md text-sm text-white font-medium">{{ request()->routeIs('organizations.create') ? 'Create Organization' : 'Update Organization' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
