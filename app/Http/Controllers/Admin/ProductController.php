<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(){
        $product=Product::orderBY('created_at','DESC')->paginate(5);
        return view('admin.product.index',[
            'products'=>$product
        ]);
    }
    // public function getProducts(){
    //     $product=Product::orderBY('created_at','DESC')->paginate(5);
    // }
    public function getProducts($name=null){
        $page=false;
        if($name==null || $name==''){
            $products=Product::orderBY('created_at','DESC')->paginate(5);
            $page=true;
        }else{
            $products=Product::where('name','LIKE',"%$name%")->get();
        }
        $txt="";
        foreach ($products as $item) {
            $txt.="<div class='row py-2'>
                    <div class='col-xs-5 col-md-3'><p>".$item->name."</p></div>
                    <div class='col-xs-5 col-md-3'>".$item->category->name."</div>
                    <div class='col-xs-5 col-md-2'>".$item->selling_price." Dh</div>
                    <div class='col-md-3'>
                        <img src=".asset('assets/uploads/product/'.$item->image)." alt=".$item->name." height='100'>
                    </div>
                    <div class='col-md-1'>
                            <a href='".url('/dashboard/products/edit/'.$item->id)."'>
                                <span class='material-icons'>edit</span>
                            </a>
                            <a href='".url('delete-product/'.$item->id)."'>
                                <span class='material-icons'>delete</span>
                            </a>
                        </div>
                    </div>    
                </div><hr>";
        }
        $page ? 
            $pagination="
            <div class='row justify-content-center my-2'>
                <div class='col-md-4'>"
                     .$products->links()."
                    <p>
                        Displaying ".$products->count()." of ".$products->total() ." product(s).
                    </p>
                </div>
            </div>" : $pagination=null;
        return [$txt,$pagination];
    }
 

    public function add(){
        $categories=Category::all();
        return view('admin.product.add',compact('categories'));
    }

    public function insert(Request $request){
        $Product= new Product();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('assets/uploads/product',$filename);
            $Product->image=$filename;
        }

        $Product->name=$request->name;
        $Product->cate_id=$request->cate_id;
        $Product->slug=Str::slug($request->name);
        $Product->small_description=$request->small_description;
        $Product->description=$request->description;
        $Product->original_price=$request->original_price;
        $Product->selling_price=$request->selling_price;
        $Product->tax=$request->tax;
        $Product->qty=$request->qty;
        $Product->status=$request->status==true?"1":"0";
        $Product->trending=$request->trending==true?"1":"0";
        $Product->meta_title=$request->meta_title;
        $Product->meta_keywords=$request->meta_keywords;
        $Product->meta_description=$request->meta_description;
        $Product->save();
        return redirect('/dashboard/products')->with('status','Product added');
    }

    public function edit($id){
        $Product=Product::find($id);
        $categories=Category::all();
        return view('admin.product.edit',[
            'product'=>$Product,
            'categories'=>$categories
        ]);
    }
    public function update(Request $request,$id){
        $Product=Product::find($id);
        if($request->hasFile('image')){
            $path='assets/uploads/product/'.$Product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('assets/uploads/product',$filename);
            $Product->image=$filename;
        }
        $Product->name=$request->name;
        $Product->cate_id=$request->cate_id;
        $Product->slug=Str::slug($request->name);
        $Product->small_description=$request->small_description;
        $Product->description=$request->description;
        $Product->original_price=$request->original_price;
        $Product->selling_price=$request->selling_price;
        $Product->tax=$request->tax;
        $Product->qty=$request->qty;
        $Product->status=$request->status==true?"1":"0";
        $Product->trending=$request->trending==true?"1":"0";
        $Product->meta_title=$request->meta_title;
        $Product->meta_keywords=$request->meta_keywords;
        $Product->meta_description=$request->meta_description;
        $Product->update();
        return redirect('/dashboard/products')->with('status','Product updated successfully');
    }


    public function destroy($id){
        $Product=Product::find($id);
        if($Product->image){
            $path='assets/uploads/product/'.$Product->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $Product->delete();
        return redirect('/dashboard/products')->with('status','Product deleted successfully');
    }
}
