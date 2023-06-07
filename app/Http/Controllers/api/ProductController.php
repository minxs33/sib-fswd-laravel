<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();

        return response()->json([
            'success' => true,
            'message' => 'Product Lists',
            'data' => $products
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            "category_id" => "required",
            "name" => "required|min:3|max:100",
            "description" => "required|min:3",
            "price" => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            "stock" => "required|integer",
            "discount" => "integer",
            "status" => "in:active,non-active"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => "The product sent is invalid",
                'data' => $validator->errors()
            ], 422);
        }else{
            $product = new Products();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->total_price = $request->price - (($request->price / 100) * $request->discount);
            $product->stock = $request->stock;
            $product->status = $request->status;
            $product->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Product added successfully',
                'data' => $product
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);

        if ($product) {
            return response()->json([
                'success' => true,
                'message' => 'Product detail',
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product detail not found',
                'data' => ''
            ], 404);
        }
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
        $validator = Validator($request->all(), [
            "category_id" => "required",
            "name" => "required|min:3|max:100",
            "description" => "required|min:3",
            "price" => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            "stock" => "required|integer",
            "discount" => "integer",
            "status" => "in:active,non-active"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => "The product sent is invalid",
                'data' => $validator->errors()
            ], 422);
        }else{
            $product = Products::find($id);

            if($product) {
                    $product->category_id = $request->category_id;
                    $product->name = $request->name;
                    $product->description = $request->description;
                    $product->price = $request->price;
                    $product->discount = $request->discount;
                    $product->total_price = $request->price - (($request->price / 100) * $request->discount);
                    $product->stock = $request->stock;
                    $product->status = $request->status;
                    $product->update();

                    return response()->json([
                        'success' => true,
                        'message' => 'Product update successful',
                        'data' => Products::find($id)
                    ], 201);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                    'data' => ''
                ], 404);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);

        if ($products) {
            $products->delete();

            return response()->json([
                'success' => true,
                'message' => 'The product has been deleted successfully',
                'data' => null
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'The product not found',
                'data' => ''
            ], 404);
        }
    }
}
