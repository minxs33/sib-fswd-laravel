<?php

namespace App\Http\Controllers;

use App\Models\Carousels;
use App\Models\Categories;
use App\Models\Product_images;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $carousels = Carousels::where('is_active', 1)->limit(4)->get();

        $product_tshirt = Products::with('product_images')->where('category_id', 2)->where('status', 'active')->withCount([
            'product_images',
            'product_images as product_images_count' => function ($query) {
                $query->where('is_active', '=', 1);
            }])->orderBy('products.id', 'DESC')->limit(12)->get(['products.*', 'products.id as prod_id', 'products.name as prod_name']);

        $product_hoodie = Products::with('product_images')->where('category_id', 3)->where('status', 'active')->withCount([
            'product_images',
            'product_images as product_images_count' => function ($query) {
                $query->where('is_active', '=', 1);
            }])->orderBy('products.id', 'DESC')->limit(12)->get(['products.*', 'products.id as prod_id', 'products.name as prod_name']);

        $products = Products::with('product_images')->where('status', 'active')->orderBy('products.id', 'DESC')->select(['products.*', 'products.id as prod_id', 'products.name as prod_name'])->paginate(30);

        $categories = Categories::all();

        // $products = Products::with("product_images")->where("status","active")->withCount([
        // "product_images",
        // "product_images as product_images_count" => function ($query) {
            //     $query->where("is_active", "=", 1);
        // }])->orderBy("products.id","DESC")->select(["products.*", "products.id as prod_id","products.name as prod_name"])->paginate(30);

        // dd($products->toArray());
        if ($request->ajax()) {
            return view('templates/includes/product-card', [
                'product' => $products,
            ]);
        }
        // dd($product_tshirt->toArray());

        return view('landing', [
            'carousels' => $carousels,
            'tshirt' => $product_tshirt,
            'hoodie' => $product_hoodie,
            'product' => $products,
            'categories' => $categories,
        ]);
    }

    public function getByCategory(Request $request)
    {
        if ($request->category == 'all') {
            $products = Products::with('product_images')->where('status', 'active')->orderBy('products.id', 'DESC')->select(['products.*', 'products.id as prod_id', 'products.name as prod_name'])->paginate(30);
        } else {
            $products = Products::with('product_images')->where('category_id', $request->category)->where('status', 'active')->orderBy('products.id', 'DESC')->select(['products.*', 'products.id as prod_id', 'products.name as prod_name'])->paginate(30);
        }

        return view('templates/includes/product-card', [
            'product' => $products,
        ]);
    }
}
