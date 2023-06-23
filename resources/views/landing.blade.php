@extends("templates.app")

@section("title", "Naufal Alwan Merch")

@section("content")

<div class="container-md mt-4">
    <div class="owl-carousel carousel owl-theme mb-5 shadow-sm">
        @foreach($carousels as $row)
            <img src="{{asset('storage/images/carousels')}}/{{$row['image_url']}}" alt="{{$row['image_url']}}" class="object-fit-cover carousel-items" style="max-height:430px;">
        @endforeach
    </div>

    <section class="mb-4" id="kategori">
        <div class="d-flex flex-column gap-2">
            <div class="d-flex justify-content-start align-items-center gap-3 bg-white px-3 py-2 rounded-top shadow-sm">
                <label class="fw-semibold fs-5">New in T-Shirt</label>
                <!-- <a href="#" class="text-decoration-none fw-bold link-anchor fs-6 mt-1">See more</a> -->
            </div>
            
            <div class="owl-carousel category-carousel owl-theme">

            @foreach($tshirt as $row)
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
                            <small class="card-title fw-medium text-muted">{{substr($row['name'],0,40)}}</small>
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
            <div class="d-flex justify-content-start align-items-center gap-3 bg-white px-3 py-2 rounded-top shadow-sm">
                <label class="fw-semibold fs-5">New in Hoodie</label>
                <!-- <a href="#" class="text-decoration-none fw-bold link-anchor fs-6 mt-1">See more</a> -->
            </div>
            
            <div class="owl-carousel category-carousel owl-theme">

            @foreach($hoodie as $row)
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
                            <small class="card-title fw-medium text-muted">{{substr($row['name'],0,40)}}</small>
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

    <section class="mb-4">
        <div class="d-flex flex-column gap-2">
            <div class="d-flex justify-content-between align-items-center gap-3 bg-white px-3 py-2 rounded-top shadow-sm">
                <label class="fw-semibold fs-5">All Products</label>
                <div class="d-flex align-items-center gap-2">
                    <label class="text-secondary">Filter</label>
                    <select class="form-select rounded-pill category" aria-label="Default select example">
                        <option selected value="all">All</option>
                        @foreach($categories as $row)
                            <option value="{{$row['id']}}">{{ucfirst($row['name'])}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="products">
                @include('templates/includes/product-card')
            </div>
        </div>
    </section>
    
</div>

<script>

    jQuery(function(){
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#load .page-link').css('color', '#0A3622');

            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:200px;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);

            var url = $(this).attr('href');
            // alert(url);  
            getData(url);
        });

        $(document).on('change', '.category', function(e){
            e.preventDefault();

            $('#load .page-link').css('color', '#0A3622');

            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:200px;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);

            $.ajax({
                url: "{{url('/')}}",
                data: {category:$(this).val()},
                type: "GET",
                dataType: "html"
            }).done(function (data) {
                $('.products').html(data);  
            }).fail(function () {
                $('.products').html(`
                    <div class="alert alert-danger"> Product failed to load, click <a href="#here" onclick="location.reload()">here<a> to refresh the page </div>
                `);  
            });
            })
    });

    function getData(url) {
        var category = $(".category").val();
        $.ajax({
            url : url,
            data: {category: category},
            type: "GET",
            dataType : "html"
        }).done(function (data) {
            $('.products').html(data);  
        }).fail(function () {
            $('.products').html(`
                <div class="alert alert-danger"> Product failed to load, click <a href="#here" onclick="location.reload()">here<a> to refresh the page </div>
            `);  
        });
    }
</script>
@endsection