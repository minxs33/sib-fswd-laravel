@extends('templates/admin-app')

@section('title','NAM - Update User')

@section('content')

<div class="container shadow bg-white py-3 mb-4">
<span>
    <a class="text-success" href="{{url('admin/users')}}"><i class="fas fa-chevron-left"></i> Back</a>
</span>
<form class="border border-light px-4 py-3 row" action="{{ url('admin/users/'.$users['id']) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h3 class="h3 mb-0 text-base fw-bold">Update User</h3>
    </div>
    <hr>
    @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" user="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-lg-6">
        <div class="mb-4">
            <div class="d-flex gap-2 align-text-center">
                <label class="form-label" for="textAreaExample">Name<span class="text-danger">*</span>
                </label>
                @if($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="name" value="{{$users['name']}}">
        </div>

        <div class="mb-4">
            <div class="d-flex gap-2 align-text-center">
                <label class="form-label" for="textAreaExample">Email<span class="text-danger">*</span>
                </label>
                @if($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <input type="email" id="defaultSubscriptionFormPassword" class="form-control" name="email" value="{{$users['email']}}">
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            @if($errors->has('password'))
                <div class="text-danger">{{ $errors->first('password') }}</div>
            @endif
            <div class="input-group">
                <input type="password" class="form-control border-end-0" id="password" name="password" placeholder="password">
                <span class="input-group-append">
                    <button type="button" id="togglePassword" class="btn btn-outline-secondary border-start-0 border ms-n3">
                        <i id="icon" class="fa fa-eye-slash"></i>
                    </button>
                </span>
            </div>
        </div> 
    </div>

    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Role<span class="text-danger">*</span></label>
            @if($errors->has('role'))
                <div class="text-danger">{{ $errors->first('role') }}</div>
            @endif
            <select name="role" class="form-select">
                    <option selected value="{{$users['role']}}">{{$users['role_name']}}</option>
                @foreach($roles as $row)
                    @if($row['id'] == $users['role'])
                        @continue
                    @endif
                    <option value="{{$row['id']}}">{{$row['role_name']}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <div class="d-flex gap-2 align-text-center">
                <label for="formFile" class="form-label">Avatar</label>
                @if($errors->has('avatar'))
                    <div class="text-danger">{{ $errors->first('avatar') }}</div>
                @endif
            </div>
            <input class="form-control" name="avatar" type="file" id="formFile">
        </div>
    </div>

    <div class="col-6">
        <button class="btn btn-warning btn-block" type="reset"><i class="fa-solid fa-arrows-spin"></i> Reset Input</button>
    </div>
    <div class="col-6">
        <button class="btn btn-success btn-block" type="submit"><i class="fa-solid fa-plus"></i> Submit</button>
    </div>


</form>

</div>

<script>
    jQuery(function (){
        let togglePassword = $('#togglePassword');
        let password = $('#password');
        let icon = $('#icon');
        
        togglePassword.on('click', function() {
            let type = password.attr('type') === 'password' ? 'text' : 'password';
            password.attr('type', type);
            icon.toggleClass('fa-eye');
        });
    })
</script>

@endsection