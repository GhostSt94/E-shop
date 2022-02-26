@extends('layouts.admin')

@section('content')
<div class="container-fluid add-form">
    <h3>Products</h3>
    <form action="{{url('insert-product')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" aria-label="Name">
            </div>
            <div class="col">
                <label for="cat" class="form-label">Category</label>
                <select id="cat" class="form-select" name="cate_id">
                    <option value="">Select a category</option>
                    @foreach ($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-2">
            <label for="desc1" class="form-label">Small Description</label>
            <textarea id="desc1" class="form-control" rows="2" name="small_description" placeholder="Description"></textarea>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description</label>
            <textarea id="desc" class="form-control" rows="3" name="description" placeholder="Description"></textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="price1" class="form-label">Original price</label>
                <input type="text" id="price1" name="original_price" class="form-control" placeholder="Original price" aria-label="Name">
            </div>
            <div class="col">    
                <label for="p" class="form-label">Selling price</label>
                <input type="text" id="p" name="selling_price" class="form-control" placeholder="Selling price" aria-label="Name">
            </div>
            <div class="col">    
                <label for="t" class="form-label">Tax</label>
                <input type="text" id="t" name="tax" class="form-control" placeholder="Tax" aria-label="Name">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="q" class="form-label">Quantity</label>
                <input type="number" id="q" name="qty" class="form-control" placeholder="qty" aria-label="Name">
            </div>
            <div class="col form-check pt-2">
                <input class="form-check-input" name="status" type="checkbox"  id="flexCheckDefault" checked>
                <label class="form-check-label" for="flexCheckDefault">
                  Status
                </label>
            </div>
            <div class="col form-check pt-2">
                <input class="form-check-input" name="trending" type="checkbox"  id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Trending
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="meta_t" class="form-label">Meta title</label>
            <input class="form-control" id="meta_t" type="text" name="meta_title" placeholder="Meta Title">
        </div>
        <div class="mb-3">
            <label for="meta_d" class="form-label">Meta description</label>
            <textarea class="form-control" id="meta_d" name="meta_description" placeholder="Meta Description" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label for="meta_k" class="form-label">Meta keywords</label>
            <textarea class="form-control" id="meta_k" name="meta_keywords" placeholder="Meta Keywords" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label mb-1">Image</label>
            <input class="form-control" name="image" type="file" id="formFile">
        </div>
        <div class="row justify-content-end">
            <div class="col-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection