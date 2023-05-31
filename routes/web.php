<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
});

Route::group(["prefix"=>"admin"], function(){

    
    Route::get("/dashboard",["uses" => "AdminController@index"]);
    
    
    Route::resources([
        "products" => ProductController::class,
    ]);

    Route::resources([
        "product_images" => Product_imageController::class,
    ]);

    Route::get("/product_images/create/{id}",["uses" =>"Product_imageController@create"]);
    Route::post("/product_images/destroy/{id}",["uses" =>"Product_imageController@destroy"]);
    
    Route::group(["prefix"=>"/ajaxReq"], function(){
        Route::post("/change-product-status",["uses" => "ProductController@getStatus"]);
        Route::post("/product-image-list",["uses" => "Product_imageController@getProductImage"]);
        Route::post("/change-images-status",["uses" => "Product_imageController@updateIsActive"]);
    });
});
