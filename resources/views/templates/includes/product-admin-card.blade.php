<div class="row g-1" id="load">
    @foreach($products as $row)
        <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <a class="text-decoration-none">
                <div class="shadow-sm card border-0" style="min-height:28rem">
                @if($row['product_images']->count() != 0)
                    @foreach($row['product_images'] as $images)
                        @if($images)
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
                            <span class="badge bg-warning small">{{$row['status']}}</span>
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
                    @if(Auth::user()->role == 1)
                    <div class="card-footer mt-auto d-flex justify-content-end">
                        <button class="btn btn-sm btn-info product-btn" value="{{$row['prod_id']}}" data-mdb-toggle="modal" data-mdb-target="#product-Modal">Details</button>
                    </div>

                    @endif

                </div>
            </a>
        </div>
    @endforeach
</div>
