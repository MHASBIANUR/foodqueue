<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Add Menu
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
                    action="{{ route('menus.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="block mb-2">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="w-full border rounded px-3 py-2">

                            <option value="">
                                -- Select Category --
                            </option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
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
                            class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <label class="block mb-2">
                            Price
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Image --}}
                    <div class="mb-4">
                        <label class="block mb-2">
                            Menu Image
                        </label>

                        <input
                            type="file"
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
                                checked>

                            Active
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="is_active"
                                value="0">

                            Inactive
                        </label>
                    </div>

                    <button
                        type="submit"
                        style="background:#16a34a;color:white;padding:10px 20px;border-radius:8px;">
                        Save Menu
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>