<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        $wishlist=Wishlist::all();
        return view('frontend.wishlist',compact('wishlist'));
    }
    
    public function addToWishlist(Request $request){
        $product_id=$request->product_id;
        if(Auth::check()){
            if(Product::find($product_id)){
                if(Wishlist::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                    return response()->json([
                        'status'=>'already added to Wishlist'
                    ]);
                }else{
                    $wish=new Wishlist();
                    $wish->prod_id=$product_id;
                    $wish->user_id=Auth::id();
                    $wish->save();
                    return response()->json([
                        'status'=>'added to Wishlist'
                    ]);
                }
            }
        }else{
            return response()->json([
                'status'=>'Login to continue'
            ]);
        }
    }

    public function remove_item_wishlist(Request $request){

        if(Auth::check()){
            $prod_id=$request->prod_id;
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $item=Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $item->delete();
                return response()->json([
                    'status'=>'product removed',
                    'success'=>200
                ]);
            }
        }else{
            return response()->json([
                'status'=>'Login to continue',
                'success'=>200
            ]);
        }
    }

    public function wishlistCount(){
        $cartCount=Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$cartCount]);
    }
}
