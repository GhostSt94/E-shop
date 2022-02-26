<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product_id=$request->product_id;
        $product_qty=$request->product_qty;
        if(Auth::check()){
            $prod_check=Product::where('id',$product_id)->first();
            if($prod_check){
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                    return response()->json([
                        'status'=>$prod_check->name.' already added to cart'
                    ]);
                }else{
                $cart_item=new Cart();
                $cart_item->prod_id=$product_id;
                $cart_item->prod_qty=$product_qty;
                $cart_item->user_id=Auth::id();
                $cart_item->save();
                return response()->json([
                    'status'=>$prod_check->name.' added to cart'
                ]);
            }
            }
        }else{
            return response()->json([
                'status'=>'Login to continue'
            ]);
        }
    }

    public function viewCart(){
        $cart_items=Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cart_items'));
    }

    public function remove_item_cart(Request $request){

        if(Auth::check()){
            $prod_id=$request->prod_id;
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $item=Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
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

    public function update_item_cart(Request $request){

        if(Auth::check()){
            $prod_id=$request->prod_id;
            $prod_qty=$request->prod_qty;
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $item=Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $item->prod_qty=$prod_qty;
                $item->update();
                return response()->json([
                    'status'=>'product updated',
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

    public function cartCount(){
        $cartCount=Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$cartCount]);
    }
}
