<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            FoodQueue Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome Section --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">
                    Welcome back, {{ auth()->user()->name }} 
                </h1>

                <p class="text-gray-400 mt-2">
                    Manage restaurant orders and monitor queue status in real-time.
                </p>
            </div>

            {{-- Statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">
                        Total Orders Today
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        0
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">
                        Waiting Orders
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        0
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">
                        Processing Orders
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        0
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">
                        Ready Orders
                    </h3>

                    <p class="text-3xl font-bold mt-2">
                        0
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>