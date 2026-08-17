<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Order Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::whereDate('created_at', today())->count();

        $waitingOrders = Order::where('status', 'waiting')->count();

        $processingOrders = Order::where('status', 'processing')->count();

        $readyOrders = Order::where('status', 'ready')->count();

        $completedOrders = Order::where('status', 'completed')->count();

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $todayRevenue = Order::whereDate('created_at', today())
            ->where('status', 'completed')
            ->sum('total_price');

        /*
        |--------------------------------------------------------------------------
        | Master Data
        |--------------------------------------------------------------------------
        */

        $totalMenus = Menu::count();

        $totalCategories = Category::count();

        /*
        |--------------------------------------------------------------------------
        | Latest Orders
        |--------------------------------------------------------------------------
        */

        $latestOrders = Order::with('creator')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [

            'totalOrders'      => $totalOrders,
            'waitingOrders'    => $waitingOrders,
            'processingOrders' => $processingOrders,
            'readyOrders'      => $readyOrders,
            'completedOrders'  => $completedOrders,

            'todayRevenue'     => $todayRevenue,

            'totalMenus'       => $totalMenus,
            'totalCategories'  => $totalCategories,

            'latestOrders'     => $latestOrders,

        ]);
    }
}