@extends('templates/admin-app')

@section('title','NAM - Add Role')

@section('content')

<div class="container shadow bg-white py-3 mb-4">
<span>
    <a class="text-success" href="{{url('admin/roles')}}"><i class="fas fa-chevron-left"></i> Back</a>
</span>
<form class="border border-light px-4 py-3 row" action="{{ url('admin/roles') }}" method="POST">
    @csrf
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h3 class="h3 mb-0 text-base fw-bold">Add Role</h3>
    </div>
    <hr>
    @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-4">
        <div class="d-flex gap-2 align-text-center">
            <label class="form-label" for="textAreaExample">Name<span class="text-danger">*</span>
            </label>
            @if($errors->has('role_name'))
                <div class="text-danger">{{ $errors->first('role_name') }}</div>
            @endif
        </div>
        <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="role_name">
    </div>

    <div class="col-6">
        <button class="btn btn-warning btn-block" type="reset"><i class="fa-solid fa-arrows-spin"></i> Reset Input</button>
    </div>
    <div class="col-6">
        <button class="btn btn-success btn-block" type="submit"><i class="fa-solid fa-plus"></i> Submit</button>
    </div>

</form>

</div>

@endsection