@extends("templates.app")

@section("title", "Naufal Alwan")

@section("content")

<div class="container-md mt-4">
    <div class="owl-carousel carousel owl-theme mb-5">
        @foreach($carousels as $row)
            <img src="{{ $row['banner'] }}" alt="http://placehold.it/1200x400/cccccc/999999" class="object-fit-cover carousel-items" style="max-height:430px;">
        @endforeach
    </div>

    <section class="mb-5" id="kategori">
        <div class="d-flex flex-column gap-2">
            <div class="d-flex justify-content-between">
                <h5 class="fw-semibold">New in Category 1</h5>
            </div>
            
            <div class="owl-carousel category-carousel owl-theme">

            @foreach($category_1 as $row)
            <a href="#" class="text-decoration-none">
                <div class="shadow-sm card border-0" style=" height:25rem">
                    <img src="{{ $row['image_url'] }}" class="card-img-top object-fit-cover" alt="{{ $row['name'] }}" style="width:100%; height: 240px;">
                    <div class="card-body p-2">
                        <small class="card-title text-muted">{{ $row['name'] }}</small>
                        <div class="d-flex flex-column mt-1">
                            <label class="fw-semibold">Rp 
                            @php
                                $discount = ($row['price'] / 100) * $row['discount'];
                                $price = $row['price'] - $discount;
                                echo intval(preg_replace('/[^\d.]/', '', $price));
                            @endphp

                            </label>
                            @if($row['discount'] == 0)
                            @else
                            <div class="span d-flex gap-2">
                                <div class="badge badge-sm text-bg-danger">{{$row['discount']}}%</div>
                                <div class="small text-decoration-line-through">Rp {{$row['price']}}</div>
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
                <h5 class="fw-semibold">New in Category 2</h5>
            </div>
            
            <div class="owl-carousel category-carousel owl-theme">

            @foreach($category_2 as $row)
                <div class="shadow-sm card border-0" style=" height:25rem">
                    <img src="{{ $row['image_url'] }}" class="card-img-top object-fit-cover" alt="{{ $row['name'] }}" style="width:100%; height: 240px;">
                    <div class="card-body p-2">
                        <small class="card-title text-muted">{{ $row['name'] }}</small>
                        <div class="d-flex flex-column mt-1">
                            <label class="fw-semibold">Rp 
                            @php
                                $discount = ($row['price'] / 100) * $row['discount'];
                                $price = $row['price'] - $discount;
                                echo intval(preg_replace('/[^\d.]/', '', $price));
                            @endphp

                            </label>
                            @if($row['discount'] == 0)
                            @else
                            <div class="span d-flex gap-2">
                                <div class="badge badge-sm text-bg-danger">{{$row['discount']}}%</div>
                                <div class="small text-decoration-line-through">Rp {{$row['price']}}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection