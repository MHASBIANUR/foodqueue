{{-- ========================================================= --}}
{{-- Receipt Modal --}}
{{-- ========================================================= --}}
<div
    id="receiptModal"
    class="fixed inset-0 z-50 hidden overflow-y-auto">

    {{-- Backdrop --}}
    <div
    id="receiptBackdrop"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm">
    </div>

    {{-- Modal --}}
    <div class="relative flex min-h-full items-start justify-center py-10 px-6">

        <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b bg-gray-50 px-8 py-5">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        Receipt Preview
                    </h2>

                    <p class="text-sm text-gray-500">
                        Review the receipt before printing.
                    </p>

                </div>

                <button
                    id="closeReceiptModal"
                    type="button"
                    class="text-3xl text-gray-400 hover:text-gray-700 transition">

                    &times;

                </button>

            </div>

            {{-- ========================================================= --}}
            {{-- Receipt Body --}}
            {{-- ========================================================= --}}
            <div class="bg-gray-100 p-8">

                <div
                    id="receiptArea"
                    class="mx-auto max-w-md bg-white rounded-lg shadow-lg border border-gray-200 p-8 text-sm text-gray-800">

                    {{-- Logo --}}
                    <div class="text-center">

                        <h1 class="text-3xl font-extrabold tracking-widest">
                            FOODQUEUE
                        </h1>

                        <p class="text-gray-500 text-xs mt-1">
                            Restaurant Management System
                        </p>

                    </div>

                    <div class="border-t border-dashed border-gray-400 my-5"></div>

                    {{-- Order Information --}}
                    <table class="w-full text-sm">

                        <tbody>

                            <tr>

                                <td class="py-1 text-gray-500">
                                    Queue
                                </td>

                                <td class="py-1 text-right font-semibold">
                                    {{ $order->queue_number }}
                                </td>

                            </tr>

                            <tr>

                                <td class="py-1 text-gray-500">
                                    Customer
                                </td>

                                <td class="py-1 text-right font-semibold">
                                    {{ $order->customer_name }}
                                </td>

                            </tr>

                            <tr>

                                <td class="py-1 text-gray-500">
                                    Cashier
                                </td>

                                <td class="py-1 text-right font-semibold">
                                    {{ $order->creator->name }}
                                </td>

                            </tr>

                            <tr>

                                <td class="py-1 text-gray-500">
                                    Date
                                </td>

                                <td class="py-1 text-right">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>

                            </tr>

                            <tr>

                                <td class="py-1 text-gray-500">
                                    Time
                                </td>

                                <td class="py-1 text-right">
                                    {{ $order->created_at->format('H:i') }}
                                </td>

                            </tr>

                        </tbody>

                    </table>

                    <div class="border-t border-dashed border-gray-400 my-5"></div>

                    {{-- Items --}}
                    <table class="w-full text-sm">

                        <thead>

                            <tr>

                                <th class="text-left pb-3">
                                    Item
                                </th>

                                <th class="text-center pb-3">
                                    Qty
                                </th>

                                <th class="text-right pb-3">
                                    Price
                                </th>

                                <th class="text-right pb-3">
                                    Total
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($order->items as $item)

                                <tr>

                                    <td class="py-2">

                                        <div class="font-medium">
                                            {{ $item->menu->name }}
                                        </div>

                                    </td>

                                    <td class="text-center">

                                        {{ $item->qty }}

                                    </td>

                                    <td class="text-right whitespace-nowrap">

                                        {{ number_format($item->price,0,',','.') }}

                                    </td>

                                    <td class="text-right font-semibold whitespace-nowrap">

                                        {{ number_format($item->subtotal,0,',','.') }}

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                    <div class="border-t border-dashed border-gray-400 my-5"></div>

                    {{-- Total --}}
                    <table class="w-full">

                        <tbody>

                            <tr>

                                <td class="text-lg font-bold">
                                    TOTAL
                                </td>

                                <td class="text-right text-2xl font-extrabold">
                                    Rp {{ number_format($order->total_price,0,',','.') }}
                                </td>

                            </tr>

                        </tbody>

                    </table>

                    <div class="border-t border-dashed border-gray-400 my-5"></div>

                    {{-- Footer --}}
                    <div class="text-center">

                        <p class="font-semibold">
                            Thank You
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Please Come Again
                        </p>

                        <p class="text-[11px] text-gray-400 mt-4">
                            Printed at {{ now()->format('d M Y H:i') }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- Footer Modal --}}
            <div
                class="flex justify-end gap-3 border-t bg-gray-50 px-8 py-5">

                <a
                    href="{{ route('orders.print', $order) }}"
                    target="_blank"
                    class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-lg transition">

                    🖨 Print Receipt

                </a>

                <button
                    id="closeReceiptButton"
                    type="button"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg transition">

                    Close

                </button>

            </div>

        </div>

    </div>

</div>

