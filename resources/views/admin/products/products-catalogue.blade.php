@extends('templates/admin-app')

@section('title','NAM - Products Catalogue')

@section('content')
<div class="container-fluid card bg-white shadow-sm p-4">
    @include("templates/includes/product-admin-card")
</div>
@endsection