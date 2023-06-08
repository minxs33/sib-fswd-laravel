<?php

use App\Http\Controllers\CarouselController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

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

Route::resources([
    "login" => LoginController::class,
    "register" => RegisterController::class,
]);

Route::post("login/authenticate",["uses" =>"LoginController@authenticate"]);
Route::post("logout",["uses" => "LoginController@logout"]);

Route::group(["prefix"=>"admin", 'middleware' => ['auth']], function(){

    Route::get("/dashboard",["uses" => "AdminController@index"]);
    
    Route::middleware("role:1")->group(function(){
        
        Route::resources([
            "products" => ProductController::class,
            "product_images" => Product_imageController::class,
            "carousels" => CarouselController::class,
            "categories" => CategoriesController::class,
            "roles" => RoleController::class,
            "users" => UserController::class,
        ]);
        
        Route::get("/product_images/create/{id}",["uses" =>"Product_imageController@create"]);
        
        Route::group(["prefix"=>"/ajaxReq"], function(){
            Route::post("/change-product-status",["uses" => "ProductController@getStatus"]);
            Route::post("/change-carousel-status/{id}",["uses" => "ProductController@getStatus"]);
            Route::post("/change-images-status",["uses" => "Product_imageController@updateIsActive"]);
        });

    });

    Route::middleware("role:1|2")->group(function(){
        Route::group(["prefix"=>"/ajaxReq"], function(){
            Route::post("/product-image-list",["uses" => "Product_imageController@getProductImage"]);
        });
    });

    Route::middleware("role:1|2|3")->group(function(){
        Route::get("/products",["uses" => "ProductController@index"]);
    });
});
