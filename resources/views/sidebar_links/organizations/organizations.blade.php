<x-app-layout>
    <x-slot name="header">
        <x-breadcrumbs :links="[
            'Dashboard' => route('dashboard'),
            'Organizations' => route('organizations'),
        ]">

        </x-breadcrumbs>
    </x-slot>

    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <section class="container grid gap-5 mx-auto px-4">
                <div class="bg-white p-5 rounded-md">
                    <h1 class="mb-2 font-semibold text-lg text-gray-800">Organization Management</h1>
                    <p class="text-sm text-gray-700 bg-blue-100 p-3 rounded-lg">
                        Manage organization details, maintain records of acronyms, names, and addresses, and ensure
                        smooth administration for effective organizational operations.
                    </p>
                </div>


                <div class="flex justify-between items-end bg-white p-5 rounded-md">
                    <div>
                        @include('reusable_partials.search-form')
                    </div>

                    <a href="{{ route('organizations.create') }}"
                        class="flex items-center gap-3 bg-red-500 text-sm text-white px-2.5 py-1.5 rounded-md hover:bg-red-600 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Organization
                    </a>
                </div>
                <!-- suppplier Table -->

                <div class="overflow-x-auto bg-white p-5 rounded-md">
                    <div class="flex justify-center items-center">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-red-100 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Acronym</th>
                                    <th class="py-3 px-6 text-left">Fullname</th>
                                    <th class="py-3 px-6 text-left">Address</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @forelse ($organizations as $organization)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $organization->acronym }}</td>
                                        <td class="py-3 px-6 text-left">{{ $organization->organization_name }}</td>
                                        <td class="py-3 px-6 text-left">
                                            {{ Str::limit($organization->organization_address, 50, '...') }}
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">

                                                <a href="{{ route('organizations.edit', encrypt($organization->id)) }}"
                                                    class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>

                                                <div>
                                                   @include('sidebar_links.organizations.modals.confirm-delete-organization')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-md font-semibold text-gray-700">No
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
</x-app-layout>
