<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Sales Report
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-10">

                <h1 class="text-4xl font-bold text-white">
                    Sales Report 📈
                </h1>

                <p class="text-lg text-gray-400 mt-3">
                    Monitor restaurant revenue and sales performance.
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Updated Today
                </p>

            </div>

            {{-- Coming Soon --}}
            <div class="bg-white rounded-3xl shadow-xl p-16 text-center">

                <div class="mx-auto w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center">

                    <x-heroicon-o-chart-bar class="w-10 h-10 text-blue-600"/>

                </div>

                <h2 class="mt-8 text-3xl font-bold text-gray-800">
                    Sales Report Module
                </h2>

                <p class="mt-4 text-gray-500 text-lg">
                    This module is currently under development.
                </p>

                <div class="mt-10 grid md:grid-cols-3 gap-6">

                    <div class="rounded-2xl bg-gray-50 p-6 border">

                        <h3 class="font-semibold">
                            Revenue Summary
                        </h3>

                        <p class="text-gray-500 text-sm mt-2">
                            Daily & Monthly Revenue
                        </p>

                    </div>

                    <div class="rounded-2xl bg-gray-50 p-6 border">

                        <h3 class="font-semibold">
                            Best Selling Menu
                        </h3>

                        <p class="text-gray-500 text-sm mt-2">
                            Top selling menu statistics
                        </p>

                    </div>

                    <div class="rounded-2xl bg-gray-50 p-6 border">

                        <h3 class="font-semibold">
                            Transaction History
                        </h3>

                        <p class="text-gray-500 text-sm mt-2">
                            Recent completed orders
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>