@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')
<section class="vh-100 bg-light" >
    <div class="container h-100 wishlistItems">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <p><span class="h2 m-3">Wishlist</span>
            {{-- <span class="h4">(1 item in your cart)</span> --}}
        </p>
  
          <div class="card shadow mb-4">
            <div class="card-body p-4">
                @if ($wishlist->count()>0)
                @foreach ($wishlist as $item)
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
                    {{-- <div>
                        
                            <p class="small text-muted mb-4 pb-2">Quantity</p>
                            <p class="lead fw-normal mb-0"></p>
                            <div class="input-group text-center mb-3">
                                <button class="input-group-text moins changeQty">-</button>
                                <input type="number" max="{{$item->product->qty > 10?10:$item->product->qty}}" readonly value="{{$item->prod_qty}}" class="form-control bg-light qty">
                                <button class="input-group-text plus changeQty">+</button>
                            </div>
                    </div> --}}
                    <input type="hidden" value="1" class="qty">
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                    <div>
                        <p class="small text-muted mb-4 pb-2">Price</p>
                        <p class="lead fw-normal mb-0">{{$item->product->selling_price.' Dh'}}</p>
                    </div>
                    </div>

                    <div class="col-md-2 d-flex justify-content-center">
                        {{-- <div>
                            <p class="small text-muted mb-4 pb-2">Total</p>
                            <p class="lead fw-normal mb-0">{{(int)$item->product->selling_price*(int)$item->prod_qty.' Dh'}}</p>
                        </div> --}}
                    </div>
                {{-- @else
                    <div class="col-md-6 d-flex justify-content-center">
                        <h6 class="text-danger">Out of Stock</h6>
                    </div>
                @endif --}}
                    <div class="col-md-1">
                        <i title="Add to cart" class="fas fa-plus me-2 addToCartBtn"></i>
                        <i class="fas fa-trash-alt remove-wishlist-item"></i>
                    </div>
                </div>
            @endforeach
                @else
                    <h4 class="text-muted">No product in your wishlist</h4>
                @endif
            </div>
                </div>

  
        </div>
      </div>
    </div>
  </section>
    
@endsection
