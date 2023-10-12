<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $carts = Cart::with('Product')->where('user_id',Auth::id())->get();
        $price = 0;
        $totaLPrice = $carts->map(function ($value) use ($price){
               return $price += $value->product->price * $value->quantity;
        });

        return response()->json([
            'status' => 'success',
            'data' => CartResource::collection($carts),
            'totalPrice' => array_sum($totaLPrice->toArray()),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $product = Product::where('id',$request->product_id)->first();
        if(!$product){
            return response()->json(['status' => 'error' , 'data' => 'Product Not Found On DB!'],404);
        }
        $checkCart = Cart::where('user_id',Auth::id())->where('product_id',$product->id)->first();
     //    return $checkCart;
        if($checkCart){
         $checkCart->quantity = $request->quantity;
         // return($checkCart);
            return response()->json(['status' => 'success' , 'data' => "you added $product->name to cart"],200);
        }

     //    if($request->quantity < 0)

        $validate = Validator::make($request->all(), [
            'product_id' => ['required', 'exists:products,id'],
         //    'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock],
        ]);

        if($validate->fails()){
            return response()->json(['data' => $validate->getMessageBag()]);
        }

        DB::beginTransaction();

         try {


             // foreach ($request->carts as $cart){
             //     return($request->carts);


             // }
             // if(
             //     Product::where('id',$cart['product_id'])->exists()){
             //     $product = Product::where('id',$cart['product_id'])->first();

             //     $quantity = (int)$cart['quantity'];



             //     $cart = new Cart();
             //     $cart->product_id = $product->id;
             //     $cart->user_id = Auth::id();
             //     $cart->quantity = $quantity;
             //     $cart->save();

             // }else{
             //     return response()->json(['status' => 'error' , 'data' => 'product id '. $cart['product_id'].'  not exists']);
             // }

             $cart = new Cart();
             $cart->product_id = $product->id;
             $cart->user_id = Auth::id();
             $cart->quantity = $request->quantity;
             $cart->save();

             DB::commit();

             return response()->json(['status' => 'success' , 'message' => 'successfully added']);

         }catch (\Exception $err){
             DB::rollBack();
             return response()->json(['status' => 'error' , 'data' => $err->getMessage()]);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::where('id',$id)->first();
        if(!$cart){
            return response()->json(['status' => 'error' , 'data' => 'Cart NOT FOUND!']);
        }
        $validate = Validator::make($request->all(), [
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$cart->Product->stock],
        ]);

        if($validate->fails()){
            return response()->json(['status' => 'error' , 'data' => $validate->getMessageBag()]);
        }

        $cart->quantity = $request->quantity;
        $cart->update();
        return response()->json(['status' => 'success' , 'data' => 'successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCart($cart_id)
    {

        $cart = Cart::where('user_id',Auth::id())->where('id',$cart_id)->first();

        if($cart){
            $cart->delete();

            return response()->json(['status' => 'success' , 'data' => 'successfully deleted']);
        }

        return response()->json(['status' => 'error' , 'data' => 'Not found']);

    }
}
