@extends('templates/admin-app')

@section('title','NAM - Edit Carousel')

@section('content')

<div class="container shadow bg-white py-3 mb-4">
<span>
    <a class="text-success" href="{{url('admin/carousels')}}"><i class="fas fa-chevron-left"></i> Back</a>
</span>
<form class="border border-light px-4 py-3 row" action="{{ url('admin/carousels/'.$carousels['id']) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h3 class="h3 mb-0 text-base fw-bold">Update Carousel</h3>
    </div>
    <hr>
    @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-4">
        <div class="d-flex gap-2 align-text-center">
            <label class="form-label" for="textAreaExample">Name<span class="text-danger">*</span>
            </label>
            @if($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="name" value="{{$carousels['name']}}">
    </div>

    <div class="mb-4">
        
        <div class="d-flex gap-2 align-text-center">
            <label class="form-label" for="textAreaExample">Description<span class="text-danger">*</span></label>
            @if($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
        </div>
        <textarea id="defaultSubscriptionFormPassword" class="form-control" name="description">{{$carousels['description']}}</textarea>
    </div>

    <div class="mb-4">
        <div class="d-flex gap-2 align-text-center">
            <label class="form-label" for="textAreaExample">Url<span class="text-danger">*</span>
            </label>
            @if($errors->has('url'))
                <div class="text-danger">{{ $errors->first('url') }}</div>
            @endif
        </div>
        <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="url" value="{{$carousels['url']}}">
    </div>

    <div class="mb-4">
        <div class="d-flex gap-2 align-text-center">
            <label for="formFile" class="form-label">Carousel image</label>
            @if($errors->has('image_url'))
                <div class="text-danger">{{ $errors->first('image_url') }}</div>
            @endif
        </div>
        <input class="form-control" name="image_url" type="file" id="formFile">
    </div>

    <div class="d-flex justify-content-end gap-2 mb-4">
        <label class="form-label" for="textAreaExample">Carousel Active Status
        </label>
        <div class="form-check form-switch">
            @if($carousels['is_active'] == 1)
                <input class="form-check-input" type="checkbox" name="carousel_status" value="1" id="flexSwitchCheckChecked" checked>
            @else
                <input class="form-check-input" type="checkbox" name="carousel_status" value="1" id="flexSwitchCheckChecked">
            @endif
            
            
        </div>
    </div>

    <div class="col-6">
        <button class="btn btn-warning btn-block" type="reset"><i class="fa-solid fa-arrows-spin"></i> Reset Input</button>
    </div>
    <div class="col-6">
        <button class="btn btn-success btn-block" type="submit"><i class="fa-solid fa-plus"></i> Submit</button>
    </div>

</form>

</div>

@endsection