<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Kitchen Display
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-white mb-8">
                🍳 Kitchen Display
            </h1>

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            @if($orders->isEmpty())

                <div class="bg-white rounded-xl p-10 text-center">

                    <h2 class="text-2xl font-bold text-gray-700">
                        No Active Orders
                    </h2>

                    <p class="text-gray-500 mt-3">
                        All orders have been completed.
                    </p>

                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @foreach($orders as $order)

                        <div class="bg-white rounded-2xl shadow-lg p-6 transition hover:shadow-xl">

                        <div class="flex justify-between items-center mb-5">

                            <div class="flex items-center gap-3">

                                @switch($order->status)

                                    @case('waiting')
                                        <span class="w-5 h-5 rounded-full bg-yellow-400"></span>
                                        @break

                                    @case('processing')
                                        <span class="w-5 h-5 rounded-full bg-blue-500"></span>
                                        @break

                                    @case('ready')
                                        <span class="w-5 h-5 rounded-full bg-green-500"></span>
                                        @break

                                    @default
                                        <span class="w-5 h-5 rounded-full bg-gray-400"></span>

                                @endswitch

                                <h2 class="text-4xl font-extrabold tracking-wide">
                                    {{ $order->queue_number }}
                                </h2>

                            </div>

                            @switch($order->status)

                                @case('waiting')
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 font-semibold">
                                        Waiting
                                    </span>
                                    @break

                                @case('processing')
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-semibold">
                                        Processing
                                    </span>
                                    @break

                                @case('ready')
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 font-semibold">
                                        Ready
                                    </span>
                                    @break

                            @endswitch

                        </div>

                            <div class="mb-4">

                                <p class="text-gray-700">
                                    Customer :
                                    <span class="font-semibold">
                                        {{ $order->customer_name }}
                                    </span>
                                </p>

                                <p class="text-sm text-gray-500 mt-1">
                                    🕒 Order Time :
                                    {{ $order->created_at->format('H:i') }}
                                </p>

                            </div>

                            <hr class="mb-4">

                            <h3 class="font-bold mb-3">
                                Order Items
                            </h3>

                            <ul class="space-y-2">

                                @foreach($order->items as $item)

                                    <li class="flex justify-between">

                                        <span>
                                            {{ $item->menu->name }}
                                        </span>

                                        <span class="font-semibold">
                                            x{{ $item->qty }}
                                        </span>

                                    </li>

                                @endforeach

                            </ul>

                            <div class="mt-6">

                                @if($order->status == 'waiting')

                                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                                            Start Processing
                                        </button>
                                    </form>

                                @elseif($order->status == 'processing')

                                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold transition">
                                            Mark as Ready
                                        </button>
                                    </form>

                                @elseif($order->status == 'ready')

                                    <div
                                        class="w-full bg-green-100 text-green-700 text-center py-2 rounded-lg font-semibold">
                                        ✅ Ready to Serve
                                    </div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </div>

    <script>
        setTimeout(() => {
            location.reload();
        }, 5000);
    </script>

</x-app-layout>