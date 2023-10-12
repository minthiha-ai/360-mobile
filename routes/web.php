<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdviceController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryfeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegionController;
use App\Models\Payment;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::middleware(['auth','admin'])->group(function (){

    Route::resource('user', UserController::class);
    Route::post('user/detail/',[UserController::class,'userDetail'])->name('user.detail');

    Route::resource('category', CategoryController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('product', ProductController::class);
    Route::resource('blog',BlogController::class);
    Route::resource('payment',PaymentController::class);
    Route::resource('region',RegionController::class);
    Route::resource('deliveryfee',DeliveryfeeController::class);
    Route::resource('advice', AdviceController::class)->only(['index','show','destroy']);
    Route::resource('order', OrderController::class)->only(['index','show']);
    Route::get('/order_list',[OrderController::class,'orderlist'])->name('orderList');
    Route::get('product_photo/{id}',[ProductController::class,'deletePhoto'])->name('product_photo.delete');
    Route::get('order_admin/{order}',[OrderController::class,'updateOrder'])->name('order_admin.update');
    Route::get('order_admin_graph',[OrderController::class,'orderGraph'])->name('order_admin.graph');
    Route::get('order_admin_reject/{unique_id}',[OrderController::class,'reject'])->name('order.reject');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/changeStatus/{id}',[PaymentController::class,'changeStatus']);
    Route::get('/change/{id}',[DeliveryfeeController::class,'change']);
});

Route::get('/policy',function (){
    return view('policy');
})->name('policy');
