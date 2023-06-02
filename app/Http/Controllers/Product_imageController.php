<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_images;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;

class Product_imageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $products = Products::join("categories","products.category_id","=","categories.id")->where("products.id",$id)->first(["*","products.id as prod_id","categories.name as cat_name","products.name as prod_name"]);

        return view ("admin/product-images/product-image-insert", array(
            "products" =>  $products,
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
        $imageFields = [];

        for ($i = 1; $i <= $request->image_count; $i++) {
            $imageFields[] = "image_".$i;
        }

        foreach ($imageFields as $field) {
            echo $field;
            if ($request->file($field)) {
                $validate_list = [
                    $field => "image|mimes:png,jpg,jpeg|max:2048",
                ];
        
                if($this->validate($request,$validate_list)){
                    $uploadedFile = $request->file($field);
                    $name = time().'-'.$uploadedFile->getClientOriginalName();
                    Storage::putFileAs('public/images/product-images', $uploadedFile, $name);
            
                    Product_images::insert([
                        "products_id" => $request->products_id,
                        "image_url" => $name,
                        "is_active" => 0
                    ]);
                }else{
                    return redirect()->back()->with(["error" => "Image validation failed, image must be png, jpg or jpeg and 2mb or less in size"]);
                }
        
               
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
        $product_images = Product_images::find($id);

        $old_image = $product_images::find($id)->image_url;
        Storage::delete("public/images/product-images/".$old_image);
        // unlink("public/images/product-images/".$old_image);        
        $product_images->delete();
        return response()->json($product_images);

        // $products_id = Products::where("id",$requ)
    }

    public function getProductImage(Request $request){
        $id = $request->id;
        $product_images = Product_images::where("products_id", $id)->get();
        
        if ($product_images) {
            return response()->json($product_images);
        } else {
            return response()->json(["message" => "Product not found"], 404);
        }
    
    }

    public function updateIsActive(Request $request){
        $id = $request->id;
        $product_images = Product_images::where("id", $id)->first(['is_active']);
        
        if ($product_images) {
            if ($product_images['is_active'] == 0) {
                Product_images::where("id",$id)->update(["is_active" => 1]);
            } else {
                Product_images::where("id",$id)->update(["is_active" => 0]);
            }
            return response()->json(["message" => "success"]);
        } else {
            return response()->json(["message" => "Product not found"], 404);
        }

            
    }
}
