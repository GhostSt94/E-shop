<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $products=Product::all()->count();
        $categories=Category::all()->count();
        $users=User::all()->count();
        $orders=Order::all()->count();
        return view('admin.index',compact('products','categories','users','orders'));
    }
}
