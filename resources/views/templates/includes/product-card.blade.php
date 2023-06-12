
<div id="load" class="mb-4" style="min-height: 400px;">
    <div class="row g-2">
        @foreach($product as $row)
            <a href="#" class="text-decoration-none col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="shadow-sm card border-0" style="height:25rem">
                
                @if($row['product_images']->count() != 0)
                        @foreach($row['product_images'] as $images)
                            @if($images['is_active'] == 1)
                                <img src="{{asset('storage/images/product-images')}}/{{$images['image_url']}}" class="card-img-top object-fit-cover" alt="Product Photo" style="width:100%; height: 240px;">
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
<div>
    {{ $product->links('pagination::bootstrap-5') }}
</div>