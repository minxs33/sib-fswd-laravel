<?php

namespace App\Http\Controllers;

use App\Models\Carousels;
use App\Models\Categories;
use App\Models\Product_images;
use App\Models\Products;
use App\Models\Roles;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 3) {
            return redirect(url('admin/products'));
        }

        $total_products = Products::all()->count();
        $need_approval = Products::where('status', '=', 'waiting')->count();
        $active_product = Products::where('status', '=', 'active')->count();
        $images = Product_images::all()->count();
        $total_carousels = Carousels::all()->count();
        $total_categories = Categories::all()->count();
        $total_roles = Roles::all()->count();
        $total_users = Users::all()->count();

        return view('admin/dashboard', [
            'total_products' => $total_products,
            'need_approval' => $need_approval,
            'active_product' => $active_product,
            'images' => $images,
            'total_carousels' => $total_carousels,
            'total_categories' => $total_categories,
            'total_roles' => $total_roles,
            'total_users' => $total_users,
        ]);
    }
}
