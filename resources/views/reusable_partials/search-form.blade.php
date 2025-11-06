<div class="flex gap-1 items-end ">

    <div class="grid grid-cols-2 gap-1">
        <div class="grid">
            <label class="text-xs font-medium text-gray-600">Start Date</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}"
                class="border border-red-200 py-1.5 text-sm px-3 rounded-l-lg">
        </div>
        <div class="grid">
            <label class="text-xs font-medium text-gray-600">End Date</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}"
                class="border border-red-200 py-1.5 text-sm px-3 ">
        </div>
    </div>

    <div>
        <input type="text" class="border border-red-200 py-1.5 px-3 rounded-r-lg text-sm w-[250px]"
            placeholder="Search....">
    </div>

</div>


{{-- <div x-data="{
    files: [],
    resetInput() {
        this.$refs.fileInput.value = null;
    }
}" class="space-y-3">

    <!-- File Input -->
    <input type="file" multiple x-ref="fileInput" @change="files = [...$event.target.files]" name="attachments[]"
        class="block w-[300px] border border-gray-300 rounded-md px-3 py-1.5 text-sm text-gray-700 focus:ring-1 focus:ring-indigo-500
                                file:mr-3 file:px-3 file:py-1 file:rounded-md file:border-0 file:text-sm file:bg-gray-100 file:text-gray-700" />

    <!-- File List -->
    <template x-if="files.length">
        <ul class="mt-2 space-y-1 text-sm text-gray-700">
            <template x-for="(file, index) in files" :key="file.name + index">
                <li class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded px-3 py-1.5">
                    <!-- Remove Button on Left -->
                    <button type="button" @click="files.splice(index, 1); if (files.length === 0) resetInput();"
                        class="text-gray-500 hover:text-red-600 hover:bg-red-50 rounded p-1 transition" title="Remove">
                        ✕
                    </button>
                    <!-- File Name -->
                    <span class="text-sm" x-text="file.name"></span>
                </li>
            </template>
        </ul>
    </template>

    <ul class="mt-1 space-y-1 text-sm text-gray-600">
        @foreach ($requestDetail->attachments as $attachment)
            <li id="attachment-{{ $attachment->id }}"
                class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded px-3 py-1.5">

                <!-- File Link -->
                <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank"
                    class="flex items-center gap-2 text-sm text-blue-500 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                </a>

                <button hx-post="{{ route('manageRequest.destroy', $attachment->id) }}" hx-vals='{"_method": "DELETE"}'
                    hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}' hx-target="#app" hx-swap="outerHTML"
                    hx-confirm="Are you sure you want to remove this attachment?"
                    class="ml-auto text-gray-500 hover:text-red-600 hover:bg-red-50 rounded transition"
                    title="Remove Item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </li>
        @endforeach
    </ul>

</div> --}}


{{-- <div x-data="{
    imageUrl: '{{ old('image')
        ? asset('storage/' . old('image'))
        : (isset($product) && $product->image
            ? asset('storage/' . $product->image)
            : 'https://placehold.co/340x250?text=Image') }}',
    fileName: '',
    fileInput: null,
    triggerUpload() {
        this.fileInput.click();
    },
    updatePreview(event) {
        const file = event.target.files[0];
        if (file) {
            this.imageUrl = URL.createObjectURL(file);
            this.fileName = file.name;
        }
    },
    removeImage() {
        this.imageUrl = 'https://placehold.co/340x250?text=Image';
        this.fileName = '';
        this.fileInput.value = '';
    }
}" x-init="fileInput = $refs.imageInput" class="relative"> <!-- Hidden File Input -->
    <input type="file" name="image" accept="image/*" class="hidden" x-ref="imageInput" @change="updatePreview">

    <!-- Image Preview -->
    <div @click="triggerUpload" class="cursor-pointer relative">
        <img :src="imageUrl"
            class="w-32 h-32 object-cover rounded-md border border-gray-300 shadow-sm hover:opacity-90 transition"
            alt="Image Preview">

        <!-- Remove Button -->
        <template x-if="fileName">
            <button type="button" @click.stop="removeImage"
                class="absolute top-2 left-2 bg-white/80 hover:bg-white text-red-800 rounded-full p-1 shadow"
                title="Remove image">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
        </template>

        <!-- File Name Centered at Bottom -->
        <template x-if="fileName">
            <p
                class="absolute bottom-1 left-1/2 -translate-x-1/2 max-w-[110px] px-1 truncate text-xs text-white bg-black/50 rounded">
                <span x-text="fileName"></span>
            </p>
        </template>
    </div>

</div> --}}
