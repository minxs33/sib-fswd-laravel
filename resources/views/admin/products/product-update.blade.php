@extends('templates/admin-app')

@section('title','NAM - Add Product')

@section('content')

<div class="container shadow bg-white py-3 mb-4">
<span>
    <a class="text-success" href="{{url('admin/products')}}"><i class="fas fa-chevron-left"></i> Back</a>
</span>
<form class="border border-light px-4 py-3 row" action="{{ url('admin/products/'.$product['prod_id']) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h3 class="h3 mb-0 text-base fw-bold">Edit Product</h3>
    </div>
    <hr>

    <div class="mb-3">
        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Category<span class="text-danger">*</span></label>
            <select name="category_id" class="form-select">
                    <option selected value="{{$product['cat_id']}}">{{$product['cat_name']}}</option>
                @foreach($categories as $row)
                @if($row["id"] == $product["cat_id"])
                    @continue
                @endif
                    <option value="{{$row['id']}}">{{$row['name']}}</option>
                @endforeach
            </select>
        </div>    

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Name<span class="text-danger">*</span>
            </label>
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="name" value="{{$product['prod_name']}}">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Description<span class="text-danger">*</span></label>
            <textarea id="defaultSubscriptionFormPassword" class="form-control" name="description">{{$product['description']}}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Price (Rp)<span class="text-danger">*</span></label>
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="price" value="{{$product['price']}}">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Discount (%)</label>
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="discount" value="{{$product['discount']}}">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Stock<span class="text-danger">*</span></label>
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="stock" value="{{$product['stock']}}">
        </div>

        <div class="mb-4">
            <label class="form-label mb-0" for="textAreaExample">Product Status</label><br>
            <div class="badge badge-info mb-3" for="textAreaExample">Determines wether or not the product is displayed</div>
            <div class="form-check form-switch">
                @if($product['status'] == "active")
                    <input class="form-check-input" type="checkbox" name="status[]" value="1" id="flexSwitchCheckChecked" checked>
                @elseif($product['status'] == "non-active")
                    <input class="form-check-input" type="checkbox" name="status[]" value="1" id="flexSwitchCheckChecked">
                @endif
            </div>
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