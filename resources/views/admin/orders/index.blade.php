@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card">
                        <div class="card-header">
                            <h3>New orders
                                <a href="{{url('dashboard/orders/history')}}" class="btn btn-outline-secondary float-end">
                                    Orders History
                                </a>
                            </h3>
                        </div>
                        <div class="card-body card_table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tracking Number</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                        <tr>
                                            <td>{{$item->tracking_no}}</td>
                                            <td>{{$item->total_price. ' Dh'}}</td>
                                            <td>{{$item->status=='0' ? 'pending':'completed'}}</td>
                                            <td>
                                                <a href="{{url('dashboard/orders/'.$item->id)}}" class="btn btn-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection