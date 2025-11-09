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

                <div class="overflow-x-auto p-5 rounded-md" x-data="tabComponent()" x-init="init()">
                    <div class="flex justify-start items-start">
                        <button @click="changeTab('purchase_request_all')"
                            class="px-4 py-2 rounded-t-md text-xs font-medium uppercase"
                            :class="tab === 'purchase_request_all' ? 'bg-white text-red-500' :
                                'bg-gray-50 border-white text-gray-700'">
                            All
                        </button>
                        <button @click="changeTab('purchase_request_pending')"
                            class="px-4 py-2 rounded-t-md text-xs font-medium uppercase"
                            :class="tab === 'purchase_request_pending' ?
                                'bg-white text-red-500' :
                                'bg-gray-50 border-white text-gray-700'">
                            Pending
                        </button>
                        <button @click="changeTab('purchase_request_completed')"
                            class="px-4 py-2 rounded-t-md text-xs font-medium uppercase"
                            :class="tab === 'purchase_request_completed' ?
                                'bg-white text-red-500' :
                                'bg-gray-50 border-white text-gray-700'">
                            Completed
                        </button>
                    </div>
                    <div class="border-0 rounded-b-md p-4 bg-white">


                        <div x-show="tab === 'purchase_request_all'" x-cloak>
                            @include('sidebar_links.purchase_requests.partials.purchase-request-pending-table')
                        </div>
                        <div x-show="tab === 'purchase_request_pending'" x-cloak>
                            @include('sidebar_links.purchase_requests.partials.purchase-request-all-table')
                        </div>
                        <div x-show="tab === 'purchase_request_completed'" x-cloak>
                            @include('sidebar_links.purchase_requests.partials.purchase-request-completed-table')
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>

    {{-- script for no hold page in group tab --}}
    <script>
        function tabComponent() {
            return {
                tab: 'activity_focused', // Default tab

                init() {
                    const saved = localStorage.getItem('taskTabs');
                    if (saved) {
                        this.tab = saved;
                    }
                },

                changeTab(newTab) {
                    this.tab = newTab;
                    localStorage.setItem('taskTabs', newTab);
                }
            }
        }
    </script>
</x-app-layout>
