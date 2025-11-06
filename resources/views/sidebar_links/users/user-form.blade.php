<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Users' => route('users'),
        ];
        if (request()->routeIs('users.create')) {
            $links['Create User'] = route('users.create');
        } else {
            $links['Edit User'] = route('users.edit', $user->id);
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
                        {{ request()->routeIs('users.create') ? 'Create User' : 'Edit User' }}</h2>
                    <div class="bg-blue-100 p-3 rounded-lg mt-3">
                        <p class="mb-2 font-semibold text-gray-800"> Make sure you have accurate details ready:
                            <li class="text-sm text-gray-700 mb-1 ml-4">Legal name of the User (must
                                match business registration)</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Business address (head office +
                                branch if applicable)</li>
                            <li class="text-sm text-gray-700 mb-1 ml-4">Contact details (phone, email,
                                website, contact person)</li>
                        </p>
                    </div>
                </div>

                <form
                    action="{{ request()->routeIs('users.create') ? route('users.store') : route('users.update', encrypt($user->id)) }}"
                    method="post">
                    @csrf

                    @if (request()->routeIs('users.edit'))
                        @method('put')
                    @endif

                    <div class="grid grid-cols-2 gap-3 p-4">
                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Name <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="name" class="border border-red-200 rounded-md p-2"
                                value="{{ old('name', optional($user)->name) }}" placeholder="Example..">
                            @error('name')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Email <span
                                    class="text-red-600">*</span></label>
                            <input type="email" name="email" class="border border-red-200 rounded-md p-2"
                                value="{{ old('email', optional($user)->email) }}" placeholder="example@yahoo.com">
                            @error('email')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Password <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="password" class="border border-red-200 rounded-md p-2"
                                value="{{ old('password', optional($user)->password) }}" placeholder="******">
                            @error('password')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Confirm Password <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="password_confirmation"
                                class="border border-red-200 rounded-md p-2"
                                value="{{ old('password', optional($user)->password) }}" placeholder="Example..">
                            @error('password')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1 col-span-2">
                            <label for="" class="text-md font-medium text-gray-600">Organization<span
                                    class="text-red-600">*</span></label>
                            <select name="organization_id" id="" class="border border-red-200 rounded-md p-2">
                                <option value="" selected disabled>Select Type</option>
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}"
                                        {{  optional($user)->organization_id == $organization->id ? 'selected' : '' }}>
                                        {{ $organization->organization_name }}</option>
                                @endforeach
                            </select>
                            @error('organization_id')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-4">
                        <button type="submit"
                            class="py-2 px-3 bg-blue-500 rounded-md text-sm text-white font-medium">{{ request()->routeIs('users.create') ? 'Create User' : 'Update User' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
