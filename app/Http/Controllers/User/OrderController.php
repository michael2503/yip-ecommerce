<?php

namespace App\Http\Controllers\User;

use App\Classes\Paystack;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function checkoutView()
    {
        if(session('cart'))
        {
            $total = 0;
            foreach(session('cart') as $id => $details){
                $total += $details['price'] * $details['quantity'];
            }
            $shipFee = 1050;
            return view('users.checkout', [
                'refNum' => Auth::user()->id.Str::random(8),
                'shipFee' => $shipFee,
                'total' => $total,
                'overallTotal' => $total + $shipFee
            ]);
        }
        return back();
    }

    public function submitCheckout(Request $request)
    {
        $run = 'failed';

        if($request->payment_method == 'pay_on_delivery'){
            $run = 'success';
        } else {
            $check = Paystack::verifyTransaction($request->ref_number);
            if($check && $check->data && $check->data->status == 'success'){
                $run = 'success';
            } else {
                $run = 'failed';
            }
        }

        if($run == 'success'){
            $request['orderNumber'] = $request->ref_number;

            $carts = Session::get('cart');

            $totalSales = 0;
            $totalDeliFee = 1050;

            $newArray = array();
            foreach($carts as $id => &$details){
                $details['cartShipFee'] = 0;
                $totalSales += $details['price'] * $details['quantity'];

                $details['id'] = $id;
                array_push($newArray, $details);
            }

            $data = $request->all();
            $data['order_number'] = $request->ref_number;
            $data['product_info'] = json_encode($newArray);
            $data['user_id'] = Auth::user()->id;
            $data['total_amount'] = $totalSales;
            $data['shipping_fee'] = $totalDeliFee;

            // return $data;

            $create = Order::create($data);

            if($create){
                foreach ($carts as $id => $item) {
                    $pro = Product::find($id);
                    Product::where('id', $id)->update([
                        'sold' => $pro->sold + $item['quantity']
                    ]);
                }
                Session::forget('cart');
                return redirect()->route('getOrder')->with('success', 'Order successfully created');
            } else {
                return redirect()->back()->with('Sorry, the system is unable to process your request, please try again');
            }
        }
        return back()->with('failed', 'Sorry the system was unable to process your request');
    }


    public function addProToWishList($id)
    {
        $check = WishList::where([ ['product_id', $id], ['user_id', Auth::user()->id] ])->first();
        if($check){
            WishList::where([ ['product_id', $id], ['user_id', Auth::user()->id] ])->delete();
            return back()->with('success', 'Product successfully removed from wishlist');
        } else {
            WishList::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id
            ]);
            return back()->with('success', 'Product successfully added to wishlist');
        }
    }

    public function getWishList()
    {
        $wishlists = WishList::with('product:id,name,slug,category,old_price,sales_price')->where('user_id', Auth::user()->id)->paginate(21);
        if($wishlists){
            foreach($wishlists as $wish){
                $wish->product['image'] = null;
                $img = ProductImage::where('product_id', $wish->product_id)->first();
                if($img){
                    $wish->product['image'] = $img->image;
                }
            }
        }
        // return $wishlists;
        return view('users.wishlist', [
            'wishlists' => $wishlists
        ]);
    }


    public function getOrder()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(20);
        return view('users.orders', [
            'orders' => $orders
        ]);
    }

    public function orderDetails($id, $orderNum)
    {
        $order = Order::find($id);
        if($order->user_id == Auth::user()->id){
            if($order->order_number == $orderNum){
                return view('users.order-details', [
                    'order' => $order,
                    'products' => json_decode($order->product_info)
                ]);
            }
            return back();
        }
        return back();
    }

}
