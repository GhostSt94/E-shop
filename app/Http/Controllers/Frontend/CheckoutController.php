<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class CheckoutController extends Controller
{
    public function index(){

        $old_cartItems=Cart::where('user_id',Auth::id())->get();
        foreach($old_cartItems as $item){
            if(!Product::where('id',$item->prod_id)->where("qty",">=",$item->prod_qty)->exists()){
                $removeItem=Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $cartItems=Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('cartItems'));
    }

    public function placeOrder(Request $request){
        
        $order=new Order();
        $order->user_id=Auth::id();
        $order->fname=$request->fname;
        $order->lname=$request->lname;
        $order->address1=$request->address1;
        $order->address2=$request->address2;
        $order->email=$request->email;
        $order->phone=$request->phone;
        $order->city=$request->city;
        $order->country=$request->country;
        $order->pin_code=$request->pin_code;
        $order->tracking_no=strtoupper(substr($request->fname,0,2)).rand(1111,9999);
        $order->total_price='';
        $order->payment_mode=$request->payment_mode;
        $order->payment_id=$request->payment_id;
        $order->save();

        $total=0;
        $cartItems=Cart::where('user_id',Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'=>$order->id,
                'prod_id'=>$item->prod_id,
                'qty'=>$item->prod_qty,
                'price'=>$item->product->selling_price,
            ]);

            $prod=Product::where('id',$item->prod_id)->first();
            $prod->qty=$prod->qty-$item->prod_qty;
            $prod->update();


            $total+=$item->product->selling_price*$item->prod_qty;
            $item->delete();
        }
        $order->total_price=$total;
        $order->update();

        if(Auth::user()->address1==null){
            $user=User::where('id',Auth::id())->first();
            $user->name=$request->fname;
            $user->lname=$request->lname;
            $user->phone=$request->phone;
            $user->address1=$request->address1;
            $user->address2=$request->address2;
            $user->city=$request->city;
            $user->country=$request->country;
            $user->pin_code=$request->pin_code;
            $user->update();
        }
        if($request->payment_mode=='Paid by Paypal'){
            return response()->json(['status','Order placed Successfully']);
        }
        return redirect('/')->with('status','Order placed successfully');
    }

    public function razorpayCheck(Request $request){
        $cartItems=Cart::where('user_id',Auth::id())->get();
        $total_price=0;
        foreach ($cartItems as $item) {
            $total_price += $item->product->selling_price*$item->prod_qty;
        }
        $fname=$request->fname;
        $lname=$request->lname;
        $email=$request->email;
        $phone=$request->phone;
        $addr1=$request->addr1;
        $addr2=$request->addr2;
        $city=$request->city;
        $country=$request->country;
        $pin=$request->pin;

        return response()->json([
            'lname'=>$lname,
            'fname'=>$fname,
            'email'=>$email,
            'phone'=>$phone,
            'addr1'=>$addr1,
            'addr2'=>$addr2,
            'city'=>$city,
            'country'=>$country,
            'pin'=>$pin
        ]);
    }
}
