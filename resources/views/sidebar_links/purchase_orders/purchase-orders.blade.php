<x-app-layout>
    <x-slot name="header">
        <x-breadcrumbs :links="[
            'Dashboard' => route('dashboard'),
            'Purchase Order' => route('purchase.orders'),
        ]">

        </x-breadcrumbs>
    </x-slot>

    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <section class="container grid gap-5 mx-auto px-4">
                <div class="bg-white p-5 rounded-md">
                    <h1 class="mb-2 font-semibold text-lg text-gray-800">Purchase Order</h1>
                    <p class="text-sm text-gray-700 bg-blue-100 p-3 rounded-lg">
                        Create, manage, and track purchase requests to ensure timely procurement of goods and services.
                        Streamline approval workflows and maintain transparency in purchasing operations.
                    </p>
                </div>

                <div class="flex justify-between items-end bg-white p-5 rounded-md">
                    <div>
                        @include('reusable_partials.search-form')
                    </div>
                </div>
                <!-- suppplier Table -->

                <div class="overflow-x-auto p-5 rounded-md" x-data="tabComponent()" x-init="init()">
                    <div class="flex justify-start items-start">
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
                        <div x-show="tab === 'purchase_request_pending'" x-cloak>
                            @include('sidebar_links.purchase_orders.partials.purchase-orders-pending-table')
                        </div>
                        <div x-show="tab === 'purchase_request_completed'" x-cloak>
                            @include('sidebar_links.purchase_orders.partials.purchase-orders-completed-table')
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
                tab: 'purchase_request_pending', // Default tab

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
