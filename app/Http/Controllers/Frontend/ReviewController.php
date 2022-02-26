<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add(Request $request){
        $prod_id=$request->prod_id;
        $review=$request->review;

        if(Product::where('id',$prod_id)->exists()){
            $verified_purchase=Order::where('orders.user_id',Auth::id())
                ->join('order_items','orders.id','order_items.order_id')
                ->where('order_items.prod_id',$prod_id)->get();
            if($verified_purchase){
                $existing_rating=Review::where('user_id',Auth::id())->where('prod_id',$prod_id)->first();
                // if($existing_rating){
                //     $existing_rating->review=$review;
                //     $existing_rating->update();
                //     return redirect()->back()->with('status','thanks for your review');
                // }else{
                    Review::create([
                        'user_id'=>Auth::id(),
                        'prod_id'=>$prod_id,
                        'review'=>$review
                    ]);
                    return redirect()->back()->with('status','thanks for your review');
                // }
            }else{
                return redirect()->back()->with('status','You cannot rate a product without purchase');
            }
        }
    }
}
