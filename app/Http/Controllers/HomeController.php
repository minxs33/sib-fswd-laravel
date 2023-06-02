<?php

namespace App\Http\Controllers;

use App\Models\Carousels;
use App\Models\Products;
use App\Models\Product_images;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $carousels = Carousels::where("is_active",1)->limit(4)->get();
        
        $product_tshirt = Products::with("product_images")->where("category_id",2)->where("status","active")->withCount([
            "product_images", 
            "product_images as product_images_count" => function ($query) {
                $query->where("is_active", "=", 1);
            }])->orderBy("products.id","DESC")->limit(12)->get(["*", "products.id as prod_id","products.name as prod_name"]);
        
        $product_hoodie = Products::with("product_images")->where("category_id",3)->where("status","active")->withCount([
            "product_images", 
            "product_images as product_images_count" => function ($query) {
                $query->where("is_active", "=", 1);
            }])->orderBy("products.id","DESC")->limit(12)->get(["*", "products.id as prod_id","products.name as prod_name"]);

        // dd($product_tshirt->toArray());
        return view("landing", array(
            "carousels" => $carousels,
            "tshirt" => $product_tshirt,
            "hoodie" => $product_hoodie

        ));
    }
}
