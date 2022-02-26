@extends('layouts.admin')


@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <h1>Registered users</h1>
            </div>
            {{-- <div class="col-auto">
                <a href="products/add">
                <span class="material-icons">
                    add_box
                </span>
            </a>
            </div> --}}
        </div>
    </div>
    
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    {{-- <div class="row py-2 border-bottom">
                        <div class="col-xs-5 col-md-3 ">{{$item->id}}</div>
                        <div class="col-xs-5 col-md-3 ">{{$item->name}}</div>
                        <div class="col-md-2 col-sm-2">{{$item->email}}</div>
                        <div class="col-md-2 col-sm-2">{{$item->phone}}</div> --}}
                        {{-- <div class="col-md-3">
                            <img src="{{asset('assets/uploads/product/'.$item->image) }}" alt="{{$item->name}}" class="w-75">
                        </div>
                        <div class="col-md-1">
                            <a href="{{url('/dashboard/products/edit/'.$item->id)}}" class="">
                                <span class="material-icons">edit</span>
                            </a>
                            <a href="{{url('delete-product/'.$item->id)}}" class="">
                                <span class="material-icons">delete</span>
                            </a>
                        </div> --}}
                    {{-- </div> --}}
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name.' '.$item->lname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td class="">
                            <a href="{{url('/dashboard/users/'.$item->id)}}" class="btn btn-outline-primary">
                                view
                                {{-- <span class="material-icons">edit</span> --}}
                            </a>
                            {{-- <a href="{{url('delete-product/'.$item->id)}}" class="">
                                <span class="material-icons">delete</span>
                            </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection