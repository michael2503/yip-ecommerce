<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

    public function adminOrder()
    {
        $orders = Order::with('user:id,name')->orderBy('id', 'DESC')->paginate(20);
        return view('admins.orders.lists', [
            'orders' => $orders
        ]);
    }


    public function adminOrderDetails($id, $orderNum)
    {
        $order = Order::find($id);
        if($order->order_number == $orderNum){
            return view('admins.orders.details', [
                'order' => $order,
                'products' => json_decode($order->product_info)
            ]);
        }
        return back();
    }


    public function updateOrderStatus(Request $request)
    {
        Order::where('id', $request->staID)->update([
            'status' => $request->staAction
        ]);

        return back()->with('success', 'Update is successful');
    }

}
