@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')
<section class="vh-100 bg-light" >
    <div class="container h-100 cartItems">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <p><span class="h2 m-3">Shopping Cart </span>
            {{-- <span class="h4">(1 item in your cart)</span> --}}
        </p>
  
          <div class="card shadow mb-4">
            <div class="card-body p-4">
                @php
                    $total=0
                @endphp
                @foreach ($cart_items as $item)
                    <div class="row align-items-center text-center py-1 border-bottom product_data">
                        <div class="col-md-2">
                        <img src="{{asset('assets/uploads/product/'.$item->product->image)}}" class="img-fluid" alt="Generic placeholder image">
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                        <div>
                            <input type="hidden" class="prod_id" value="{{$item->product->id}}">
                            <p class="small text-muted mb-3 pb-1">Name</p>
                            <p class="lead fw-normal mb-0">{{$item->product->name}}</p>
                        </div>
                        </div>
                        {{-- <div class="col-md-2 d-flex justify-content-center">
                        <div>
                            <p class="small text-muted mb-4 pb-2">Color</p>
                            <p class="lead fw-normal mb-0"><i class="fas fa-circle me-2" style="color: #fdd8d2;"></i> pink rose</p>
                        </div>
                        </div> --}}
                        {{-- @if ($item->product->qty>$item->prod_qty) --}}
                        <div class="col-md-2 d-flex justify-content-center">
                        <div>
                            
                                <p class="small text-muted mb-4 pb-2">Quantity</p>
                                {{-- <p class="lead fw-normal mb-0"></p> --}}
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text moins changeQty">-</button>
                                    <input type="number" max="{{$item->product->qty > 10?10:$item->product->qty}}" readonly value="{{$item->prod_qty}}" class="form-control bg-light qty">
                                    <button class="input-group-text plus changeQty">+</button>
                                </div>
                        </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center">
                        <div>
                            <p class="small text-muted mb-4 pb-2">Price</p>
                            <p class="lead fw-normal mb-0">{{$item->product->selling_price.' Dh'}}</p>
                        </div>
                        </div>

                        <div class="col-md-2 d-flex justify-content-center">
                            <div>
                                <p class="small text-muted mb-4 pb-2">Total</p>
                                <p class="lead fw-normal mb-0">{{(int)$item->product->selling_price*(int)$item->prod_qty.' Dh'}}</p>
                            </div>
                        </div>
                    {{-- @else
                        <div class="col-md-6 d-flex justify-content-center">
                            <h6 class="text-danger">Out of Stock</h6>
                        </div>
                    @endif --}}
                        <div class="col-md-1">
                            <i class="fas fa-trash-alt btn btn-outline-danger remove-cart-item"></i>
                        </div>
                    </div>
        
                    @php
                        $total += (int)$item->product->selling_price*(int)$item->prod_qty
                    @endphp
                @endforeach
            </div>
                </div>
  
          <div class="card mb-3">
            <div class="card-body p-4">
  
              <div class="float-end">
                <p class="mb-0 me-5 d-flex align-items-center">
                  <span class="small text-muted me-2">Order total:</span> <span class="lead fw-normal">{{$total.' Dh'}}</span>
                </p>
              </div>
  
            </div>
          </div>
  
          <div class="d-flex justify-content-end mb-5">
            <a href="{{url('/')}}"><button type="button" class="btn btn-light btn-lg me-2">Continue shopping</button></a>
            <a href="{{url('checkout')}}"><button type="button" class="btn btn-primary btn-lg">Check out</button></a>
          </div>
  
        </div>
      </div>
    </div>
  </section>
    
@endsection

{{-- @section('script')
    <script>
        $(document).ready(()=>{

            $('.remove-cart-item').click(function (e) { 
                e.preventDefault();
                var prod_id=$(this).closest('.product_data').find('.prod_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/remove-cart-item",
                    data: {
                        'prod_id':prod_id,
                    },
                    success: function (response) {
                        if(response.success==200){

                            $(e.target).closest('.product_data').remove();
                            swal.fire(response.status);

                        }else{
                            swal.fire('error');
                        }
                    }
                });
            });

        
            $('.plus').click(e=>{
                e.preventDefault();
                var qty_inc=$(e.target).prev('input').val();
                var max=$(e.target).prev('input').attr('max');
                if(qty_inc<max){
                    qty_inc++;
                    $(e.target).prev('input').val(qty_inc);
                }
            });
            $('.moins').click(e=>{
                e.preventDefault();
                var qty_dec=$(e.target).next('input').val();
                if(qty_dec>1){
                    qty_dec--;
                    $('.moins').next('input').val(qty_dec);
                }
            })
            $('.changeQty').click(function (e) { 
                e.preventDefault();
                var prod_id=$(this).closest('.product_data').find('.prod_id').val();
                var prod_qty=$(this).closest('.product_data').find('.qty').val();
                var max=$(this).closest('.product_data').find('.qty').attr('max');
                if(prod_qty<=max){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/update-cart-item",
                    data: {
                        'prod_id':prod_id,
                        'prod_qty':prod_qty
                    },
                    success: function (response) {
                        if(response.success==200){
                            window.location.reload();
                        }else{
                            swal.fire('error');
                        }
                    }
                });}
            });
        })
    </script>
@endsection --}}