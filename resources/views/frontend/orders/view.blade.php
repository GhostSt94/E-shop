@extends('layouts.front')

@section('title')
    My orders
@endsection

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <a class="btn btn-warning float-start me-2" href="{{url('my-orders')}}">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h3>Order View</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Shipping Details</h5><hr>
                                <div class="row">
                                    <div class="col">
                                        <label for="f">First Name</label>
                                        <div class="border p-2 bg-light">{{$orders->fname}}</div>
                                    </div>
                                    <div class="col">
                                        <label for="f">Last Name</label>
                                        <div class="border p-2 bg-light">{{$orders->lname}}</div>
                                    </div>
                                </div>
                                
                                <label for="f">Email</label>
                                <div class="border p-2 bg-light">{{$orders->email}}</div>
                                <label for="f">Contact no</label>
                                <div class="border p-2 bg-light">{{$orders->phone}}</div>
                                <label for="">Shipping Address</label>
                                <div class="border p-2 bg-light">
                                    {{$orders->address1}},<br>
                                    {{$orders->address2}},<br>
                                    {{$orders->city}},<br>
                                    {{$orders->country}}
                                </div>
                                <label for="f">Zip Code</label>
                                <div class="border p-2 bg-light">{{$orders->pin_code}}</div>
                            </div>
                            <div class="col-md-6">
                                <h5>Order Details</h5><hr>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            {{-- <th></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderItems as $item)
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
                                <h5 class="px-2">Total Price: <span class="fw-bold float-end">{{$orders->total_price}} Dh</span></h5>
                                <h5 class="px-2">Payment mode: 
                                    @if ($orders->payment_mode=='COD')
                                        <span class="ps-3 text-muted float-end">Cash On Delivery</span>
                                    @else
                                    <span class="ps-3 text-success float-end">Paid By Paypal</span>
                                    @endif
                                </h5>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
