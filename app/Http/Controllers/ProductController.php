<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product_images;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::join('categories', 'products.category_id', '=', 'categories.id')->join('users', 'products.created_by', '=', 'users.id')->where('status', '!=', 'waiting')->select(['products.*', 'products.id as prod_id', 'categories.name as cat_name', 'products.name as prod_name', 'users.name as users_name'])->orderBy('prod_id', 'ASC')->withCount('product_images')->get();

        $products_waiting = Products::where('status', '=', 'waiting')->count();

        // dd($products_waiting);
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            return view('admin/products/product-list', [
                'products' => $products,
                'products_waiting' => $products_waiting,
            ]);
        } elseif (Auth::user()->role == 3) {
            return view('admin/products/products-catalogue', [
                'products' => $products,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();

        return view('admin/products/product-insert', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:3',
            'price' => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            'stock' => 'required|integer',
        ]);

        $product = new Products();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->total_price = $request->price - (($request->price / 100) * $request->discount);
        $product->stock = $request->stock;
        if (Auth::user()->role == 1) {
            $product->status = $request->status == '1' ? 'active' : 'non-active';
        } elseif (Auth::user()->role == 2) {
            $product->status = 'waiting';
        }
        $product->save();

        $imageFields = [];

        for ($i = 1; $i <= $request->image_count; ++$i) {
            $imageFields[] = 'image_'.$i;
            $imageStatus[] = 'image_status_'.$i;
        }

        // dd($request);
        foreach ($imageFields as $i => $field) {
            echo $field;
            if ($request->file($field)) {
                $validate_list = [
                    $field => 'image|mimes:png,jpg,jpeg|max:2048',
                ];

                $image_status = $imageStatus[$i];

                if ($this->validate($request, $validate_list)) {
                    $uploadedFile = $request->file($field);

                    $name = time().'-'.$uploadedFile->getClientOriginalName();
                    $name = str_replace(' ', '-', $name);
                    $name = str_replace('_', '-', $name);
                    $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
                    $name = preg_replace('/-+/', '-', $name);

                    Storage::putFileAs('public/images/product-images', $uploadedFile, $name);

                    Product_images::insert([
                        'products_id' => $product->id,
                        'image_url' => $name,
                        'is_active' => $request->$image_status == '1' ? 1 : 0,
                    ]);
                } else {
                    return redirect()->back()->with(['error' => 'Image validation failed, image must be png, jpg or jpeg and 2mb or less in size']);
                }
            }
        }

        return redirect(url('admin/products'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Products::with('product_images')->join('categories', 'products.category_id', '=', 'categories.id')->select(['products.*', 'categories.name as cat_name', 'products.name as prod_name'])->find($id);
        // dd($products->toArray());

        $recommendation = Products::with('product_images')->where('category_id', $products['category_id'])->where('status', 'active')->withCount([
            'product_images',
            'product_images as product_images_count' => function ($query) {
                $query->where('is_active', '=', 1);
            }])->inRandomOrder()->limit(12)->get(['products.*', 'products.id as prod_id', 'products.name as prod_name']);

        return view('product-show', [
            'title' => $products->name,
            'products' => $products,
            'recommendation' => $recommendation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::join('categories', 'products.category_id', '=', 'categories.id')->select(['products.*', 'products.id as prod_id', 'products.name as prod_name', 'categories.name as cat_name', 'categories.id as cat_id'])->find($id);
        $categories = Categories::all();

        return view('admin/products/product-update', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:3',
            'price' => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            'stock' => 'required|integer',
            'discount' => 'integer',
        ]);

        $product = Products::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->total_price = $request->price - (($request->price / 100) * $request->discount);
        $product->stock = $request->stock;
        $product->status = $request->status != null ? 'active' : 'non-active';
        $product->update();

        // dd($request);
        return redirect(url('admin/products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_images = Product_images::where('products_id', $id)->get();
        foreach ($product_images as $row) {
            Storage::delete('public/images/product-images/'.$row['image_url']);
        }
        Product_images::where('products_id', $id)->delete();
        Products::find($id)->delete();

        return redirect(url('admin/products'));
    }

    public function getStatus(Request $request)
    {
        $id = $request->id;
        $product = Products::where('id', $id)->first(['status']);

        if ($product) {
            if ($product['status'] == 'active') {
                Products::where('id', $id)->update(['status' => 'non-active']);
            } else {
                Products::where('id', $id)->update(['status' => 'active']);
            }

            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function productConfirmation(Request $request)
    {
        $products = Products::join('categories', 'products.category_id', '=', 'categories.id')->join('users', 'products.created_by', '=', 'users.id')->where('status', '=', 'waiting')->select(['products.*', 'products.id as prod_id', 'categories.name as cat_name', 'products.name as prod_name', 'users.name as users_name'])->orderBy('prod_id', 'ASC')->withCount('product_images')->get();

        if ($request->ajax()) {
            if ($request->get_products_id) {
                $product = Products::with('product_images')->join('categories', 'products.category_id', '=', 'categories.id')->join('users', 'products.created_by', '=', 'users.id')->select(['products.*', 'products.id as prod_id', 'categories.name as cat_name', 'products.name as prod_name', 'users.name as users_name'])->find($request->get_products_id);

                if ($product) {
                    return response()->json($product);
                } else {
                    return response()->json(['error' => 'Product not found'], 404);
                }
            } elseif ($request->approve_products_id) {
                $product = Products::where('id', $request->approve_products_id)->update([
                    'status' => 'non-active',
                ]);

                if ($product) {
                    return response()->json($product);
                } else {
                    return response()->json(['error' => 'Product not found'], 404);
                }
            } elseif ($request->deny_products_id) {
                $product_images = Product_images::where('products_id', $request->deny_products_id)->get();
                foreach ($product_images as $row) {
                    Storage::delete('public/images/product-images/'.$row['image_url']);
                }
                Product_images::where('products_id', $request->deny_products_id)->delete();
                Products::find($request->deny_products_id)->delete();
            }

            return view('templates/includes/product-admin-card', [
                'products' => $products,
            ]);
        }

        return view('admin/products/product-confirmation', [
            'products' => $products,
        ]);
    }
}
