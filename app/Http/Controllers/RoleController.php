<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RoleController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::orderBy("id","ASC")->get();
        return view("admin/roles/role-list", array(
            "roles" => $roles
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/roles/role-insert");
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
            "role_name" => "required|min:3|max:100",
        ]);

        $roles = new roles();
        $roles->role_name = $request->role_name;

        if($roles->save()){
            return redirect(url("admin/roles"))->with('success', 'The role has been succesfully added!');
        }else{
            return redirect(url("admin/roles"))->with('error', 'Something went wrong, the role failed to insert!');
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
        $roles = roles::find($id);
        return view("admin/roles/role-update", array(
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
            "role_name" => "required|min:3|max:100",
        ]);

        $roles = roles::find($id);

        if($roles->update(["role_name" => $request->role_name])){
            return redirect(url("admin/roles"))->with('success', 'The role has been succesfully updated!');
        }else{
            return redirect(url("admin/roles"))->with('error', 'Something went wrong, the role failed to update!');
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
        $roles = roles::find($id);

        if($roles->delete()){
            return redirect(url("admin/roles"))->with('success', 'The role has been succesfully deleted!');
        }else{
            return redirect(url("admin/roles"))->with('error', 'Something went wrong, the role failed to deleted!');
        }
    }
}
