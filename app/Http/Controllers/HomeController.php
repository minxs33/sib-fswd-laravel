<?php

namespace App\Http\Controllers;

use App\Models\Carousels;
use App\Models\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // $users = Users::join("roles", "users.role", "=", "roles.id")->get(["users.*","roles.role_name"]);
        // return view("pert_22", array(
        //     "users" => $users
        // ));
    public function index(){
        $carousels = Carousels::limit(4)->get();
        $category_1 = array();
        
        $randomNames = ["Product A", "Product B", "Product C", "Product D", "Product E"];
        $minPrice = 1000;
        $maxPrice = 500000;

        $image_url = "http://placehold.it/1200x400/cccccc/999999";
        
        $category_1 = [
            [
                "id" => 1,
                "name" => "Product A",
                "description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi officiis in sed repellat pariatur commodi ullam, autem porro mollitia odio!",
                "price" => 20000,
                "discount" => 0,
                "image_url" => $image_url,
            ],
        ];
        $lastItem1 = $category_1[0];

        for ($i = 1; $i <= 15; $i++) {
            $newItem = $lastItem1;
            $newItem['id'] = $i;
            $newItem['category'] = "Category One";
            $newItem['name'] = $randomNames[array_rand($randomNames)];
            $newItem['price'] = rand($minPrice, $maxPrice);
            $newItem['discount'] = rand(0,20);
            $newItem['image_url'] = $image_url;
            $category_1[] = $newItem;
        }

        $category_2 = [
            [
                "id" => 1,
                "name" => "Product C",
                "description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi officiis in sed repellat pariatur commodi ullam, autem porro mollitia odio!",
                "price" => 20000,
                "discount" => 15,
                "image_url" => $image_url,
            ],
        ];


        $lastItem2 = $category_2[0];
        
        for ($i = 1; $i <= 15; $i++) {
            $newItem = $lastItem2;
            $newItem['id'] = $i;
            $newItem['category'] = "Category Two";
            $newItem['name'] = $randomNames[array_rand($randomNames)];
            $newItem['price'] = rand($minPrice, $maxPrice);
            $newItem['discount'] = rand(0,20);
            $newItem['image_url'] = $image_url;
            $category_2[] = $newItem;
        }


        return view("landing", array(
            "carousels" => $carousels,
            "category_1" => $category_1,
            "category_2" => $category_2
        ));
    }
}
