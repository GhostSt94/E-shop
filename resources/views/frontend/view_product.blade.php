@extends('layouts.front')

@section('title')
    {{$product->name}}
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">Collections / {{$product->category->name}} / {{$product->name}}</h6>
        </div>
    </div>
    <div class="container mb-3">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-4 border-right">
                        @if ($product->image)
                            <img src="{{asset('assets/uploads/product/'.$product->image)}}" class="w-100" alt="p">
                        @else
                            <img src="{{asset('assets/uploads/no_image.jpg')}}" class="w-100" alt="p">
                        @endif
                    </div>

                    <div class="col-md-12 col-lg-8 my-sm-3">
                        <h2 class="mb-0">
                            {{$product->name}}
                            @if ($product->trending=='1')
                                <label class="fs-6 float-end badge bg-danger">Trending</label>
                            @endif
                        </h2>
                        <hr>
                        <label class="me-3">Original Price: <s>{{$product->original_price.' Dh'}}</s></label>
                        <label class="fw-bold fs-5">Selling Price: {{$product->selling_price.' Dh'}}</label>
                        <p class="mt-3">
                            {!! $product->small_description !!}
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                @if ($product->qty>0)
                                    <label class="badge bg-success">In stock</label>
                                @else
                                <label class="badge bg-danger">Out of stock</label>
                                @endif
                            </div>
                            @if ($stars>0)
                                @php
                                    $star=number_format($stars)
                                @endphp
                                <div class="col-md-5">
                                    @for ($i = 1; $i <= $star; $i++)
                                        <i class="fas fa-star checked"></i>
                                    @endfor
                                    @for ($j = $star+1; $j <= 5; $j++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                    <span class="">({{$rating_count}} rating)</span>
                                </div>
                            @endif
                            
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <input type="hidden" class="prod_id" value="{{$product->id}}">
                                @if ($product->qty > 0)
                                    <label for="qty">Quantity 
                                        @if ($product->qty < 10)
                                            <span class="text-danger">({{$product->qty.' in stock'}})</span>
                                        @endif
                                    </label>
                                    <div class="input-group text-center mb-3">
                                        <button class="input-group-text moins">-</button>
                                            <input type="number" name="qty" 
                                                max='{{$product->qty > 10?10:$product->qty}}' readonly value="1" class="form-control bg-light qty">
                                        <button class="input-group-text plus">+</button>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <br>
                                <button class="btn btn-success me-3 addToWishlistBtn float-start"><i class="far fa-heart"></i> Add to Wishlist</button>
                                @if ($product->qty>0)
                                    <button class="btn btn-primary me-3  addToCartBtn float-start"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <h3>Description</h3>
                    <p>{{$product->description}}</p>
                </div>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h3>Reviews</h3>
                        </div>
                        @auth
                        <div class="col text-end">
                            <button title="Add Review" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#Modal">
                                <i class="fas fa-comment-medical"></i>
                            </button>
                            <button title="Rate Product" type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="far fa-star-half"></i>
                            </button>
                        </div>
                        @endauth
                    </div>
                    
                    
                    
                    <div class="row">
                        @foreach ($reviews as $review)
                            <div class="col-md-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <div class="row">
                                                <div class="col">
                                                    <h6>{{$review->user->name}}</h6>
                                                </div>
                                                <div class="col text-end">
                                                    @php
                                                        $s = $review->created_at;
                                                        $date = strtotime($s)
                                                    @endphp
                                                    @if (date("Y-m-d")==date('Y-m-d', $date))
                                                        <small>{{date('H:i', $date)}}</small>
                                                    @else
                                                        <small>{{date('d/M', $date)}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-text bg-light">
                                            <p class="text-muted">{{$review->review}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                

                
            </div>
        </div>
    </div>


    <!-- Modal -->
    @auth
        
    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('/rate-product')}}" method="POST">
        @csrf
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rate Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="rating-css">
                    <input type="hidden" name="prod_id" value="{{$product->id}}">
                    <div class="star-icon">
                        <input type="radio" value="1" name="product_rating" checked id="rating1">
                        <label for="rating1" class="fa fa-star"></label>
                        <input type="radio" value="2" name="product_rating" id="rating2">
                        <label for="rating2" class="fa fa-star"></label>
                        <input type="radio" value="3" name="product_rating" id="rating3">
                        <label for="rating3" class="fa fa-star"></label>
                        <input type="radio" value="4" name="product_rating" id="rating4">
                        <label for="rating4" class="fa fa-star"></label>
                        <input type="radio" value="5" name="product_rating" id="rating5">
                        <label for="rating5" class="fa fa-star"></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </div>
    </form>
  </div>

      
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('/add-review')}}" method="POST">
        @csrf
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Review</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="prod_id" value="{{$product->id}}">
                <textarea name="review" class="form-control"  cols="30" rows="5"></textarea>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </div>
    </form>
  </div>
  @endauth
@endsection

{{-- @section('script')
    <script>
        $(document).ready(()=>{
            $('.addToWishlistBtn').click(function (e) { 
                e.preventDefault();
                var product_id=$(this).closest('.product_data').find('.prod_id').val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/add-to-wishlist",
                    data: {
                        'product_id':product_id
                    },
                    success: function (response) {
                        swal.fire(response.status);
                    }
                });
                
            });
            $('.addToCartBtn').click(function(){
                var product_id=$(this).closest('.product_data').find('.prod_id').val();
                var product_qty=$(this).closest('.product_data').find('.qty').val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/add-to-cart",
                    data: {
                        'product_id':product_id,
                        'product_qty':product_qty
                    },
                    success: function (response) {
                        swal.fire(response.status);
                    }
                });
            })


            $('.plus').click(e=>{
                e.preventDefault();
                var qty=$('.qty').val();
                var max=$('.qty').attr('max');
                if(qty<max){
                    qty++;
                    $('.qty').val(qty);
                }
            });
            $('.moins').click(e=>{
                e.preventDefault();
                var qty=$('.qty').val();
                if(qty>1){
                    qty--;
                    $('.qty').val(qty);
                }
            })
        })
        
    </script>
@endsection --}}