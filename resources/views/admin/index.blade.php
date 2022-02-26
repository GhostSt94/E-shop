@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center text-center acceuil">
            <div class="col-md-5 m-2 py-3 bg-success rounded shadow">
                <h4>{{$orders}}</h4>
                <h6>Orders made</h6>
            </div>
            <div class="col-md-5 m-2 py-3 bg-info rounded shadow">
                <h4>{{$users}}</h4>
                <h6>Users</h6>
            </div>
            <div class="col-md-5 m-2 py-3 bg-warning rounded shadow">
                <h4>{{$products}}</h4>
                <h6>Products</h6>
            </div>
            <div class="col-md-5 m-2 py-3 bg-dark rounded shadow">
                <h4>{{$categories}}</h4>
                <h6>Categories</h6>
            </div>
        </div>
    </div>
@endsection