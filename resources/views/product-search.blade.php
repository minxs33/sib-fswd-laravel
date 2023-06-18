@extends("templates.app")

@section("title")
    {{$title}}
@endsection

@section("content")

<div class="container-md my-4">
    <div class="row gx-2">
        <div class="col-12 col-lg-3 d-flex flex-column gap-1 mb-4">
            <div class="bg-white p-3 rounded-sm shadow-sm rounded-top">
                <label class="fw-bold text-success">Filters</label>
            </div>
            
            <div class="bg-white p-3 rounded-sm shadow-sm rounded-bottom d-flex flex-column gap-2">
                <label class="fw-bold text-success small">Categories</label>
                <div class="ms-1 mt-1">
                    <div class="form-check">
                        <input class="form-check-input categories" value="all" type="radio" name="flexRadioDefault" id="flexRadioDefault" checked>
                        <label class="form-check-label" for="flexRadioDefault">
                            All
                        </label>
                    </div>
                    @foreach($categories as $row)
                    <div class="form-check">
                        <input class="form-check-input categories" value="{{$row['id']}}" type="radio" name="flexRadioDefault" id="flexRadioDefault{{$loop->index}}">
                        <label class="form-check-label" for="flexRadioDefault{{$loop->index}}">
                            {{ucfirst($row['name'])}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <label class="fw-bold text-success small">Price</label>
                <div class="d-flex justify-content-between align-items-center gap-2">
                    <div class="input-group">
                        <span class="input-group-text rounded-pill rounded-end" id="basic-addon1">Rp</span>
                        <input type="text" class="form-control form-control-sm rounded-pill rounded-start min" placeholder="Min">
                    </div>
                    <i class="fas fa-minus text-success"></i>
                    <div class="input-group">
                        <span class="input-group-text rounded-pill rounded-end" id="basic-addon1">Rp</span>
                        <input type="text" class="form-control form-control-sm rounded-pill rounded-start max" placeholder="Max">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-success btn-apply rounded-pill">Apply</button>
            </div>
        </div>
        <div class="col-12 col-lg-9 d-flex flex-column gap-1 top">
            <div class="bg-white p-3 rounded-sm shadow-sm rounded-top">
                <label class="fw-bold text-success">Search for "{{$keyword}}"</label>
            </div>
            <div class="products">
                @include('templates/includes/product-card-search')
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(function(){
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#load .page-link').css('color', '#0A3622');

            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:800px;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);

            var url = $(this).attr('href');
            // alert(url);  
            getData(url);
        });

        $(document).on("click", ".categories", function(){
            var min = $(".min").val();
            var max = $(".max").val();

            loader();
            var category = $(this).val();
            $.ajax({
                url : "{{url('/search')}}",
                data: {category: category, keyword: "{{$keyword}}", min:min, max:max},
                type: "GET",
                dataType : "html"
            }).done(function (data) {
                scrollTop();
                $('.products').html(data);  
            }).fail(function () {
                scrollTop()
                $('.products').html(`
                    <div class="alert alert-danger"> Product failed to load, click <a href="#here" onclick="location.reload()">here<a> to refresh the page </div>
                `);  
            });
        })

        $(document).on("click", ".btn-apply", function(){
            var min = $(".min").val();
            var max = $(".max").val();

            loader();
            var category = $(".categories:checked").val();
            $.ajax({
                url : "{{url('/search')}}",
                data: {category: category, keyword: "{{$keyword}}", min:min, max:max},
                type: "GET",
                dataType : "html"
            }).done(function (data) {
                scrollTop();
                $('.products').html(data);  
            }).fail(function () {
                scrollTop()
                $('.products').html(`
                    <div class="alert alert-danger"> Product failed to load, click <a href="#here" onclick="location.reload()">here<a> to refresh the page </div>
                `);  
            });
        })
    })
    
    function loader(){
        $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:800px;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);
    }

    function scrollTop(){
        $('html, body').animate({
            scrollTop: $("nav").offset().top
        });
    }
    function getData(url) {
        var category = $(".categories:checked").val();
        var min = $(".min").val();
        var max = $(".max").val();
        $.ajax({
            url : url,
            data: {category: category, keyword: "{{$keyword}}", min:min, max:max},
            type: "GET",
            dataType : "html"
        }).done(function (data) {
            scrollTop()
            $('.products').html(data);  
        }).fail(function () {
            scrollTop()
            $('.products').html(`
                <div class="alert alert-danger> Product failed to load, click <a href="#here" onclick="location.reload()">here<a> to refresh the page </div>
            `);  
        });
    }
</script>
@endsection