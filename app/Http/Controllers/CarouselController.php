<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousels;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousels = Carousels::orderBy("id","ASC")->get();
        return view("admin/carousels/carousel-list", array(
            "carousels" => $carousels
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/carousels/carousel-insert");
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
            "name" => "required|min:3|max:100",
            "description" => "required|min:5",
            "url" => "required|max:100",
            "image_url" => "image|required|mimes:png,jpg,jpeg|max:4096",
        ]);


        $carousels = new Carousels();
        $carousels->name = $request->name;
        $carousels->description = $request->description;
        $carousels->url = $request->url;
        $carousels->is_active = $request->carousel_status == "1" ? 1 : 0;
        
        if ($request->file("image_url")) {

            $uploadedFile = $request->file("image_url");
                
            $name = time().'-'.$uploadedFile->getClientOriginalName();
            $name = str_replace(' ', '-', $name);
            $name = str_replace('_', '-', $name);
            $name = preg_replace('/[^a-zA-Z0-9-.]/', '', $name);
            $name = preg_replace('/-+/', '-', $name);

            Storage::putFileAs('public/images/carousels', $uploadedFile, $name);
            $carousels->image_url = $name;
        }
        
        if($carousels->save()){
            return redirect(url("admin/carousels"))->with('success', 'The carousels has been succesfully added!');
        }else{
            return redirect(url("admin/carousels"))->with('error', 'Something went wrong, the carousels failed to insert!');
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
        $carousels = Carousels::find($id);
        return view("admin/carousels/carousel-update", array(
            "carousels" => $carousels
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
            "name" => "required|min:3|max:100",
            "description" => "required|min:5",
            "url" => "required|max:100",
            "image_url" => "image|mimes:png,jpg,jpeg|max:4096",
        ]);

        $carousels = Carousels::find($id);
        $carousels->name = $request->name;
        $carousels->description = $request->description;
        $carousels->url = $request->url;
        $carousels->is_active = $request->carousel_status == "1" ? 1 : 0;


        if ($request->file("image_url")) {
            Storage::delete("public/images/carousels/".$carousels['image_url']);

            $uploadedFile = $request->file("image_url");
                
            $name = time().'-'.$uploadedFile->getClientOriginalName();
            $name = str_replace(' ', '-', $name);
            $name = str_replace('_', '-', $name);
            $name = preg_replace('/[^a-zA-Z0-9-.]/', '', $name);
            $name = preg_replace('/-+/', '-', $name);

            Storage::putFileAs('public/images/carousels', $uploadedFile, $name);
            $carousels->image_url = $name;
        }
        if($carousels->update()){
            return redirect(url("admin/carousels"))->with('success', $carousels->name.' has been succesfully updated!');
        }else{
            return redirect(url("admin/carousels"))->with('error', 'Something went wrong, the carousels failed to update!');
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
        $carousels = Carousels::find($id);
        $delete = Storage::delete("public/images/carousels/".$carousels['image_url']);

        if($delete){
            $carousels->delete();
            return redirect(url("admin/carousels"))->with('success', 'The carousels has been succesfully deleted!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong, the carousels failed to delete!');
        }
        

    }

    public function getStatus($id)
    {
        // $id = $request->id;
        $carousels = Carousels::find($id);

        if ($carousels) {
            $newStatus = $carousels->is_active == 1 ? 0 : 1;
            $carousels->update(["is_active" => $newStatus]);
            return response()->json(["message" => "success"]);
        } else {
            return response()->json(["message" => "Carousels not found"], 404);
        }
    }
}
