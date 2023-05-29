<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product_images;
use Illuminate\Http\Request;
use App\Models\Products;
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
        $products = Products::join("categories","products.category_id","=","categories.id")->join("users","products.created_by","=","users.id")->get(["*", "categories.name as cat_name", "products.name as prod_name","users.name as users_name"]);
        return view("admin/products/product-list", array(
            "products" => $products
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view("admin/products/product-insert", array(
            "categories" => $categories
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate_list = [
            "category_id" => "required",
            "name" => "required",
            "description" => "required",
            "price" => "required",
            "stock" => "required"
        ];

        
        $product = new Products();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        $imageFields = ["image_1", "image_2", "image_3", "image_4", "image_5"];
        // dd($request);
        foreach ($imageFields as $field) {
            if ($request->file($field)) {
                $validate_list = [
                    $field => "image|mimes:png,jpg,jpeg|max:2048",
                ];
        
                $this->validate($request,$validate_list);
        
                $uploadedFile = $request->file($field);
                $name = time().'-'.$uploadedFile->getClientOriginalName();
                Storage::putFileAs('public/images/product-images', $uploadedFile, $name);
        
                Product_images::insert([
                    "products_id" => $product->id,
                    "image_url" => $name,
                    "is_active" => 0
                ]);
            }
        }

        return redirect(url("admin/products"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
