@extends('layouts.admin')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <h1>Catégories</h1>
            </div>
            <div class="col-auto">
                <a href="categories/add">
                <span class="material-icons">
                    add_box
                </span>
            </a>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table_categories">
                {{-- @foreach ($categories as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{asset('assets/uploads/category/'.$item->image) }}" alt="{{$item->name}}" width="100">
                            @else
                               ... 
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/dashboard/categories/edit/'.$item->id)}}" class="btn btn-primary">
                                <span class="material-icons">edit</span>
                            </a>
                            <a href="{{url('delete-category/'.$item->id)}}" class="btn btn-danger">
                                <span class="material-icons">delete</span>
                            </a>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>

        <div class="row justify-content-center my-2">
            <div class="col-md-6" id="page">
                
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            getCategories();
            $("#categories_inp").on('input', function () {
                $('#table_categories').empty();
                $('#page').empty();
                getCategories($(this).val());
            });
        });        
        
        function getCategories(name='') {
            $.ajax({
                type: "GET",
                url: "/get-categories/"+name,
                success: function (response) {
                    $('#table_categories').append(response[0]);
                    if(response[1] != null){
                        $('#page').append(response[1]);
                    }
                }
            });
        }
    </script>
@endsection