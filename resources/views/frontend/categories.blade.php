@extends('layouts.front')

@section('title')
    Categories
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">Categories</h6>
    </div>
</div>
    <div class="container pb-5">
        <div class="row">
            <h2 class="m-3">All Categories</h2>
            @foreach ($featured_cats as $cat)
                <div class="col-md-3">
                    <div class="item">
                        <a href="{{url('categories/'.$cat->slug)}}">
                        <div class="card">
                            @if ($cat->image)
                                <img src="{{asset('assets/uploads/category/'.$cat->image)}}" height="200" alt="category">
                            @else
                                <img src="{{asset('assets/uploads/no_image.jpg')}}" height="200" alt="category">
                            @endif
                            <div class="card-body">
                                {{-- <h5 class="row1 m-2 text-dark">{{$cat->name}}</h5> --}}
                                <h5 title="{{$cat->name}}" class="row1 text-dark">{{strlen($cat->name)>40? substr($cat->name, 0, 40) . '...':$cat->name}}</h5>
                                <p class="row1 text-secondary">{{$cat->description}}</p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
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
            items:5,
            nav:true,
            loop:false
        }
    }
})
    </script>
@endsection