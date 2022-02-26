@extends('layouts.front')

@section('title')
    My orders
@endsection

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>My orders</h3>
                    </div>
                    <div class="card-body">
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
                                        <td>
                                            @if($item->status=='0') 
                                                <i class="fas fa-circle fa-xs m-1"></i> pending
                                            @else
                                                <i class="fas fa-circle text-success fa-xs m-1"></i> completed
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('order-details/'.$item->id)}}" class="btn btn-primary">View</a>
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
