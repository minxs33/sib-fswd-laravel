@extends('templates/admin-app')

@section('title','NAM - Carousel Lists')

@section('content')

<style>
.image-btn:hover{
    cursor: pointer;
    transform: scale(110%);
}
</style>
<div class="container-fluid card bg-white shadow-sm p-4">
    <h4 class="fw-semibold"><i class="fas fa-boxes-stacked"></i> Manage Carousels</h4>
    <hr class="border-success">

        @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    <div class="row">
        <div class="col-3 mb-4">
            <a class="btn btn-outline-success" href="{{ url('/admin/carousels/create') }}" class="text-white text-decoration-none"><i class="fas fa-plus"></i> Add new carousel</a>
        </div>
        
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="carousels-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Url</th>
                            <th>Image</th>
                            <th>Active Status</th>
                            <th>Created At</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach($carousels as $row)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$row['name']}}</td>
                            <td>{{substr($row['description'],0,50)}}</td>
                            <td>{{$row['url']}}</td>
                            <td><img class="img-thumbnail object-fit-scale image-btn" src="{{ asset('storage/images/carousels/')}}/{{$row['image_url'] }}" alt="{{$row['image_url']}}" style="width:100px; height:auto;" data-mdb-toggle="modal" data-mdb-target="#image-Modal"></td>
                            <td>{!!$row['is_active'] == 1 ? 'Active' : 'Non-active'!!}</td>
                            <td>
                                {{$row['created_at']->format('j F, Y. H:i')}}
                            </td>
                            <td>
                                {{$row['updated_at']->format('j F, Y. H:i')}}
                            </td>
                            <td>
                                <form method="POST" action="{{ url('admin/carousels/'.$row['id']) }}">
                                    <a class="btn btn-warning btn-sm" href="{{ url('admin/carousels/'.$row['id'].'/edit') }}"><i class="fas fa-edit fa-sm"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" type="submit"><i class="fas fa-trash fa-sm"></i></button>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success fw-bold" id="image-ModalLabel"><i class="fas fa-image"></i> Carousel Image</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
        $('#carousels-table').DataTable();

        $(document).on("click", ".image-btn",function(){
            // alert($((this)).attr("src"));
            $('.image-container').html(
                `<img class="object-fit-scale" src="${$((this)).attr("src")}" alt="${$((this)).attr("src")}" style="width:100%; height:auto;">`
            );
        })
    })
</script>
@endsection