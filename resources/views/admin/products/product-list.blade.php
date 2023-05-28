@extends('templates/admin-app')

@section('title','NAM - Product Lists')

@section('content')

<div class="container card bg-white shadow-sm p-4">
    <h4 class="fw-semibold"><i class="fas fa-boxes-stacked"></i> Manage Products</h4>
    <hr class="border-success">
    <div class="row">
        <div class="col-3 mb-4">
            <a class="btn btn-outline-success" href="{{ url('/admin/products/create') }}" class="text-white text-decoration-none"><i class="fas fa-plus"></i> Add new product</a>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover text-center rounded">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach($products as $row)
                            <tr>
                                <th>
                                    {{$loop->index+1}}
                                </th>
                                <th>
                                    {{$row['cat_name']}}
                                </th>
                                <th>
                                    {{$row['prod_name']}}
                                </th>
                                <th>
                                    {{substr($row['description'],0,50)}}
                                </th>
                                <th>
                                    Rp{{$row['price']}}
                                </th>
                                <th>
                                    {{$row['stock']}}
                                </th>
                                <th>
                                    {{$row['status']}}
                                </th>
                                <th>
                                    {{$row['updated_at']->format('j F, Y. H:i')}}
                                </th>
                                <th>
                                    {{$row['created_at']->format('j F, Y. H:i')}}
                                </th>
                                <th>
                                    {{$row['users_name']}}
                                </th>
                                <th>
                                    <a class="btn btn-warning" href="#"><i class="fas fa-edit fa-sm"></i></a>
                                    <a class="btn btn-danger" href="#"><i class="fas fa-trash fa-sm"></i></a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection