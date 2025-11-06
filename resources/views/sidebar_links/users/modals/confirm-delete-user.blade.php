<button onclick="document.getElementById('confirmSupplierDelete{{ $user->id }}').showModal()" type="button" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
</button>


<dialog id="confirmSupplierDelete{{ $user->id }}" class="p-6 bg-white rounded-lg shadow-xl border border-gray-300">
    <form action="{{ route('users.destroy', encrypt($user->id)) }}" method="POST">
        @method('DELETE')
        @csrf

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Delete Confirmation
            </h2>
            <button onclick="document.getElementById('confirmSupplierDelete{{ $user->id }}').close()" type="button"
                class="text-gray-400 hover:text-gray-700 text-3xl font-bold leading-none focus:outline-none">&times;</button>
        </div>

        <div class="mb-6 text-gray-700 text-sm">
            Are you sure you want to delete suppplier <span class="font-semibold">{{ $user->name }}</span> ? </br> This
            action cannot be undone.
        </div>

        <div class="flex justify-end gap-3">
            <button onclick="document.getElementById('confirmSupplierDelete{{ $user->id }}').close()"
                type="button"
                class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                Cancel
            </button>
            <button type="submit"
                class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition flex items-center gap-2">
                Yes, Delete
            </button>
        </div>
    </form>
</dialog>
