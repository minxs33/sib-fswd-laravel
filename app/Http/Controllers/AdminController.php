<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if(Auth::user()->role == 3){
            return redirect(url("admin/products"));
        }
        return view("admin/dashboard");
    }
}
