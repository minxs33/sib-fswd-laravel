@extends("templates.app")

@section("title")
{{$title}}
@endsection

@section("content")
<div class="container-md mt-4">
    <!-- breadcrumb plugin coming soon?? -->
    <div class="d-flex align-items-center gap-2 mb-2">
        <a class="text-success" href="{{url('/')}}">Home </a> <i class="i fas fa-chevron-right fa-sm"></i> <label class="text-break text-wrap">{{substr($products['name'],0,40)}}</label>
    </div>
    <div class="row justify-content-between mb-4">
        <div class="col-12 col-md-4">
            <div id="main-slider" class="splide mb-2">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($products['product_images'] as $row)
                            @if($row['image_url'] == 0)
                            <li class="splide__slide d-flex justify-content-center align-items-center">
                                <img class="object-fit-cover rounded-sm" src="{{ asset('storage/images/product-images/default.png')}}" alt="{{ $row['name'] }}" style="max-height:500px">
                            </li>
                            @else
                            <li class="splide__slide d-flex justify-content-center align-items-center">
                                <img class="object-fit-cover rounded-sm" src="{{ asset('storage/images/product-images/'. $row['image_url']) }}" alt="{{ $row['name'] }}" style="max-height:500px">
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="d-none d-md-block">
                <div id="thumbnail-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                        @foreach($products['product_images'] as $row)
                            @if($row['image_url'] == 0)
                                <li class="splide__slide d-flex justify-content-center align-items-center">
                                    <img class="object-fit-scale img-fluid rounded-sm" src="{{ asset('storage/images/product-images/default.png')}}" alt="{{ $row['name'] }}">
                                </li>
                            @else
                                <li class="splide__slide d-flex justify-content-center align-items-center">
                                    <img class="object-fit-scale img-fluid rounded-sm" src="{{ asset('storage/images/product-images/'. $row['image_url']) }}" alt="{{ $row['name'] }}">
                                </li>
                            @endif
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="d-flex flex-column bg-white p-3 flex-wrap">
                <div class="text-wrap text-break mb-3">
                    <h4 class="fw-bold">{{$products['name']}}</h4>
                </div>

                <div class="d-flex flex-column">
                    <h5 class="fw-semibold">Rp{{number_format($products['total_price'], 2)}}
                    </h5>
                    @if($products['discount'] == 0)
                    @else
                    <div class="span d-flex gap-2">
                        <div class="badge badge-sm text-bg-danger">{{$products['discount']}}%</div>
                        <div class="small text-decoration-line-through">Rp{{number_format($products['price'], 2)}}</div>
                    </div>
                    @endif
                </div>
    
                <hr>

                <div class="text-wrap text-break mb-3">
                    <small class="fw-medium">{{$products['description']}}</small>
                </div>

                <div class="d-flex flex-column">
                    <small class="fw-bold text-muted">Stock</small>
                    <label class="fw-semibold text-success">{{$products['stock']}}</label>
                </div>

            </div>
        </div>
    </div>

    <div class="d-flex flex-column gap-2 mb-4">
        <div class="d-flex justify-content-start align-items-center gap-3 bg-white px-3 py-2">
            <label class="fw-semibold fs-5">More like this</label>
        </div>
        
        <div class="owl-carousel category-carousel owl-theme">
        @foreach($recommendation as $row)
            @if($row['id'] == $products['id'])
            @continue
            @endif
            <a href="{{url('/products/')}}/{{$row['id']}}" class="text-decoration-none">
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
                    <div class="card-body p-2">
                        <small class="card-title fw-medium text-muted">{{substr($row['name'],0,50)}}</small>
                        <div class="d-flex flex-column mt-1">
                            <label class="fw-semibold">Rp{{$row['total_price']}}
                            </label>
                            @if($row['discount'] == 0)
                            @else
                            <div class="span d-flex gap-2">
                                <div class="badge badge-sm text-bg-danger">{{$row['discount']}}%</div>
                                <div class="small text-decoration-line-through">Rp{{$row['price']}}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        </div>
    </div>
</div>
@endsection