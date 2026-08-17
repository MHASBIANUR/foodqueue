<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Order Detail
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

            {{-- Alert --}}
            @if(session('success'))
                <div class="mb-5 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Order Information --}}
            <div class="bg-white rounded-2xl shadow-md p-8 mb-6">

                <h3 class="text-2xl font-bold mb-6">
                    Order Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-gray-500 text-sm">Queue Number</p>
                        <p class="font-semibold text-lg">
                            {{ $order->queue_number }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Customer</p>
                        <p class="font-semibold text-lg">
                            {{ $order->customer_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Cashier</p>
                        <p class="font-semibold text-lg">
                            {{ $order->creator->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm mb-2">
                            Status
                        </p>

                        @switch($order->status)

                            @case('waiting')
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                    🟡 Waiting
                                </span>
                                @break

                            @case('processing')
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                    🔵 Processing
                                </span>
                                @break

                            @case('ready')
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    🟢 Ready
                                </span>
                                @break

                            @case('completed')
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-700">
                                    ⚫ Completed
                                </span>
                                @break

                            @default
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                    🔴 Cancelled
                                </span>

                        @endswitch

                       {{-- Cashier Action --}}
                        <div class="mt-4">

                            @if($order->status == 'waiting')

                                <p class="text-yellow-600 font-medium">
                                    ⏳ Waiting for kitchen to start processing.
                                </p>

                            @elseif($order->status == 'processing')

                                <p class="text-blue-600 font-medium">
                                    👨‍🍳 Order is currently being prepared by the kitchen.
                                </p>

                            @elseif($order->status == 'ready')

                                <form action="{{ route('orders.complete', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="bg-gray-800 hover:bg-black text-white px-4 py-2 rounded-lg transition">
                                        Complete Order
                                    </button>
                                </form>

                            @elseif($order->status == 'completed')

                                <div class="space-y-4">

                                    <p class="text-green-600 font-medium">
                                        This order has been completed successfully.
                                    </p>

                                    <button
                                        id="openReceiptModal"
                                        type="button"
                                        class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-black text-white rounded-lg transition">

                                        🖨 Print Receipt

                                    </button>

                                </div>

                            @endif

                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-500 text-sm">Created At</p>
                        <p class="font-semibold">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- Order Items --}}
            <div class="bg-white rounded-2xl shadow-md p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Order Items
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 border-b">

                            <tr class="text-left">

                                <th class="py-4 px-2">Menu</th>
                                <th class="py-4 px-2 text-center">Qty</th>
                                <th class="py-4 px-2 text-right">Price</th>
                                <th class="py-4 px-2 text-right">Subtotal</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($order->items as $item)

                                <tr class="border-b">

                                    <td class="py-5 px-2 font-medium">
                                        {{ $item->menu->name }}
                                    </td>

                                    <td class="py-5 px-2 text-center">
                                        {{ $item->qty }}
                                    </td>

                                    <td class="py-5 px-2 text-right">
                                        Rp {{ number_format($item->price,0,',','.') }}
                                    </td>

                                    <td class="py-5 px-2 text-right font-semibold">
                                        Rp {{ number_format($item->subtotal,0,',','.') }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot class="border-t-2">

                            <tr>

                                <td colspan="3"
                                    class="pt-6 px-2 text-right text-2xl font-bold">

                                    Total

                                </td>

                                <td class="pt-6 px-2 text-right text-3xl font-bold text-blue-600">

                                    Rp {{ number_format($order->total_price,0,',','.') }}

                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>
    </div>

    @include('orders.receipt-modal')

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('receiptModal');
        const openButton = document.getElementById('openReceiptModal');
        const closeButton = document.getElementById('closeReceiptModal');
        const closeFooterButton = document.getElementById('closeReceiptButton');
        const backdrop = document.getElementById('receiptBackdrop');
        const printButton = document.getElementById('printReceipt');

        function openModal() {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        if (openButton) {
            openButton.addEventListener('click', openModal);
        }

        if (closeButton) {
            closeButton.addEventListener('click', closeModal);
        }

        if (closeFooterButton) {
            closeFooterButton.addEventListener('click', closeModal);
        }

        if (backdrop) {
            backdrop.addEventListener('click', closeModal);
        }

        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                closeModal();
            }

        });

        if (printButton) {
            printButton.addEventListener('click', function () {
                window.print();
            });
        }

    });
    </script>

</x-app-layout>