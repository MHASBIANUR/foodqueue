<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Create Order
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Back --}}
            <div class="mb-5">
                <a href="{{ route('orders.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    ← Back to Orders
                </a>
            </div>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <input
                    type="hidden"
                    name="items"
                    id="items-input">

                {{-- CUSTOMER --}}
                <div class="bg-white rounded-2xl shadow-md p-6 mb-6">

                    <h3 class="text-2xl font-bold mb-4">
                        Customer Information
                    </h3>

                    <label class="block font-medium mb-2">
                        Customer Name
                    </label>

                    <input
                        type="text"
                        name="customer_name"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Input customer name">

                </div>

                {{-- CONTENT --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- LEFT --}}
                    <div class="lg:col-span-2">

                        <div class="bg-white rounded-xl shadow p-6">

                            <h3 class="text-2xl font-bold mb-6">
                                Available Menu
                            </h3>

                            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                                @forelse($menus as $menu)

                                <div
                                    class="menu-card bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition duration-300 overflow-hidden"
                                    data-id="{{ $menu->id }}"
                                    data-name="{{ $menu->name }}"
                                    data-price="{{ $menu->price }}">

                                    <div class="flex p-4 gap-4">

                                        {{-- Image --}}
                                        <div class="w-24 h-24 flex-shrink-0">

                                            @if($menu->image)

                                                <img
                                                    src="{{ asset('storage/'.$menu->image) }}"
                                                    alt="{{ $menu->name }}"
                                                    class="w-full h-full rounded-xl object-cover">

                                            @else

                                                <div class="w-full h-full rounded-xl bg-gray-200 flex items-center justify-center text-gray-400">

                                                    No Image

                                                </div>

                                            @endif

                                        </div>

                                        {{-- Detail --}}
                                        <div class="flex-1 flex flex-col justify-between">

                                            <div>

                                                <h4 class="text-lg font-bold text-gray-800">
                                                    {{ $menu->name }}
                                                </h4>

                                                <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                                    {{ $menu->description }}
                                                </p>

                                            </div>

                                            <div class="mt-3">

                                                <span class="text-xl font-bold text-blue-600">
                                                    Rp {{ number_format($menu->price,0,',','.') }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- Footer --}}
                                <div class="border-t bg-gray-50 px-4 py-3 flex justify-center">

                                    <button
                                        type="button"
                                        class="add-menu bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition">

                                        + Add

                                    </button>

                                </div>

                                </div>

                                @empty

                                    <div class="col-span-2 text-center py-10 text-gray-500">

                                        No active menu available.

                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <div>

                        <div class="bg-white rounded-2xl shadow-md p-6 sticky top-5">

                            <h3 class="text-2xl font-bold mb-8">
                                Order Summary
                            </h3>

                            <div id="order-summary" class="text-center text-gray-500 py-20">

                                <div class="text-6xl mb-5">
                                    🛒
                                </div>

                                <p class="text-xl">
                                    No item selected.
                                </p>

                                <p class="text-gray-400 mt-2">
                                    Add menu from the left.
                                </p>

                            </div>

                            <hr class="my-8">

                            <div class="flex justify-between font-bold text-2xl">

                                <span>Total</span>

                                <span id="total-price">Rp 0</span>

                            </div>

                            <button
                                type="submit"
                                class="w-full mt-6 bg-blue-600 hover:bg-blue-700 transition text-white py-3 rounded-xl font-semibold">

                                Create Order

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>