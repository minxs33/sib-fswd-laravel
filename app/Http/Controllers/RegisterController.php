<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth/register');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users|min:5|max:100',
            'password' => 'required|min:5',
        ]);

        $data = Users::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => 3,
            "avatar" => "default.jpg"
        ]);

        if($data){
            return redirect(url("login"))->with('success', 'Sign Up complete, you can now login');
        } else {
            return redirect()->back()->with('error', 'Sign Up error, please try again');
        }
    }
}
