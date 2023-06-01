<?php

namespace App\Http\Controllers;

use App\Models\Carousels;
use App\Models\Products;
use App\Models\Product_images;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // $users = Users::join("roles", "users.role", "=", "roles.id")->get(["users.*","roles.role_name"]);
        // return view("pert_22", array(
        //     "users" => $users
        // ));
    public function index(){
        $carousels = Carousels::limit(4)->get();
       
        // $product_tshirt = Products::join("categories", "products.category_id", "=", "categories.id")
        // ->where("category_id", 2)
        // ->where("status", "active")
        // ->whereHas("product_images", function ($q) {
        //     $q->select("id", "image_url");
        // })
        // ->with(["product_images" => function ($q) {
        //     $q->select("id", "image_url");
        // }])
        // ->get(["*"]);
       
        // $product_tshirt = Products::with("product_images")->where("status","active")->get();
        
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
