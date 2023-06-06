@extends('templates/admin-app')

@section('title','NAM - Role Lists')

@section('content')

<div class="container-fluid card bg-white shadow-sm p-4">
    <h4 class="fw-semibold"><i class="fas fa-users"></i> Manage roles</h4>
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
            <a class="btn btn-outline-success" href="{{ url('/admin/roles/create') }}" class="text-white text-decoration-none"><i class="fas fa-plus"></i> Add new role</a>
        </div>
        
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="roles-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach($roles as $row)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$row['role_name']}}</td>
                            <td>
                                {{$row['created_at']->format('j F, Y. H:i')}}
                            </td>
                            <td>
                                {{$row['updated_at']->format('j F, Y. H:i')}}
                            </td>
                            <td>
                                <form method="POST" action="{{ url('admin/roles/'.$row['id']) }}">
                                    <a class="btn btn-warning btn-sm" href="{{ url('admin/roles/'.$row['id'].'/edit') }}"><i class="fas fa-edit fa-sm"></i></a>
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
        $('#roles-table').DataTable();

        $(document).on("click", ".image-btn",function(){
            // alert($((this)).attr("src"));
            $('.image-container').html(
                `<img class="object-fit-scale" src="${$((this)).attr("src")}" alt="${$((this)).attr("src")}" style="width:100%; height:auto;">`
            );
        })
    })
</script>
@endsection