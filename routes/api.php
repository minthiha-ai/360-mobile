<?php

use App\Http\Controllers\Api\AdviceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::middleware(['responseJsonHeader','auth:sanctum'])->group(function (){

    Route::post('logout',[AuthController::class,'logout']);
    Route::resource('cart', CartController::class);
    Route::delete('cart/delete/{user_id}', [CartController::class,'deleteCart']);
    Route::resource('order', OrderController::class);
    Route::resource('advice', AdviceController::class)->only('store');

    Route::get('delete/user/{id}',[AuthController::class,'deleteUser']);
});

Route::get('banner', [BannerController::class,'index']);
Route::resource('product', ProductController::class)->only('index','show');
Route::resource('category', CategoryController::class)->only('index','show');

Route::get('app/detail',function (){

    $userDetail = \App\Models\User::where('id','1')->with('detail')->first();

    $data = [
        'name' => $userDetail->name,
        'email' => $userDetail->email,
        'phone' => $userDetail->phone,
        'messager_id' => $userDetail->detail->messager_id,
        'page_id' => $userDetail->detail->page_id,
        'address' => $userDetail->detail->address,
    ];

    return response()->json(['status'=>'success','data' => $data]);

});
