<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::where('status',"0")->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function viewOrder($id){
        $orders=Order::where('id',$id)->first();
        return view('admin.orders.view',compact('orders'));
    }

    public function updateOrder(Request $request,$id){
        $order=Order::where('id',$id)->first();
        $order->status=$request->order_status;
        $order->update();
        return redirect('dashboard/orders')->with('status','Order Updated Successfully');
    }

    public function ordersHistory(){
        $orders=Order::where('status','1')->get();
        return view('admin.orders.history',compact('orders'));
    }
}
