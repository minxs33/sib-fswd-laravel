@extends('templates/admin-app')

@section('title','NAM - Carousel Lists')

@section('content')
<div class="container-fluid card bg-white shadow-sm p-4">
    <div class="row g-1">
        @foreach($products as $row)
            <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <a href="#" class="text-decoration-none">
                    <div class="shadow-sm card border-0" style=" height:25rem">
                    @if($row['product_images_count'] != 0)
                        @foreach($row['product_images'] as $images)
                            @if($images['is_active'] == 1)
                                <img src="{{asset('storage/images/product-images')}}/{{$images['image_url']}}" class="card-img-top object-fit-cover" alt="Product Photo" style="width:100%; height: 240px;">
                            @break
                            @else
                                <img src="{{asset('storage/images/product-images/default.png')}}" class="card-img-top object-fit-cover" alt="Product Photo" style="width:100%; height: 240px;">
                            @break
                            @endif
                        @endforeach
                    @else
                        <img src="{{asset('storage/images/product-images/default.png')}}" class="card-img-top object-fit-cover" alt="Product Photo" style="width:100%; height: 240px;">
                    @endif
                        <div class="card-body p-2 text-dark">
                            <div class="fw-medium text-muted d-flex justify-content-end gap-2 flex-wrap">
                                <span class="badge bg-dark small">{{$row['cat_name']}}</span>
                                {!!$row['status'] == "active" ? '<span class="badge bg-success small">active</span>' : '<span class="badge bg-warning small">non-active</span>'!!}

                            </div>
                            <div class="card-title">{{substr($row['prod_name'],0,40)}}</div>
                            <div class="d-flex flex-column mt-1">
                                <label class="fw-bold text-dark">Rp{{$row['total_price']}}
                                </label>
                                @if($row['discount'] == 0)
                                @else
                                <div class="span d-flex gap-2">
                                    <div class="badge badge-sm bg-danger">{{$row['discount']}}%</div>
                                    <div class="small text-decoration-line-through">Rp{{$row['price']}}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection