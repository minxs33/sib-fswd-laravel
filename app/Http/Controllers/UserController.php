<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::join("roles","roles.id","=","users.role")->orderBy("id","ASC")->get(["users.*", "roles.role_name"]);

        return view("admin/users/user-list", array(
            "users" => $users
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::all('*');
        return view("admin/users/user-insert", array(
            "roles" => $roles
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:100',
            'password' => 'required|min:5',
            'role' => 'required|integer',
        ]);

        $users = new users();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->role = $request->role;

        if ($request->file("avatar")) {
            if($this->validate($request,[
                "avatar" => "image|mimes:png,jpg,jpeg|max:2048"
            ])){
                $uploadedFile = $request->file("avatar");
                
                $name = time().'-'.$uploadedFile->getClientOriginalName();
                $name = str_replace(' ', '-', $name);
                $name = str_replace('_', '-', $name);
                $name = preg_replace('/[^a-zA-Z0-9-.]/', '', $name);
                $name = preg_replace('/-+/', '-', $name);
    
                Storage::putFileAs('public/images/avatar', $uploadedFile, $name);
                $users->avatar = $name;
            }else{
                return redirect()->back()->with(["error" => "Avatar validation failed, avatar must be png, jpg or jpeg and 2mb or less in size"]);
            }
        }

        if($users->save()){
            return redirect(url("admin/users"))->with('success', 'The user has been succesfully added!');
        }else{
            return redirect(url("admin/users"))->with('error', 'Something went wrong, the user failed to insert!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = Users::join("roles","roles.id","=","users.role")->where("users.id",$id)->select(["users.*","roles.role_name"])->find($id);
        $roles = Roles::all();
        // dd($users->toArray());
        return view("admin/users/user-update", array(
            "users" => $users,
            "roles" => $roles
        ));
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
        $this->validate($request,[
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:100',
            'role' => 'required|integer',
        ]);

        $users = users::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->role = $request->role;

        if($request->password){
            $users->password = Hash::make($request->password);
        }

        if($request->file('avatar')){
            if($this->validate($request,[
                "avatar" => "image|mimes:png,jpg,jpeg|max:2048"
            ])){
                if($users['avatar'] != "default.jpg"){
                    Storage::delete("public/images/avatar/".$users['avatar']);
                }
                    $uploadedFile = $request->file("avatar");
                    
                    $name = time().'-'.$uploadedFile->getClientOriginalName();
                    $name = str_replace(' ', '-', $name);
                    $name = str_replace('_', '-', $name);
                    $name = preg_replace('/[^a-zA-Z0-9-.]/', '', $name);
                    $name = preg_replace('/-+/', '-', $name);
                    
                    Storage::putFileAs('public/images/avatar', $uploadedFile, $name);
                    $users->avatar = $name;
            }else{
                return redirect()->back()->with(["error" => "Avatar validation failed, avatar must be png, jpg or jpeg and 2mb or less in size"]);
            }
        }

        if($users->update()){
            return redirect(url("admin/users"))->with('success', 'The user has been succesfully updated!');
        }else{
            return redirect(url("admin/users"))->with('error', 'Something went wrong, the user failed to update!');
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
        $users = users::find($id);

        if(!empty($users['avatar'] && $users['avatar'] != "default.jpg")){
            if(!Storage::delete("public/images/avatar/".$users['avatar'])){
                return redirect(url("admin/users"))->with('error', 'Something went wrong, the user avatar failed to delete!');
            }
        }
        
        if($users->delete()){
            return redirect(url("admin/users"))->with('success', 'The user has been succesfully deleted!');
        }else{
            return redirect(url("admin/users"))->with('error', 'Something went wrong, the user failed to delete!');
        }
    }
}
