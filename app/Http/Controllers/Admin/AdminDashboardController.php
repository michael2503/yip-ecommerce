<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function adminDashboard()
    {
        $allUsers = User::where('account_type', 'user')->count();
        $allOrders = Order::count();
        $allproducts = Product::count();
        $processingOrder = Order::where([ ['status', '!=', 'cancelled'], ['status', '!=', 'delivered'] ])->count();

        return view('admins.dashboard', [
            'allUsers' => $allUsers,
            'allOrders' => $allOrders,
            'allproducts' => $allproducts,
            'processingOrder' => $processingOrder,
        ]);
    }

}
