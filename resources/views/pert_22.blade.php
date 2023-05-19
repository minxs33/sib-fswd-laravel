@extends("templates/app")

@section("title","Pertemuan 22")

@section("content")

<div class="container mt-4">
    <div class="row card p-3">
    <span class="mb-2"><a class="btn btn-md btn-success fw-semibold" href="#"><i class="fas fa-user-plus"></i> Add User</a></span>
        
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($users as $row)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->name}}</td>
                            <td>
                                @if(!empty($row->avatar))
                                    <img style='width:50px; height:auto;' class='img-thumbnail rounded' src='https://static.vecteezy.com/system/resources/previews/009/734/564/large_2x/default-avatar-profile-icon-of-social-media-user-vector.jpg' alt='{{$row->avatar}}'>
                                @endif
                            </td>
                            <td>{{$row->phone}}</td>
                            <td>{{substr($row->address,0,50)}}</td>
                            <td>{{$row->role_name}}</td>
                            <td>
                                <a class="btn btn-warning" href="#"><i class="fas fa-edit fa-sm"></i></a>
                                <a class="btn btn-danger" href="#"><i class="fas fa-trash fa-sm"></i></a>
                            </td>
                        </tr>
                        @php
                        $i++
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection