<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Add Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow">

                <div class="p-4 bg-black text-black mb-4">
                    BLACK TEST
                </div>

                <div class="p-4 bg-gray-800 text-white mb-4">
                    GRAY TEST
                </div>

                <div class="p-4 bg-gray-900 text-white mb-4">
                    GRAY 900 TEST
                </div>
                
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
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
                        class="w-full border rounded px-3 py-2">
                        </textarea>
                    </div>

                    <button
                        type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded">
                        Save Category
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>