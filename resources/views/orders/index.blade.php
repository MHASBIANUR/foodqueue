<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Order Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Alert --}}
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

            {{-- Heading --}}
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-6">

                <div>
                    <h1 class="text-2xl font-bold text-white">
                        Orders
                    </h1>
                </div>

                <a href="{{ route('orders.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg transition">
                    + New Order
                </a>

            </div>

            {{-- Search & Filter --}}
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">

                <form method="GET" action="{{ route('orders.index') }}">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- Search --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Search
                            </label>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Queue Number / Customer"
                                class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                        </div>

                        {{-- Status --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                                <option value="">All Status</option>

                                <option value="waiting"
                                    @selected(request('status') == 'waiting')>
                                    Waiting
                                </option>

                                <option value="processing"
                                    @selected(request('status') == 'processing')>
                                    Processing
                                </option>

                                <option value="ready"
                                    @selected(request('status') == 'ready')>
                                    Ready
                                </option>

                                <option value="completed"
                                    @selected(request('status') == 'completed')>
                                    Completed
                                </option>

                            </select>

                        </div>

                        {{-- Button --}}
                        <div class="flex items-end gap-3">

                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">

                                Search

                            </button>

                            <a
                                href="{{ route('orders.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg transition">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">

                <table class="w-full">

                    <thead class="border-b">

                        <tr>

                            <th class="text-left p-4">Queue</th>

                            <th class="text-left p-4">Customer</th>

                            <th class="text-left p-4">Total</th>

                            <th class="text-left p-4">Status</th>

                            <th class="text-left p-4">Cashier</th>

                            <th class="text-left p-4">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                            <tr
                                class="border-b"
                                style="transition:.2s;"
                                onmouseover="this.style.background='#f8fafc'"
                                onmouseout="this.style.background='white'">

                                <td class="p-4 font-semibold">
                                    {{ $order->queue_number }}
                                </td>

                                <td class="p-4">
                                    {{ $order->customer_name }}
                                </td>

                                <td class="p-4">
                                    Rp {{ number_format($order->total_price,0,',','.') }}
                                </td>

                                <td class="p-4">

                                    @switch($order->status)

                                        @case('waiting')
                                            <span style="background:#FEF3C7;color:#92400E;padding:6px 12px;border-radius:999px;font-size:13px;font-weight:600;">
                                                Waiting
                                            </span>
                                            @break

                                        @case('processing')
                                            <span style="background:#DBEAFE;color:#1D4ED8;padding:6px 12px;border-radius:999px;font-size:13px;font-weight:600;">
                                                Processing
                                            </span>
                                            @break

                                        @case('ready')
                                            <span style="background:#DCFCE7;color:#166534;padding:6px 12px;border-radius:999px;font-size:13px;font-weight:600;">
                                                Ready
                                            </span>
                                            @break

                                        @case('completed')
                                            <span style="background:#E5E7EB;color:#374151;padding:6px 12px;border-radius:999px;font-size:13px;font-weight:600;">
                                                Completed
                                            </span>
                                            @break

                                        @default
                                            <span style="background:#FEE2E2;color:#991B1B;padding:6px 12px;border-radius:999px;font-size:13px;font-weight:600;">
                                                Cancelled
                                            </span>

                                    @endswitch

                                </td>

                                <td class="p-4">
                                    {{ $order->creator->name }}
                                </td>

                                <td class="p-4">

                                    <a
                                        href="{{ route('orders.show', $order->id) }}"
                                        style="background:#2563eb;color:white;padding:6px 12px;border-radius:6px;text-decoration:none;">
                                        👁 Detail
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center p-8 text-gray-500">

                                    🧾

                                    <br><br>

                                    No orders found.

                                    <br>

                                    Click "New Order" to create the first order.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    <script>
        setTimeout(() => {
            location.reload();
        }, 5000);
    </script>
</x-app-layout>