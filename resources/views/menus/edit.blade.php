<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edit Menu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-5">
                <a href="{{ route('menus.index') }}"
                    style="background:#6b7280;color:white;padding:10px 16px;border-radius:8px;text-decoration:none;">
                    ← Back to Menu
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">

                <form
                    action="{{ route('menus.update', $menu->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="block mb-2">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="w-full border rounded px-3 py-2">

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ $menu->category_id == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    {{-- Menu Name --}}
                    <div class="mb-4">
                        <label class="block mb-2">
                            Menu Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $menu->name) }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="block mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="3"
                            class="w-full border rounded px-3 py-2">{{ old('description', $menu->description) }}</textarea>
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <label class="block mb-2">
                            Price
                        </label>

                        <input
                            type="number"
                            name="price"
                            value="{{ old('price', $menu->price) }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Current Image --}}
                    @if($menu->image)
                        <div class="mb-4">

                            <label class="block mb-2">
                                Current Image
                            </label>

                            <img
                                id="preview-image"
                                src="{{ asset('storage/'.$menu->image) }}"
                                alt="{{ $menu->name }}"
                                style="
                                    width:180px;
                                    height:180px;
                                    object-fit:cover;
                                    border-radius:10px;
                                    border:1px solid #ddd;
                                ">

                        </div>
                    @endif

                    {{-- Upload New Image --}}
                    <div class="mb-4">
                        <label class="block mb-2">
                            Change Image
                        </label>

                        <input
                            type="file"
                            id="image-input"
                            name="image"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Status --}}
                    <div class="mb-6">

                        <label class="block mb-2">
                            Status
                        </label>

                        <label class="mr-4">

                            <input
                                type="radio"
                                name="is_active"
                                value="1"
                                {{ $menu->is_active ? 'checked' : '' }}>

                            Active

                        </label>

                        <label>

                            <input
                                type="radio"
                                name="is_active"
                                value="0"
                                {{ !$menu->is_active ? 'checked' : '' }}>

                            Inactive

                        </label>

                    </div>

                    <button
                        type="submit"
                        style="background:#f59e0b;color:white;padding:10px 20px;border-radius:8px;">
                        Update Menu
                    </button>

                </form>

            </div>

        </div>
    </div>

    <script>
        const imageInput = document.getElementById('image-input');
        const previewImage = document.getElementById('preview-image');

        if (imageInput && previewImage) {

            imageInput.addEventListener('change', function () {

                const file = this.files[0];

                if (file) {
                    previewImage.src = URL.createObjectURL(file);
                }

            });

        }
    </script>

</x-app-layout>