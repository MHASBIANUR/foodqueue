<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Category Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">
                    Categories
                </h1>

                <a href="{{ route('categories.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    + Add Category
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">

                @forelse($categories as $category)
                    <div class="border-b py-3">
                        <h3 class="font-semibold">
                            {{ $category->name }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $category->description }}
                        </p>
                    </div>
                @empty
                    <p>No categories found.</p>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>