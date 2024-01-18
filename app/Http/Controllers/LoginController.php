<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        if (auth::check()) {
            return redirect(url("admin/dashboard"));
        }
        return view('auth/login');

    }

    public function authenticate(Request $request){
        $this->validate($request,[
            'email' => 'required|email|min:5|max:100',
            'password' => 'required|min:5',
        ]);

        if (auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = auth::user();
            if($user->role == 1 || $user->role == 2){
                return redirect(url("admin/dashboard"));
            }else{
                return redirect(url("/"));
            }

        }

        return redirect()->back()->with('error', 'The email or password is wrong!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(url("/"));
    }
}
