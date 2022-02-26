<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rateProduct(Request $request){
        $stars=$request->product_rating;
        $prod_id=$request->prod_id;
        
        if(Product::where('id',$prod_id)->exists()){
            $verified_purchase=Order::where('orders.user_id',Auth::id())
                ->join('order_items','orders.id','order_items.order_id')
                ->where('order_items.prod_id',$prod_id)->get();
            if($verified_purchase){
                $existing_rating=Rating::where('user_id',Auth::id())->where('prod_id',$prod_id)->first();
                if($existing_rating){
                    $existing_rating->stars=$stars;
                    $existing_rating->update();
                    return redirect()->back()->with('status','thanks for your rating');
                }else{
                    Rating::create([
                        'user_id'=>Auth::id(),
                        'prod_id'=>$prod_id,
                        'stars'=>$stars
                    ]);
                    return redirect()->back()->with('status','thanks for your rating');
                }
            }else{
                return redirect()->back()->with('status','You cannot rate a product without purchase');
            }
        }else{
            return redirect()->back()->with('status','The link is broken');
        }
    }
}
