<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('creator');

        // Search Queue Number / Customer Name
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('queue_number', 'like', "%{$search}%")
                ->orWhere('customer_name', 'like', "%{$search}%");

            });

        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        $orders = $query
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('orders.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'items' => 'required'
        ]);

        $items = json_decode($request->items, true);

        if (!$items || count($items) == 0) {
            return back()->with('error', 'Please select at least one menu.');
        }

        DB::transaction(function () use ($request, $items) {

            $lastOrder = Order::latest()->first();

            if ($lastOrder) {

                $lastNumber = (int) substr($lastOrder->queue_number, 1);

            } else {

                $lastNumber = 0;

            }

            $queueNumber = 'Q' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            $order = Order::create([
                'queue_number' => $queueNumber,
                'customer_name' => $request->customer_name,
                'status' => 'waiting',
                'total_price' => 0,
                'created_by' => auth()->id(),
            ]);

            $total = 0;

            foreach ($items as $item) {

                $menu = Menu::findOrFail($item['id']);

                $subtotal = $menu->price * $item['qty'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $item['qty'],
                    'price' => $menu->price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update([
                'total_price' => $total
            ]);
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with([
            'creator',
            'items.menu'
        ])->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Update kitchen status.
     */
    public function updateStatus(Order $order)
    {
        switch ($order->status) {

            case 'waiting':
                $order->update([
                    'status' => 'processing'
                ]);
                $message = 'Order is now Processing.';
                break;

            case 'processing':
                $order->update([
                    'status' => 'ready'
                ]);
                $message = 'Order is now Ready.';
                break;

            default:
                return redirect()
                    ->back()
                    ->with('error', 'Order status cannot be updated.');
        }

        return redirect()
            ->back()
            ->with('success', $message);
    }

    /**
     * Complete order.
     */
    public function complete(Order $order)
    {
        if ($order->status !== 'ready') {

            return redirect()
                ->back()
                ->with('error', 'Only ready orders can be completed.');

        }

        $order->update([
            'status' => 'completed'
        ]);

        return redirect()
            ->back()
            ->with('success', 'Order has been Completed.');
    }

    /**
     * Display Kitchen Display.
     */
    public function kitchen()
    {
        $orders = Order::with('items.menu')
            ->whereIn('status', [
                'waiting',
                'processing',
                'ready'
            ])
            ->oldest()
            ->get();

        return view('orders.kitchen', compact('orders'));
    }

    public function print(Order $order)
    {
        $order->load([
            'creator',
            'items.menu'
        ]);

        return view('orders.receipt-print', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
