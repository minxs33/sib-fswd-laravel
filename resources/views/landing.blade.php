@extends("templates.app")

@section("title", "Naufal Alwan")

@section("content")

<div class="container-md mt-4">
    <div class="owl-carousel carousel owl-theme mb-5">
        @foreach($carousels as $row)
            <img src="{{asset('storage/images/carousels')}}/{{$row['image_url']}}" alt="{{$row['image_url']}}" class="object-fit-cover carousel-items" style="max-height:430px;">
        @endforeach
    </div>

    <section class="mb-5" id="kategori">
        <div class="d-flex flex-column gap-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-semibold">New in T-Shirt</h5>
            </div>
            
            <div class="owl-carousel category-carousel owl-theme">

            @foreach($tshirt as $row)
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
                

        <div class="d-flex flex-column gap-2 mt-4">
            <div class="d-flex justify-content-between">
                <h5 class="fw-semibold">New in Hoodie</h5>
            </div>
            
            <div class="owl-carousel category-carousel owl-theme">

            @foreach($hoodie as $row)
                <a href="#" class="text-decoration-none">
                    <div class="shadow-sm card border-0" style=" height:25rem">
                    @if($row['product_images_count'] == 0)
                        <img src="{{asset('storage/images/product-images/default.png')}}" class="card-img-top object-fit-cover" alt="Product Photo" style="width:100%; height: 240px;">   
                    @else
                        @foreach($row['product_images'] as $images)
                            @if($images['is_active'] == 1)
                                <img src="{{asset('storage/images/product-images')}}/{{$images['image_url']}}" class="card-img-top object-fit-cover" alt="Product Photo" style="width:100%; height: 240px;">
                            @break
                            
                            @endif
                        @endforeach
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
    </section>
</div>

@endsection