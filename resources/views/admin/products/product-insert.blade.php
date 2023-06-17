@extends('templates/admin-app')

@section('title','NAM - Add Product')

@section('content')

<div class="container shadow bg-white py-3 mb-4">
<span>
    <a class="text-success" href="{{url('admin/products')}}"><i class="fas fa-chevron-left"></i> Back</a>
</span>
<form class="border border-light px-4 py-3 row" action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h3 class="h3 mb-0 text-base fw-bold">Add Product</h3>
    </div>
    <hr>
    @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-3">
        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Category<span class="text-danger">*</span></label>
            @if($errors->has('category_id'))
                <div class="text-danger">{{ $errors->first('category_id') }}</div>
            @endif
            <select name="category_id" class="form-select">
                    <option disabled selected>Choose a category</option>
                @foreach($categories as $row)
                    <option value="{{$row['id']}}">{{$row['name']}}</option>
                @endforeach
            </select>
        </div>    

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Name<span class="text-danger">*</span>
            </label>
            @if($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="name">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Description<span class="text-danger">*</span></label>
            @if($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
            <textarea id="defaultSubscriptionFormPassword" class="form-control" name="description"></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Price (Rp)<span class="text-danger">*</span></label>
            @if($errors->has('price'))
                <div class="text-danger">{{ $errors->first('price') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="price">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Discount (%)</label>
            @if($errors->has('discount'))
                <div class="text-danger">{{ $errors->first('discount') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="discount">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Stock<span class="text-danger">*</span></label>
            @if($errors->has('stock'))
                <div class="text-danger">{{ $errors->first('stock') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="stock">
        </div>

        @if(Auth::user()->role == 1)
        <div class="mb-4">
            <label class="form-label mb-0" for="textAreaExample">Product Status</label><br>
            <div class="badge badge-info mb-3" for="textAreaExample">Determines wether or not the product is displayed</div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status[]" value="1" id="flexSwitchCheckChecked">
            </div>
        </div>
        @endif

        <div class="mb-4">
            <label class="form-label mb-0" for="textAreaExample">Product Images</label><br>
            <div class="badge badge-info mb-4">Turn on the <i class="fas fa-toggle-on"></i> if you want the image to be show on the product. You can organize the product images in the product table in the image column with <i class="fas fa-image small"></i> icon as an indicator.</div>
            <select class="form-select photoCount" name="image_count">
                    <option selected value="1">1 Image</option>
                    <option value="2">2 Images</option>
                    <option value="3">3 Images</option>
                    <option value="4">4 Images</option>
                    <option value="5">5 Images</option>
                    <option value="6">6 Images</option>
                    <option value="7">7 Images</option>
                    <option value="8">8 Images</option>
                    <option value="9">9 Images</option>
                    <option value="10">10 Images</option>

            </select>
        </div>

        <div class="mb-4 photos">
            <div class="d-flex gap-2">
                <label for="formFile" class="form-label">Image 1</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="image_status_1" value="1" id="flexSwitchCheckChecked">
                </div>
            </div>
            <input class="form-control" name="image_1" type="file" id="formFile">
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

<script type="text/javascript">
    jQuery(() => {
        
        let photoCount = $(".photoCount");
        let photos = $(".photos");

        photoCount.on('change',function(){
            // alert($((this)).val());
            photos.html("");
            for(var i = 1; i <= $((this)).val(); i++)
            {
                photos.append(`
                <div class="d-flex gap-2">
                    <label for="formFile" class="form-label">Image ${i}</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="image_status_${i}" value="1" id="flexSwitchCheckChecked">
                    </div>
                </div>
                <input class="form-control mb-2" name="image_${i}" type="file" id="formFile">
                `)
            }
        })
    })
</script>

@endsection