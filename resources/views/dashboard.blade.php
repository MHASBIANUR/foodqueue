<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            FoodQueue Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome --}}
            <div class="mb-10">

                <h1 class="text-4xl font-bold text-white">
                    Welcome back, {{ auth()->user()->name }} 👋
                </h1>

                <p class="text-lg text-gray-400 mt-3">
                    Manage restaurant orders and monitor queue status in real-time.
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Updated Today
                </p>

            </div>

            {{-- Statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                {{-- Total Orders --}}
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-md p-6 cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-200 hover:bg-blue-50">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Orders Today
                            </p>

                            <h3 class="mt-4 text-5xl font-extrabold tracking-tight transition-all duration-300 group-hover:scale-105">
                                {{ $totalOrders }}
                            </h3>

                        </div>

                        <div class="rounded-xl bg-blue-100 p-3 transition duration-300 group-hover:bg-blue-600">
                            <x-heroicon-o-clipboard-document-list
                                class="w-8 h-8 text-blue-600 transition duration-300 group-hover:text-white" />
                        </div>

                    </div>

                </div>

                {{-- Waiting --}}
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-md p-6 cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-yellow-200 hover:bg-yellow-50">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Waiting Orders
                            </p>

                            <h3 class="mt-4 text-5xl font-extrabold tracking-tight transition-all duration-300 group-hover:scale-105">
                                {{ $waitingOrders }}
                            </h3>

                        </div>

                        <div class="rounded-xl bg-yellow-100 p-3 transition duration-300 group-hover:bg-yellow-500">
                            <x-heroicon-o-clock
                                class="w-8 h-8 text-yellow-600 transition duration-300 group-hover:text-white" />
                        </div>

                    </div>

                </div>

                {{-- Processing --}}
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-md p-6 cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-blue-200 hover:bg-blue-50">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Processing Orders
                            </p>

                            <h3 class="mt-4 text-5xl font-extrabold tracking-tight transition-all duration-300 group-hover:scale-105">
                                {{ $processingOrders }}
                            </h3>

                        </div>

                        <div class="rounded-xl bg-indigo-100 p-3 transition duration-300 group-hover:bg-indigo-600">
                            <x-heroicon-o-arrow-path
                                class="w-8 h-8 text-indigo-600 transition duration-500 group-hover:text-white group-hover:rotate-180" />
                        </div>

                    </div>

                </div>

                {{-- Ready --}}
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-md p-6 cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-green-200 hover:bg-green-50">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Ready Orders
                            </p>

                            <h3 class="mt-4 text-5xl font-extrabold tracking-tight transition-all duration-300 group-hover:scale-105">
                                {{ $readyOrders }}
                            </h3>

                        </div>

                        <div class="rounded-xl bg-green-100 p-3 transition duration-300 group-hover:bg-green-600">
                            <x-heroicon-o-check-circle
                                class="w-8 h-8 text-green-600 transition duration-300 group-hover:text-white" />
                        </div>

                    </div>

                </div>

                {{-- Completed --}}
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-md p-6 cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-gray-300 hover:bg-gray-50">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Completed Orders
                            </p>

                            <h3 class="mt-4 text-5xl font-extrabold tracking-tight transition-all duration-300 group-hover:scale-105">
                                {{ $completedOrders }}
                            </h3>

                        </div>

                        <div class="rounded-xl bg-gray-100 p-3 transition duration-300 group-hover:bg-gray-800">
                            <x-heroicon-o-trophy
                                class="w-8 h-8 text-gray-600 transition duration-300 group-hover:text-white" />
                        </div>

                    </div>

                </div>


                {{-- Revenue Today --}}
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-md p-6 cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-emerald-200 hover:bg-emerald-50">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Revenue Today
                            </p>

                            <h3 class="mt-4 text-3xl font-extrabold tracking-tight transition-all duration-300 group-hover:scale-105">
                                Rp {{ number_format($todayRevenue, 0, ',', '.') }}
                            </h3>

                        </div>

                        <div class="rounded-xl bg-emerald-100 p-3 transition duration-300 group-hover:bg-emerald-600">

                            <x-heroicon-o-banknotes
                                class="w-8 h-8 text-emerald-600 transition duration-300 group-hover:text-white" />

                        </div>

                    </div>

                </div>

                {{-- Total Menus --}}
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-md p-6 cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-purple-200 hover:bg-purple-50">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Menus
                            </p>

                            <h3 class="mt-4 text-5xl font-extrabold tracking-tight transition-all duration-300 group-hover:scale-105">
                                {{ $totalMenus }}
                            </h3>

                        </div>

                        <div class="rounded-xl bg-purple-100 p-3 transition duration-300 group-hover:bg-purple-600">

                            <x-heroicon-o-book-open
                                class="w-8 h-8 text-purple-600 transition duration-300 group-hover:text-white" />

                        </div>

                    </div>

                </div>

                {{-- Total Categories --}}
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-md p-6 cursor-pointer transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-pink-200 hover:bg-pink-50">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Categories
                            </p>

                            <h3 class="mt-4 text-5xl font-extrabold tracking-tight transition-all duration-300 group-hover:scale-105">
                                {{ $totalCategories }}
                            </h3>

                        </div>

                        <div class="rounded-xl bg-pink-100 p-3 transition duration-300 group-hover:bg-pink-600">

                            <x-heroicon-o-squares-2x2
                                class="w-8 h-8 text-pink-600 transition duration-300 group-hover:text-white" />

                        </div>

                    </div>

                </div>
            </div>

            {{-- ========================================================= --}}
            {{-- Latest Orders --}}
            {{-- ========================================================= --}}
            <div class="mt-12">

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

                    {{-- Header --}}
                    <div class="flex items-center justify-between px-8 py-6 border-b">

                        <div>

                            <h2 class="text-2xl font-bold text-gray-800">
                                Latest Orders
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Recent customer transactions
                            </p>

                        </div>

                        <a
                            href="{{ route('orders.index') }}"
                            class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800 transition">

                            View All

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-2"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"/>

                            </svg>

                        </a>

                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">

                        <table class="min-w-full">

                            <thead class="bg-gray-50">

                                <tr class="text-xs uppercase tracking-wider text-gray-500">

                                    <th class="px-6 py-4 text-left">
                                        Queue
                                    </th>

                                    <th class="px-6 py-4 text-left">
                                        Customer
                                    </th>

                                    <th class="px-6 py-4 text-left">
                                        Cashier
                                    </th>

                                    <th class="px-6 py-4 text-center">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-right">
                                        Total
                                    </th>

                                    <th class="px-6 py-4 text-center">
                                        Time
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @forelse($latestOrders as $order)

                                    <tr class="hover:bg-gray-50 transition">

                                        <td class="px-6 py-5 font-bold text-gray-800">

                                            {{ $order->queue_number }}

                                        </td>

                                        <td class="px-6 py-5">

                                            {{ $order->customer_name }}

                                        </td>

                                        <td class="px-6 py-5 text-gray-600">

                                            {{ $order->creator->name }}

                                        </td>

                                        <td class="px-6 py-5 text-center">

                                            @switch($order->status)

                                                @case('waiting')

                                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">

                                                        Waiting

                                                    </span>

                                                @break

                                                @case('processing')

                                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">

                                                        Processing

                                                    </span>

                                                @break

                                                @case('ready')

                                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                                        Ready

                                                    </span>

                                                @break

                                                @case('completed')

                                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">

                                                        Completed

                                                    </span>

                                                @break

                                            @endswitch

                                        </td>

                                        <td class="px-6 py-5 text-right font-semibold">

                                            Rp {{ number_format($order->total_price,0,',','.') }}

                                        </td>

                                        <td class="px-6 py-5 text-center text-gray-500">

                                            {{ $order->created_at->format('H:i') }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="py-10 text-center text-gray-400">

                                            No orders available.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            {{-- ========================================================= --}}
            {{-- Quick Actions --}}
            {{-- ========================================================= --}}
            <div class="mt-10">

                <h2 class="text-2xl font-bold text-white mb-6">
                    Quick Actions
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                    {{-- New Order --}}
                    <a
                        href="{{ route('orders.create') }}"
                        class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:-translate-y-2 hover:shadow-2xl">

                        <div class="flex justify-between items-start">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Order
                                </p>

                                <h3 class="text-xl font-bold mt-2">
                                    New Order
                                </h3>

                                <p class="text-gray-500 mt-3 text-sm">
                                    Create a new customer order.
                                </p>

                            </div>

                            <div class="bg-blue-100 rounded-xl p-3 group-hover:bg-blue-600 transition">

                                <x-heroicon-o-plus
                                    class="w-8 h-8 text-blue-600 group-hover:text-white"/>

                            </div>

                        </div>

                    </a>

                    {{-- Kitchen --}}
                    <a
                        href="{{ route('orders.kitchen') }}"
                        class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:-translate-y-2 hover:shadow-2xl">

                        <div class="flex justify-between items-start">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Kitchen
                                </p>

                                <h3 class="text-xl font-bold mt-2">
                                    Kitchen Display
                                </h3>

                                <p class="text-gray-500 mt-3 text-sm">
                                    Monitor all active orders.
                                </p>

                            </div>

                            <div class="bg-orange-100 rounded-xl p-3 group-hover:bg-orange-600 transition">

                                <x-heroicon-o-fire
                                    class="w-8 h-8 text-orange-600 group-hover:text-white"/>

                            </div>

                        </div>

                    </a>

                    {{-- Menu --}}
                    <a
                        href="{{ route('menus.index') }}"
                        class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:-translate-y-2 hover:shadow-2xl">

                        <div class="flex justify-between items-start">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Menu
                                </p>

                                <h3 class="text-xl font-bold mt-2">
                                    Manage Menus
                                </h3>

                                <p class="text-gray-500 mt-3 text-sm">
                                    Add or edit restaurant menus.
                                </p>

                            </div>

                            <div class="bg-green-100 rounded-xl p-3 group-hover:bg-green-600 transition">

                                <x-heroicon-o-book-open
                                    class="w-8 h-8 text-green-600 group-hover:text-white"/>

                            </div>

                        </div>

                    </a>

                    {{-- Category --}}
                    <a
                        href="{{ route('categories.index') }}"
                        class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition hover:-translate-y-2 hover:shadow-2xl">

                        <div class="flex justify-between items-start">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Categories
                                </p>

                                <h3 class="text-xl font-bold mt-2">
                                    Manage Categories
                                </h3>

                                <p class="text-gray-500 mt-3 text-sm">
                                    Organize restaurant categories.
                                </p>

                            </div>

                            <div class="bg-purple-100 rounded-xl p-3 group-hover:bg-purple-600 transition">

                                <x-heroicon-o-squares-2x2
                                    class="w-8 h-8 text-purple-600 group-hover:text-white"/>

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div>
    </div>

    <script>
        setTimeout(() => {
            location.reload();
        }, 5000);
    </script>
</x-app-layout>