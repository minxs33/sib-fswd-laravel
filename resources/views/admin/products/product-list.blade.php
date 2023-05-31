@extends('templates/admin-app')

@section('title','NAM - Product Lists')

@section('content')

<div class="container-fluid card bg-white shadow-sm p-4">
    <h4 class="fw-semibold"><i class="fas fa-boxes-stacked"></i> Manage Products</h4>
    <hr class="border-success">
    
    <div class="row">
        <div class="col-3 mb-4">
            <a class="btn btn-outline-success" href="{{ url('/admin/products/create') }}" class="text-white text-decoration-none"><i class="fas fa-plus"></i> Add new product</a>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="products-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Images</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Active Status</th>
                            <th>Created At</th>
                            <th>Last Updated</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach($products as $row)
                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>
                                    {{$row['cat_name']}}
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm image-modal" type="button" value="{{$row['prod_id']}}" data-mdb-toggle="modal" data-mdb-target="#image-Modal"><i class="fas fa-image fa-sm"></i></button>
                                </td>
                                <td>
                                    {{$row['prod_name']}}
                                </td>
                                <td>
                                    {{substr($row['description'],0,50)}}
                                </td>
                                <td>
                                    @if($row['discount'] != null)
                                        Rp{{$row['total_price']}}
                                        <div class="badge badge-danger">{{$row['discount']}}%</div>
                                        <div class="text-decoration-line-through">Rp{{$row['price']}}</div>
                                    @else
                                    Rp{{$row['total_price']}}
                                    @endif
                                    
                                </td>
                                <td>
                                    {{$row['stock']}}
                                </td>
                                <td>
                                    {!!$row['status'] == 'active' ? '<div class="form-switch"><input class="form-check-input status" type="checkbox" value="'.$row['prod_id'].'" id="flexCheckChecked" checked></div>' : '<div class="form-switch"><input class="form-check-input status" type="checkbox" value="'.$row['prod_id'].'" id="flexCheckChecked"></div>'!!}
                                </td>
                                <td>
                                    {{$row['updated_at']->format('j F, Y. H:i')}}
                                </td>
                                <td>
                                    {{$row['created_at']->format('j F, Y. H:i')}}
                                </td>
                                <td>
                                    {{$row['users_name']}}
                                </td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="#"><i class="fas fa-edit fa-sm"></i></a>
                                    <form method="POST" onsubmit="return confirm('This action will also delete the product images. Are you sure? ');" action="{{ url('admin/products/'.$row['prod_id']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash fa-sm"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="image-Modal" tabindex="-1" aria-labelledby="image-ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success fw-bold" id="image-ModalLabel"><i class="fas fa-image"></i> Manage Product Images</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info p-2">
            The first active image is the image displayed on the product thumbnail
        </div>
        <div class="link-container">
            
        </div>
        <div class="d-flex flex-column image-container">
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
    jQuery(() => {
        $('#products-table').DataTable();

        $(document).on("change", ".status",function(){
   
            // alert($((this)).val());
            $.ajax({
                url : "{{url('admin/ajaxReq/change-product-status')}}",
                type: "POST",
                data : {id:$((this)).val()},
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success : (data) => {
                    console.log(data);
                }
            })
        })

        let imageContainer = $('.image-container');
        let linkContainer = $('.link-container');
        function reloadImage($id){
            imageContainer.html("");
            $.ajax({
                url: "{{url('admin/ajaxReq/product-image-list')}}",
                data : {id : $id},
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success : (data) => {
                    // console.log(data);
                    linkContainer.html(`<a class="btn btn-outline-success" href="{{ url('/admin/product_images/create/${$id}') }}" class="text-white text-decoration-none"><i class="fas fa-plus"></i> Add new product image</a>`);
                    $.each(data, (i,v) => {
                        
                        imageContainer.append(`
                            <hr>
                            <div class="d-flex flex-column mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="text-muted">Image ${i+1}</h5>
                                    <div class="d-flex align-items-center gap-2">
                                        ${v['is_active'] == 1 ? `<div class="form-switch"><input class="form-check-input image-status" type="checkbox" value="${v['id']}" id="flexCheckChecked" checked></div>` : `<div class="form-switch"><input class="form-check-input image-status" type="checkbox" value="${v['id']}" id="flexCheckChecked"></div>`}
                                        <button class="btn btn-danger btn-sm delete-image" type="button" value="${v['id']}" data-prod-id="${v['products_id']}"><i class="fas fa-trash fa-sm"></i></button>
                                    </div>
                                </div>
                                <img class="object-fit-scale" src="{{asset('storage/images/product-images')}}/${v['image_url']}" alt="{{asset('storage/images/product-images')}}/${v['image_url']}" style="width:100%; max-height:468px;">
                            </div>
                            
                        `);
                    });
                }
            })
        }
        $(document).on("click", ".image-modal",function(){
            reloadImage($((this)).val());
        })

        $(document).on("change", ".image-status",function(){
            $.ajax({
                url : "{{url('admin/ajaxReq/change-images-status/')}}",
                data : {id:$((this)).val()},
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success : (data) => {
                    // console.log(data);
                }
            })
        })

        $(document).on("click", ".delete-image",function(){
            // console.log($((this)).val())
            if(confirm("Are you sure?") == true)
            {
                $.ajax({
                    url : "{{url('admin/product_images')}}/"+$((this)).val(),
                    type: "DELETE",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    success : (data) => {
                        // console.log(data);
                        // alert($(this).attr("data-prod-id"));
                        reloadImage($(this).attr("data-prod-id"));
                    }
                })
            }
        })
    })

    
</script>

@endsection