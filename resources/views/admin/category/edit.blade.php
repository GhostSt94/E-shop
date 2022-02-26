@extends('layouts.admin')

@section('content')
<div class="container-fluid add-form">
    <h3>Edit Category</h3>
    <form action="{{url('update-category/'.$category->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">Name</label>
              <input value="{{$category->name}}" type="text" id="name" name="name" class="form-control" placeholder="Name" aria-label="Name">
            </div>
            <div class="col">
                <label for="slug" class="form-label">Slug</label>
              <input value="{{$category->slug}}" type="text" id="slug" name="slug" class="form-control" placeholder="Slug" aria-label="Slug">
            </div>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description</label>
            <textarea id="desc" class="form-control" rows="3" name="description" placeholder="Description">
                {{$category->description}}
            </textarea>
        </div>
        <div class="row">
            <div class="col form-check">
                <input {{$category->status =='1'? "active":""}} class="form-check-input" name="status" type="checkbox"  id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Status
                </label>
            </div>
            <div class="col form-check">
                <input {{$category->popular =='1'? "active":""}} class="form-check-input" name="popular" type="checkbox"  id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Popular
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="meta_t" class="form-label">Meta title</label>
            <input value="{{$category->meta_title}}" class="form-control" id="meta_t" type="text" name="meta_title" placeholder="Meta Title">
        </div>
        <div class="mb-3">
            <label for="meta_d" class="form-label">Meta description</label>
            <textarea class="form-control" id="meta_d" name="meta_description" placeholder="Meta Description" rows="2">
                {{$category->meta_description}}
            </textarea>
        </div>
        <div class="mb-3">
            <label for="meta_k" class="form-label">Meta keywords</label>
            <textarea class="form-control" id="meta_k" name="meta_keywords" placeholder="Meta Keywords" rows="2">
                {{$category->meta_keywords}}
            </textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                {{-- <div class=""> --}}
                    <label for="formFile" class="form-label mb-1">Image</label>
                    <input class="form-control" name="image" type="file" id="formFile">
                {{-- </div> --}}
            </div>
            <div class="col m-2">
                @if ($category->image)
                    <img width="200" src="{{asset('assets/uploads/category/'.$category->image)}}" alt="{{$category->image}}">
                @else
                    <h5>Aucune image</h5>
                @endif
                
            </div>
        </div>
        
        <div class="row justify-content-end">
            <div class="col-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection