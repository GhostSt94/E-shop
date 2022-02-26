@extends('layouts.front')

@section('title')
    {{-- {{$category->name}} --}}
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">Collections / {{$category->name}}</h6>
    </div>
</div>
    <div class="container pb-5">
        <h2 class="m-3">{{$category->name}}</h2>
        <p>{{$category->description}}</p>
        <div class="row py-3">
            @foreach ($products as $prod)
                <div class="col-md-3">
                    {{-- <a href="{{url('categories/'.$category->slug.'/'.$prod->slug)}}"> --}}
                        {{-- <div class="card rounded shadow">
                            @if ($item->image)
                                    <img src="{{asset('assets/uploads/product/'.$item->image)}}" height="160" alt="p">
                                @else
                                    <img src="{{asset('assets/uploads/no_image.jpg')}}" height="150" alt="p">
                                @endif
                                <div class="card-body">
                                    <h5 class="m-2">{{$item->name}}</h5>
                                    <p>{{$item->small_description}}</p>
                                </div>
                        </div> --}}
                        <div class="card my-2 postion-relative product_data">
                            @auth
                                <button class="btn btn-outline-warning addToCartBtn cartBtn"><i class="fas fa-cart-plus fa-xs"></i></button> 
                                <button class="btn btn-outline-info addToWishlistBtn wishlistBtn"><i class="far fa-heart fa-xs"></i></button> 
                            @endauth
                            
                            <a href="{{url('categories/'.$prod->category->slug.'/'.$prod->slug)}}">
                                <input type="hidden" class="prod_id" value="{{$prod->id}}">
                                <div class="container img-size">
                                    @if ($prod->image)
                                        <img src="{{asset('assets/uploads/product/'.$prod->image)}}">
                                    @else
                                        <img src="{{asset('assets/uploads/product/no_image.jpg')}}">
                                    @endif
                                </div>
                                
                                <div class="card-body"> 
                                    <div class="row row1">
                                        <div class="col-8 text-secondary">
                                            <small>{{$prod->category->name}}</small>
                                        </div>
                                        <div class="col-4 text-end text-danger">
                                            <small><s>{{$prod->original_price.' Dh'}}</s></small>
                                        </div>
                                    </div>
                                    <div class="row row3 my-2">
                                        <div class="col-8 card-title">
                                            <h5 title="{{$prod->name}}" class="fw-light text-dark">{{strlen($prod->name)>30? substr($prod->name, 0, 35) . '...':$prod->name}}</h5>
                                        </div>
                                        <span class="col-4 fw-bold text-secondary text-end">{{$prod->selling_price.' Dh'}}</span>   
                                    </div>
                                    {{-- <div class="row">
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
                                                    
                                                {{-- @endif
                                            @endforeach
                                        </div>
                                    </div>  --}}
                                </div>
                            </a>
                        </div>
                    {{-- </a> --}}
                </div>
            @endforeach
        </div>
    </div>
@endsection

