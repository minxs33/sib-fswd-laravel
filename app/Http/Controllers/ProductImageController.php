<?php

namespace App\Http\Controllers;

use App\Models\product_image;
use App\Http\Requests\Storeproduct_imageRequest;
use App\Http\Requests\Updateproduct_imageRequest;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storeproduct_imageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeproduct_imageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product_image  $product_image
     * @return \Illuminate\Http\Response
     */
    public function show(product_image $product_image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product_image  $product_image
     * @return \Illuminate\Http\Response
     */
    public function edit(product_image $product_image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateproduct_imageRequest  $request
     * @param  \App\Models\product_image  $product_image
     * @return \Illuminate\Http\Response
     */
    public function update(Updateproduct_imageRequest $request, product_image $product_image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product_image  $product_image
     * @return \Illuminate\Http\Response
     */
    public function destroy(product_image $product_image)
    {
        //
    }
}
