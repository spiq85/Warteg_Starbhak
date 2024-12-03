<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalMenus = Menu::count();
        $totalOrders = Order::count();

        return view('dashboard.index', compact('totalCategories', 'totalMenus', 'totalOrders'));
    }
}
