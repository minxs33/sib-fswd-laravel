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

    <div class="mb-3">
        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Category<span class="text-danger">*</span></label>
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
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="name">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Description<span class="text-danger">*</span></label>
            <textarea id="defaultSubscriptionFormPassword" class="form-control" name="description"></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Price (Rp)<span class="text-danger">*</span></label>
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="price">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Discount (%)</label>
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="discount">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Stock<span class="text-danger">*</span></label>
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="stock">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Product Images</label>
            <div class="alert alert-info">You can manage product images in the product table in the image column with <i class="fas fa-image small"></i> icon as an indicator.</div>
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
            <label for="formFile" class="form-label">Image 1</label>
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
                <label for="formFile" class="form-label">Image `+i+` </label>
                <input class="form-control mb-2" name="image_`+i+`" type="file" id="formFile">
                `)
            }
        })
    })
</script>

@endsection