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

        $categories = Categories::all();

        // $products = Products::with("product_images")->where("status","active")->withCount([
        // "product_images",
        // "product_images as product_images_count" => function ($query) {
            //     $query->where("is_active", "=", 1);
        // }])->orderBy("products.id","DESC")->select(["products.*", "products.id as prod_id","products.name as prod_name"])->paginate(30);

        // dd($products->toArray());
        $query = Products::with('product_images')->where('status', 'active')->orderBy('products.id', 'DESC')->select(['products.*', 'products.id as prod_id', 'products.name as prod_name']);

        if ($request->ajax()) {
            if ($request->category == 'all') {
                if ($request->min && $request->max) {
                    $query->where('price', '>=', $request->min)
                        ->where('price', '<=', $request->max);
                }
            } elseif ($request->category) {
                $query->where('category_id', $request->category);
                if ($request->min && $request->max) {
                    $query->where('price', '>=', $request->min)
                        ->where('price', '<=', $request->max);
                }
            }
            $products = $query->paginate(30);

            return view('templates/includes/product-card', [
                'product' => $products,
            ]);
        }
        $products = $query->paginate(30);

        return view('landing', [
            'carousels' => $carousels,
            'tshirt' => $product_tshirt,
            'hoodie' => $product_hoodie,
            'product' => $products,
            'categories' => $categories,
        ]);
    }

    public function search(Request $request)
    {
        $query = Products::with('product_images')->where('status', 'active')->where('name', 'LIKE', '%'.$request->keyword.'%')->orderBy('products.id', 'DESC')->select(['products.*', 'products.id as prod_id', 'products.name as prod_name']);

        if ($request->ajax()) {
            if ($request->category == 'all') {
                if ($request->min && $request->max) {
                    $query->where('total_price', '>=', $request->min)
                        ->where('total_price', '<=', $request->max);
                }
            } elseif ($request->category) {
                $query->where('category_id', $request->category);
                if ($request->min && $request->max) {
                    $query->where('total_price', '>=', $request->min)
                        ->where('total_price', '<=', $request->max);
                }
            }
            $products = $query->paginate(28);

            return view('templates/includes/product-card-search', [
                'product' => $products,
            ]);
        }
        $products = $query->paginate(28);

        $categories = Categories::all();

        return view('product-search', [
            'product' => $products,
            'title' => $request->keyword,
            'categories' => $categories,
            'keyword' => $request->keyword,
        ]);
    }
}
