<x-app-layout>
    @php
        $links = [
            'Dashboard' => route('dashboard'),
            'Items' => route('items'),
        ];
        if (request()->routeIs('items.create')) {
            $links['Create Item'] = route('items.create');
        } else {
            $links['Edit Item'] = route('items.edit', $item->id);
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
                        {{ request()->routeIs('items.create') ? 'Create Item' : 'Edit Item' }}</h2>
                    <div class="bg-blue-100 p-3 rounded-lg mt-3">
                        <p class="mb-2 font-semibold text-gray-800"> Make sure you have accurate item details ready:</p>
                        <div class="flex justify-between w-[90%]">
                            <div>
                                <li class="text-sm text-gray-700 mb-1 ml-4">Item name (must match product label or
                                    catalog)
                                </li>
                                <li class="text-sm text-gray-700 mb-1 ml-4">Item description (include key features,
                                    specifications, or materials)</li>
                                <li class="text-sm text-gray-700 mb-1 ml-4">Item category (e.g., electronics, apparel,
                                    food,
                                    etc.)</li>
                                <li class="text-sm text-gray-700 mb-1 ml-4">Item code / SKU (if applicable)</li>
                            </div>
                            <div>
                                <li class="text-sm text-gray-700 mb-1 ml-4">Unit of measure (e.g., piece, box, kilogram,
                                    liter)</li>
                                <li class="text-sm text-gray-700 mb-1 ml-4">Unit price (cost per item or per unit)</li>
                                <li class="text-sm text-gray-700 mb-1 ml-4">Image of item (upload clear, high-quality
                                    photo)
                                </li>
                            </div>
                        </div>
                    </div>
                </div>

                <form
                    action="{{ request()->routeIs('items.create') ? route('items.store') : route('items.update', encrypt($item->id)) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf

                    @if (request()->routeIs('items.edit'))
                        @method('put')
                    @endif

                    {{-- hidden input --}}
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">



                    <div class="grid grid-cols-2 gap-3 p-4">

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Item name <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="item_name" class="border border-red-200 rounded-md p-2"
                                value="{{ old('item_name', optional($item)->item_name) }}" placeholder="Example..">
                            @error('item_name')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Supplier <span
                                    class="text-red-600">*</span></label>
                            <select name="supplier_id" id="" class="border border-red-200 rounded-md p-2">
                                <option value="" selected disabled>Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ optional($item)->supplier_id == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->supplier_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">UOM <span
                                    class="text-red-600">*</span></label>
                            <select name="item_uom" id="" class="border border-red-200 rounded-md p-2">
                                <option value="" selected disabled>Select Type</option>
                                <option value="Meter" {{ optional($item)->item_uom == 'Meter' ? 'selected' : '' }}>
                                    Meter
                                </option>
                                <option value="Kilogram"
                                    {{ optional($item)->item_uom == 'Kilogram' ? 'selected' : '' }}>Kilogram
                                </option>
                                <option value="liter" {{ optional($item)->item_uom == 'liter' ? 'selected' : '' }}>
                                    liter
                                </option>
                                <option value="pieces" {{ optional($item)->item_uom == 'pieces' ? 'selected' : '' }}>
                                    pieces
                                </option>
                            </select>
                            @error('item_uom')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid gap-1">
                            <label for="" class="text-md font-medium text-gray-600">Price <span
                                    class="text-red-600">*</span></label>
                            <input type="number" name="price" class="border border-red-200 rounded-md p-2"
                                placeholder="******" value="{{ old('price', optional($item)->price) }}">
                            @error('price')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- image input --}}
                        <div class="grid gap-1 col-span-2">
                            <label for="" class="text-md font-medium text-gray-600">Upload Item Photo <span
                                    class="text-red-600">*</span></label>

                            <div x-data="{
                                imageUrl: '{{ optional($item)->item_image ? asset('storage/'. optional($item)->item_image ) : 'https://placehold.co/340x250?text=Image' }}',
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
                            }" x-init="fileInput = $refs.imageInput" class="relative">
                                <!-- Hidden File Input -->
                                <input type="file" name="item_image" value="{{ optional($item)->item_image }}" accept="image/*" class="hidden" x-ref="imageInput"
                                    @change="updatePreview">

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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
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

                            </div>
                            @error('item_image')
                                <span class="text-sm text-red-500">* {{ $message }}</span>
                            @enderror
                        </div>
                        {{-- end image input --}}

                    </div>

                    <div class="p-4">
                        <button type="submit"
                            class="py-2 px-3 bg-blue-500 rounded-md text-sm text-white font-medium">{{ request()->routeIs('items.create') ? 'Create Item' : 'Update Item' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
