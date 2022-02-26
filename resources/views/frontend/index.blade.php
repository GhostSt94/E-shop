@extends('layouts.front')

@section('title')
    Welcome to E-shop
@endsection

@section('content')
    @include('layouts.inc.front.slider')
    <div class="container py-5">
        <div class="row">
            <h2 class="m-3">Featured Products</h2>
            <div class="owl-carousel owl-theme">
                @foreach ($featured_products as $prod)
                    <div class="item">
                        <div class="card postion-relative product_data">
                            @auth
                                <button class="btn btn-outline-warning addToCartBtn cartBtn"><i class="fas fa-cart-plus fa-xs"></i></button> 
                                <button class="btn btn-outline-info addToWishlistBtn wishlistBtn"><i class="far fa-heart fa-xs"></i></button> 
                            @endauth
                            
                            <a href="{{url('categories/'.$prod->category->slug.'/'.$prod->slug)}}">
                                <input type="hidden" class="prod_id" value="{{$prod->id}}">
                                @if ($prod->image)
                                    <img src="{{asset('assets/uploads/product/'.$prod->image)}}" height="200">
                                @else
                                    <img src="{{asset('assets/uploads/product/no_image.jpg')}}" height="200">
                                @endif
                                <div class="card-body"> 
                                    <div class="row row1">
                                        <div class="col-8 text-secondary">
                                            <small>{{$prod->category->name}}</small>
                                        </div>
                                        <div class="col-4 text-end text-danger">
                                            <small><s>{{$prod->original_price.' Dh'}}</s></small>
                                        </div>
                                    </div>
                                    <div class="row row2 my-2">
                                        <div class="col-8 card-title">
                                            <h5 title="{{$prod->name}}" class="fw-light text-dark">{{strlen($prod->name)>20? substr($prod->name, 0, 40) . '...':$prod->name}}</h5>
                                        </div>
                                        <span class="col-4 fw-bold text-secondary text-end">{{$prod->selling_price.' Dh'}}</span>   
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <span class="text-secondary"><span class="fw-light">Available: </span> {{$prod->qty}}</span>
                                        </div>
                                        <div class="col-7 text-end">
                                            @php   
                                                $star=0;
                                                $i=0;
                                                foreach ($ratings as $rating) {
                                                    if($rating->prod_id==$prod->id){
                                                        $star+=$rating->stars;
                                                        $i++;
                                                    }
                                                }
                                                if($i!=0){$star=$star/$i;}else{$star=0;}
                                                $star=number_format($star)
                                            @endphp
                                            @foreach ($ratings as $rating)
                                                @if ($rating->prod_id==$prod->id && $rating->stars>0)
                                                    
                                                        @for ($j = 1; $j <= $star; $j++)
                                                            <i class="fas fa-star checked"></i>
                                                        @endfor
                                                        {{-- <span class="">({{$i}})</span> --}}
                                                    
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container-fluid mt-3 py-3">
            <h2 class="m-3">Popular Categories</h2>
            <div class="row">
                @foreach ($popular_cat as $cat)
                    <div class="col-md-{{$cat->id%2==0? '2':'1'}}">
                        <a href="{{url('categories/'.$cat->slug)}}">
                            <span class="badge bg-secondary">{{$cat->name}}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:false
        }
    }
})
    </script>
@endsection