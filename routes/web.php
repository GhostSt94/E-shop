<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FrontendController as AdminFrontController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\frontend\FrontendController as FrontendFrontendController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class,'index']);
Route::get('/categories', [FrontendController::class,'categories']);
Route::get('/categories/{slug}', [FrontendController::class,'view_category']);
Route::get('/categories/{slug}/{product_slug}', [FrontendController::class,'view_product']);

Route::get('/product-list', [FrontendController::class,'productListAjax']);
Route::post('/search-product', [FrontendController::class,'searchProduct']);

Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/add-to-cart',[CartController::class,'addToCart']);
Route::post('/remove-cart-item',[CartController::class,'remove_item_cart']);
Route::post('/update-cart-item',[CartController::class,'update_item_cart']);
Route::get('/load-cart-data',[CartController::class,'cartCount']);

Route::post('/add-to-wishlist',[WishlistController::class,'addToWishlist']);
Route::post('/remove-wishlist-item',[WishlistController::class,'remove_item_wishlist']);
Route::get('/load-wishlist-data',[WishlistController::class,'wishlistCount']);

Route::middleware(['auth'])->group(function(){
    Route::get('/cart',[CartController::class,'viewCart']);
    Route::get('/checkout',[CheckoutController::class,'index']);
    Route::post('/place-order',[CheckoutController::class,'placeOrder']);
    Route::post('/proceed-to-pay',[CheckoutController::class,'razorpayCheck']);

    Route::get('/my-orders',[UserController::class,'index']);
    Route::get('/order-details/{id}',[UserController::class,'orderDetails']);

    Route::get('/wishlist',[WishlistController::class,'index']);
    
    Route::post('/rate-product',[RatingController::class,'rateProduct']);
    Route::post('/add-review',[ReviewController::class,'add']);
});

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[AdminFrontController::class,'index']);
    // Category
    Route::get('/dashboard/categories',[CategoryController::class,'index']);
    Route::get('/dashboard/categories/add',[CategoryController::class,'add']);
    Route::post('insert-category',[CategoryController::class,'insert']);
    Route::get('/dashboard/categories/edit/{id}',[CategoryController::class,'edit']);
    Route::put('update-category/{id}',[CategoryController::class,'update']);
    Route::get('delete-category/{id}',[CategoryController::class,'destroy']);
    Route::get('/get-categories/{name?}',[CategoryController::class,'getCategories']);
    // Product
    Route::get('/dashboard/products',[ProductController::class,'index']);
    Route::get('/dashboard/products/add',[ProductController::class,'add']);
    Route::post('insert-product',[ProductController::class,'insert']);
    Route::get('/dashboard/products/edit/{id}',[ProductController::class,'edit']);
    Route::put('update-product/{id}',[ProductController::class,'update']);
    Route::get('delete-product/{id}',[ProductController::class,'destroy']);
    Route::get('/get-products/{name?}',[ProductController::class,'getProducts']);
    //users
    Route::get('/dashboard/users',[DashboardController::class,'users']);
    Route::get('/dashboard/users/{id}',[DashboardController::class,'viewUser']);
    //Orders
    Route::get('/dashboard/orders',[OrderController::class,'index']);
    Route::get('/dashboard/orders/history',[OrderController::class,'ordersHistory']);
    Route::get('/dashboard/orders/{id}',[OrderController::class,'viewOrder']);
    Route::post('/update-order/{id}',[OrderController::class,'updateOrder']);
});