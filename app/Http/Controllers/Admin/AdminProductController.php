<?php

namespace App\Http\Controllers\Admin;

use App\Classes\UploadFile;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{

    public function admincatList()
    {
        $categories = ProductCategory::orderBy('category', 'ASC')->get();
        return view('admins.products.category', [
            'categories' => $categories
        ]);
    }

    public function adminPostcat(Request $request)
    {
        $request->validate([
            'category' => ['required', 'string', 'max:200']
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['category']);
        $create = ProductCategory::create($data);

        if($create){
            return back()->with('success', 'Category successfully added');
        }
        return back()->with('failed', 'Sorry the system was unable to proces your request');
    }

    // public function adminDeletecat(Request $request)
    // {
    //    $del = ProductCategory::

    //     if($create){
    //         return back()->with('success', 'Category successfully added');
    //     }
    //     return back()->with('failed', 'Sorry the system was unable to proces your request');
    // }



    public function adminproList()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(50);
        return view('admins.products.list', [
            'products' => $products
        ]);
    }

    public function adminAddPro()
    {
        return view('admins.products.add', [
            'categories' => ProductCategory::orderBy('category', 'ASC')->get()
        ]);
    }

    public function adminUploadProImg(Request $request)
    {
        $uploadData = $request->file('file');
        if($uploadData){
            $image = UploadFile::uploadimage($uploadData, 'uploads/product-image');
        }
        return response()->json([
            'name'          => $image,
            'original_name' => $uploadData->getClientOriginalName(),
        ]);
    }

    public function adminDeleteProductImage(Request $request)
    {
        $del = ProductImage::where('id', $request->id)->delete();
        return back();
    }


    public function adminPostPro(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'sales_price' => ['required'],
            'category' => ['required'],
            'quantity' => ['required'],
            'sku' => ['required'],
            'brand' => ['required'],
            'description' => ['required'],
        ]);

        // if($request->input('document', [])[0]){
        //     return back()->with('failed', 'Please upload an image');
        // }

        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $create = Product::create($data);

        if($create){
            foreach ($request->input('document', []) as $file) {
                ProductImage::create([
                    'product_id'         => $create->id,
                    'image'        => $file,
                ]);
            }
            return back()->with('success', 'Product successfully added');
        }
        return back()->with('failed', 'Sorry the system was unable to proces your request');
    }

    public function adminSinglePro($id)
    {
        $pro = Product::find($id);
        if($pro){
            return view('admins.products.edit', [
                'pro' => $pro,
                'categories' => ProductCategory::orderBy('category', 'ASC')->get(),
                'images' => ProductImage::where('product_id', $id)->get()
            ]);
        }
        return back();
    }

    public function adminUpdatePro(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'sales_price' => ['required'],
            'category' => ['required'],
            'quantity' => ['required'],
            'brand' => ['required'],
            'description' => ['required'],
        ]);

        $single = Product::find($request->id);
        if($single){
            if($request->image)
            {
                $img = UploadFile::uploadimage($request->image, 'uploads/products');
            } else {
                $img = $single->image;
            }

            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);

            $single->fill($data);
            $single->save();

            foreach ($request->input('document', []) as $file) {
                ProductImage::create([
                    'product_id'         => $request->id,
                    'image'        => $file,
                ]);
            }
            return back()->with('success', 'Product successfully updated');
        }
        return back();
    }

    public function adminDeletePro(Request $request)
    {
        $del = Product::where('id', $request->id)->delete();
        WishList::where('product_id', $request->id)->delete();
        ProductImage::where('product_id', $request->id)->delete();
        return back()->with('success', 'Product successfully deleted');
    }

}
