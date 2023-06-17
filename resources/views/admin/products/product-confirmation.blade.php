@extends('templates/admin-app')

@section('title','NAM - Carousel ')

@section('content')
<div class="container-fluid card bg-white shadow-sm p-4 products d-flex flex-column gap-2">
    <span>
        <a class="text-success" href="{{url('admin/products')}}"><i class="fas fa-chevron-left"></i> Back</a>
    </span>
    <h3 class="h3 mb-0 text-base fw-bold">Product Approval</h3>
    <hr>
    @include("templates/includes/product-admin-card")
</div>

<div class="modal fade" id="product-Modal" tabindex="-1" aria-labelledby="product-ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success fw-bold" id="product-ModalLabel"><i class="fas fa-boxes"></i> Product Details</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column content-container gap-2">
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger deny" data-mdb-dismiss="modal">Deny</button>
        <button type="button" class="btn btn-success approve" data-mdb-dismiss="modal">Approve</button>
      </div>
    </div>
  </div>
</div>
<script>
    jQuery(function(){
        $(document).on("click",".product-btn", function(){

            $.ajax({
                url : "{{url('admin/product-confirmation')}}",
                type: "GET",
                data: {"get_products_id": $(this).val()},
                success: (data) => {
                    console.log(data);
                    $('.approve').val(data['prod_id']);
                    $('.deny').val(data['prod_id']);
                    $('.content-container').html(`
                    <div class="d-flex flex-column g-0">
                        <label class="fw-bold m-0">Category</label>
                        <small class="text-muted fw-medium">${data['cat_name']}</small>
                    </div>
                    <div class="d-flex flex-column g-0">
                        <label class="fw-bold m-0">Product Name</label>
                        <small class="text-muted fw-medium">${data['name']}</small>
                    </div>
                    <div class="d-flex flex-column g-0">
                        <label class="fw-bold m-0">Description</label>
                        <small class="text-muted fw-medium">${data['description']}</small>
                    </div>
                    <div class="d-flex flex-column g-0">
                        <label class="fw-bold m-0">Price</label>
                        <div class="d-flex flex-column mt-1">
                            <label class="fw-semibold">Rp ${data['total_price']}</label>
                            ${data['discount'] == 0 ? '' : `
                            <div class="span d-flex gap-2">
                                <div class="badge badge-sm bg-danger">${data['discount']}%</div>
                                <div class="small text-decoration-line-through">Rp ${data['price']}</div>
                            </div>`}
                        </div>
                    </div>
                    <div class="d-flex flex-column g-0">
                        <label class="fw-bold m-0">Stock</label>
                        <small class="text-muted fw-medium">${data['stock']}</small>
                    </div>
                    <div class="d-flex flex-column g-0">
                        <label class="fw-bold m-0">Submitted By</label>
                        <small class="text-muted fw-medium">${data['users_name']}</small>
                    </div>

                    <div class="d-flex flex-column image-container">
                    <label class="fw-bold m-0">Images</label>
                        ${data['product_images'].map((v, index) => {
                            return `<hr>
                                <img class="object-fit-scale" src="{{asset('storage/images/product-images')}}/${v['image_url']}" alt="{{asset('storage/images/product-images')}}/${v['image_url']}" style="width:100%; height:auto;">`;
                        }).join('')}
                    </div>
                    `);
                }
            });
        })

        $(document).on("click",".approve", function(){
            alert($(this).val())
            $.ajax({
                url : "{{url('admin/product-confirmation')}}",
                type: "GET",
                data: {"approve_products_id": $(this).val()},
                success: () => {
                    reload();
                }
            })
        })

        $(document).on("click",".deny", function(){
            $.ajax({
                url : "{{url('admin/product-confirmation')}}",
                type: "GET",
                data: {"deny_products_id": $(this).val()},
                success: () => {
                    reload();
                }
            })
        })

        function reload(){
            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:800px;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);
            $.ajax({
                url : "{{url('admin/product-confirmation')}}",
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
    })
</script>
@endsection


