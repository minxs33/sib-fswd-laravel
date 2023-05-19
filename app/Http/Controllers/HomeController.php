<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $users = Users::join("roles", "users.role", "=", "roles.id")->get(["users.*","roles.role_name"]);
        return view("pert_22", array(
            "users" => $users
        ));
    }
}
