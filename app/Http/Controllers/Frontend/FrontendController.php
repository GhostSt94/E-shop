<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $featured_products=Product::where('trending','1')->take(20)->get();
        $popular_cat=Category::where('status','1')->where('popular','1')->take(15)->get();
        $featured_prods_ids=Product::select('id')->take(20)->get();
        $ratings=Rating::whereIn("prod_id",$featured_prods_ids)->get();
        return view('frontend.index',compact('featured_products','popular_cat','ratings'));
    }

    public function categories(){
        $featured_cats=Category::where('status','1')->get();
        return view('frontend.categories',compact('featured_cats'));
    }

    public function view_category($slug){
        if(Category::where('slug',$slug)->exists()){
            $category=Category::where('slug',$slug)->first();
            $products=Product::where('cate_id',$category->id)->get();
            return view('frontend.view_category',compact('category','products'));
        }else{
            return redirect('/')->with('status','Category doesnt exist');
        }
    }

    public function view_product($slug,$product_slug){
        if(Category::where('slug',$slug)->exists()){
            if(Product::where('slug',$product_slug)->exists()){
                $product=Product::where('slug',$product_slug)->first();
                $reviews=Review::where('prod_id',$product->id)->orderBy('created_at', 'desc')->get();
                $rating=Rating::where('prod_id',$product->id)->get();
                $count=$rating->count();
                $total=0;
                if($count>0){
                    foreach ($rating as $rate) {
                        $total+=$rate->stars;
                    }
                    $stars=$total/$count;
                }else{
                    $stars=0;
                }
                
                return view('frontend.view_product',[
                    'product'=>$product,
                    'stars'=>$stars,
                    'rating_count'=>$count,
                    'reviews'=>$reviews
                ]);
            }else{
                return redirect('/')->with('status','Product doesnt exist');
            }
        }else{
            return redirect('/')->with('status','Product doesnt exist');
        }
    }

    public function productListAjax(){
        $products=Product::select('name')->get();
        $data=[];

        foreach ($products as $item) {
            $data[]=$item['name'];
        }

        return $data;
    }

    public function searchProduct(Request $request)
    {
        $s_prod=$request->search;
        if($s_prod!=''){
            $product=Product::where('name','LIKE',"%$s_prod%")->first();
            if ($product) {
                return redirect('categories/'.$product->category->slug.'/'.$product->slug);
            } else {
                return redirect()->back()->with('status','No product found');
            }
        }else{
            return redirect()->back();
        }
    }
}
