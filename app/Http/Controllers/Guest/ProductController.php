<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function productList()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(15);
        if($products){
            foreach($products as $pro){
                $pro['isWish'] = false;
                $pro['image'] = null;
                $img = ProductImage::where('product_id', $pro->id)->first();
                if($img){
                    $pro['image'] = $img->image;
                }
                if(Auth::user()){
                    $check = WishList::where([ ['product_id', $pro->id], ['user_id', Auth::user()->id] ])->first();
                    if($check){
                        $pro['isWish'] = true;
                    }
                }
            }
        }
        return view('guest.products', [
            'categories' => ProductCategory::orderBy('category', 'ASC')->get(),
            'products' => $products,
            'theTypeValue' => '',
            'maxPrice' => Product::max('sales_price'),
        ]);
    }

    public function productDetails($id, $slug)
    {
        $pro = Product::find($id);
        if($pro && $pro->slug == $slug)
        {
            if(Auth::user()){
                $pro['isWish'] = false;
                $check = WishList::where([ ['product_id', $pro->id], ['user_id', Auth::user()->id] ])->first();
                if($check){
                    $pro['isWish'] = true;
                }
            }
            return view('guest.product-details', [
                'categories' => ProductCategory::orderBy('category', 'ASC')->get(),
                'pro' => $pro,
                'images' => ProductImage::where('product_id', $id)->get()
            ]);
        }
        return back();
    }


    public function productFilter(Request $request)
    {
        $requestKeys = collect($request->all())->keys();

        $theType = '';
        $theTypeValue = '';
        $products = [];

        if($request->type == 'search'){
            $products = Product::where([
                ['name', 'LIKE', "%$request->value%"]
            ])->orderBy('id', 'DESC')->paginate(15)->withQueryString();
            $theType = 'Search Result';
        } else {
            $theType = $request->type;
            $theTypeValue = $request->value;

            if($request->type == 'category'){
                $products = Product::where([
                    ['category', $request->value]
                ])->orderBy('id', 'DESC')->paginate(15)->withQueryString();
            }
            if($request->type == 'price'){
                $price = explode('-', $request->value);
                $products = Product::where([
                    ['sales_price', '>=', $price[0]], ['sales_price', '<=', $price[1]]
                ])->orderBy('id', 'DESC')->paginate(15)->withQueryString();
                $theType = "Price: ₦".number_format($price[0])." - ₦".number_format($price[1]);
            }
        }

        if($products){
            foreach($products as $pro){
                $pro['isWish'] = false;
                $pro['image'] = null;
                $img = ProductImage::where('product_id', $pro->id)->first();
                if($img){
                    $pro['image'] = $img->image;
                }
                if(Auth::user()){
                    $check = WishList::where([ ['product_id', $pro->id], ['user_id', Auth::user()->id] ])->first();
                    if($check){
                        $pro['isWish'] = true;
                    }
                }
            }
        }

        // return $theTypeValue;
        return view('guest.products', [
            'products' => $products,
            'categories' => ProductCategory::orderBy('category', 'ASC')->get(),
            'serResult' => ucwords($theType),
            'theTypeValue' => $theTypeValue,
            'maxPrice' => Product::max('sales_price'),
        ]);
    }


    public function shoppingCart()
    {
        return view('guest.shopping-carts', [

        ]);
    }

    public function addProductTocart($id)
    {
        $product = Product::findOrFail($id);
        $pImage = ProductImage::where('product_id', $id)->first();

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->sales_price,
                "image" => $pImage->image,
                "category" => $product->category,
                "sku" => $product->sku,
            ];
        }
        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully!');
    }

    public function updateProductCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
        // return back();
    }

    public function deleteCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function clearAllCart()
    {
        session()->forget('cart');
        return back()->with('success', 'Your cart is successfully cleared');
    }

}
