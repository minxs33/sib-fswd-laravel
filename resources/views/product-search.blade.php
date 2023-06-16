@extends("templates.app")

@section("title")
    {{$title}}
@endsection

@section("content")

<div class="container-md mt-4">
    <div class="row gx-2">
        <div class="col-12 col-lg-3 d-flex flex-column gap-1 mb-4">
            <div class="bg-white p-3 rounded-sm shadow-sm rounded-top">
                <label class="fw-bold text-success">Filters</label>
            </div>
            
            <div class="bg-white p-3 rounded-sm shadow-sm rounded-bottom">
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
            </div>
        </div>
        <div class="col-12 col-lg-9 d-flex flex-column gap-1">
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

            $('#load .page-link').css('color', '#0A3622');

            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:800px;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);
            var category = $(this).val();
            // alert(category)
            $.ajax({
                url : "{{url('/search')}}",
                data: {category: category, keyword: "{{$keyword}}"},
                type: "GET",
                dataType : "html"
            }).done(function (data) {
                    $('.products').html(data);  
            }).fail(function () {
                $('.products').html(`
                    <div class="alert alert-danger"> Product failed to load, click <a href="#here" onclick="location.reload()">here<a> to refresh the page </div>
                `);  
            });
        })
    })

    function getData(url) {
        var category = $(".category").val();
        $.ajax({
            url : url,
            data: {category: category, keyword: "{{$keyword}}"},
            type: "GET",
            dataType : "html"
        }).done(function (data) {
            $('.products').html(data);  
        }).fail(function () {
            $('.products').html(`
                <div class="alert alert-danger> Product failed to load, click <a href="#here" onclick="location.reload()">here<a> to refresh the page </div>
            `);  
        });
    }
</script>
@endsection