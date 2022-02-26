@extends('layouts.front')

@section('title')
    Users
@endsection

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <a class="btn btn-warning float-start me-2" href="{{url('dashboard/users')}}">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h3>User Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <h5>Shipping Details</h5><hr> --}}
                                <div class="row">
                                    <div class="col">
                                        <label for="f">First Name</label>
                                        <div class="border p-2 bg-light">{{$user->name}}</div>
                                    </div>
                                    <div class="col">
                                        <label for="f">Last Name</label>
                                        <div class="border p-2 bg-light">{{$user->lname}}</div>
                                    </div>
                                </div>
                                
                                <label for="f">Email</label>
                                <div class="border p-2 bg-light">{{$user->email}}</div>
                                <label for="f">Contact no</label>
                                <div class="border p-2 bg-light">{{$user->phone}}</div>
                                <label for="">Address 1</label>
                                <div class="border p-2 bg-light">
                                    {{$user->address1}}
                                </div>
                                <label for="f">Address 2 </label>
                                <div class="border p-2 bg-light">{{$user->address2}}</div>
                                <label for="f">Zip Code</label>
                                <div class="border p-2 bg-light">{{$user->pin_code}}</div>
                                <label for="f">City / Country</label>
                                <div class="border p-2 bg-light">{{$user->city.' / '.$user->country}}</div>
                                
                            </div>
                            {{-- <div class="col-md-6">
                                <h5>Order Details</h5><hr>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->orderItems as $item)
                                            <tr>
                                                <td>{{$item->product->name}}</td>
                                                <td>{{$item->qty}}</td>
                                                <td>{{$item->price.' DH'}}</td>
                                                <td>
                                                    <img src="{{asset('assets/uploads/product/'.$item->product->image)}}" width="50" alt="product img">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h5 class="px-2">Total Price: <span class="fw-bold float-end">{{$user->total_price}} Dh</span></h5>
                                <hr>
                                <div class="py-4 px-1">
                                    <label for="">Order Status</label>
                                    <form action="{{url('update-order/'.$user->id)}}" method="POST">
                                        @csrf
                                        <div class="row m-3">
                                            <div class="col text-end">
                                                <select class="form-select shadow" aria-label="Default select example" name="order_status">
                                                    <option {{$user->status=='0'?"selected":""}} value="0">Pending</option>
                                                    <option {{$user->status=='1'?"selected":""}} value="1">Completed</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
