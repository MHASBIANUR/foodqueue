<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Category Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div id="success-alert"
                    style="background:#16a34a;color:white;padding:12px;border-radius:8px;margin-bottom:16px;">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(() => {
                        document.getElementById('success-alert')?.remove();
                    }, 3000);
                </script>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">
                    Categories
                </h1>

                <a
                    href="{{ route('categories.create') }}"
                    style="background:#2563eb;color:white;padding:10px 16px;border-radius:8px;text-decoration:none;">
                    + Add Category
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">

                @forelse($categories as $category)
                    <div class="border-b py-4">

                        <h3 class="font-semibold text-lg">
                            {{ $category->name }}
                        </h3>

                        <p class="text-gray-500 mb-3">
                            {{ $category->description }}
                        </p>

                       <div style="display:flex;gap:8px;">

                        <a
                            href="{{ route('categories.edit', $category->id) }}"
                            style="
                                background:#f59e0b;
                                color:white;
                                padding:6px 12px;
                                border-radius:6px;
                                text-decoration:none;
                            ">
                            Edit
                        </a>

                        <form
                            action="{{ route('categories.destroy', $category->id) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this category?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                style="
                                    background:#dc2626;
                                    color:white;
                                    padding:6px 12px;
                                    border-radius:6px;
                                    border:none;
                                    cursor:pointer;
                                ">
                                Delete
                            </button>

                        </form>

                    </div>

                    </div>
                @empty
                    <p class="text-gray-500">
                        No categories found.
                    </p>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>