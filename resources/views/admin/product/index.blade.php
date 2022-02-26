@extends('layouts.admin')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <h1>Products</h1>
            </div>
            <div class="col-auto">
                <a href="products/add">
                <span class="material-icons">
                    add_box
                </span>
            </a>
            </div>
        </div>
    </div>
    
    <div class="container">
        {{-- <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th></th>
                </tr>
            </thead> --}}
            <div class="container-fluid" id="table_products">
                {{-- @foreach ($products as $item)
                    <div class="row py-2 border-bottom">
                        <div class="col-xs-5 col-md-3 ">{{$item->name}}</div>
                        <div class="col-xs-5 col-md-3 ">{{$item->category->name}}</div>
                        <div class="col-md-2 col-sm-2">{{$item->selling_price.' Dh'}}</div>
                        <div class="col-md-3">
                            <img src="{{asset('assets/uploads/product/'.$item->image) }}" alt="{{$item->name}}" height="100">
                        </div>
                        <div class="col-md-1">
                            <a href="{{url('/dashboard/products/edit/'.$item->id)}}" class="">
                                <span class="material-icons">edit</span>
                            </a>
                            <a href="{{url('delete-product/'.$item->id)}}" class="">
                                <span class="material-icons">delete</span>
                            </a>
                        </div>
                    </div> --}}
                    {{-- <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->selling_price.' Dh'}}</td>
                        <td>
                            <img src="{{asset('assets/uploads/product/'.$item->image) }}" alt="{{$item->name}}" width="100">
                        </td>
                        <td class="">
                            <a href="{{url('/dashboard/products/edit/'.$item->id)}}" class="">
                                <span class="material-icons">edit</span>
                            </a>
                            <a href="{{url('delete-product/'.$item->id)}}" class="">
                                <span class="material-icons">delete</span>
                            </a>
                        </td>
                    </tr> --}}
                {{-- @endforeach --}}
            </div>
        {{-- </table> --}}
        
<div class="row justify-content-center my-2" id="page">
    {{-- <div class="col-md-4">
        {{ $products->links() }}
        <p>
            Displaying {{$products->count()}} of {{ $products->total() }} product(s).
        </p>
    </div> --}}
</div>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {
            getProducts();
            $("#products_inp").on('input', function () {
                $('#table_products').empty();
                $('#page').empty();
                getProducts($(this).val());
            });
        });        
        
        function getProducts(name='') {
            $.ajax({
                type: "GET",
                url: "/get-products/"+name,
                success: function (response) {
                    $('#table_products').append(response[0]);
                    if(response[1] != null){
                        $('#page').append(response[1]);
                    }
                    // console.log(response)
                }
            });
        }
    </script>
@endsection