<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow">

                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ $category->name }}"
                            class="w-full border rounded px-3 py-2"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="3"
                            class="w-full border rounded px-3 py-2">{{ $category->description }}</textarea>
                    </div>

                    <a
                        href="{{ route('categories.index') }}"
                        style="background:#6b7280;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">
                        Back
                    </a>

                    <button
                        type="submit"
                        style="background:#2563eb;color:white;padding:10px 20px;border-radius:8px;border:none;">
                        Update Category
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>