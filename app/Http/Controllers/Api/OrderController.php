<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Symfony\Component\String\u;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orders = Order::orderBy('id','DESC')->with('orderProduct')->where('user_id',Auth::id())->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => OrderResource::collection($orders),
            'meta' => [
                'total_product' => $orders->total(),
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'has_more_page' => $orders->hasMorePages()
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if($request->user_id != Auth::id()){
            return response()->json(['status' => 'error' , 'data' => 'Auth id Not Equal']);
        }

        $carts = Cart::where('user_id',Auth::id())->get();
        if(count($carts) == 0){
            return response()->json(['status' => 'error' , 'data' => 'no cart found on db']);
        }

        $orderId = uniqid();

        DB::beginTransaction();
        try {

            $order = new Order();
            $order->unique_id = $orderId;
            $order->user_id = Auth::id();
            $order->save();

            $addToOrders = $carts->mapToGroups(function ($p) use($orderId,$order){
                $product = Product::where('id',$p['product_id'])->first();

                if($p['quantity'] > $product->stock){
                    DB::rollBack();
                    return response()->json([
                        'status' => 'success' ,
                        'data' => " $product->name stock is only available $product->stock" ]);
                }

                $product->decrement('stock',$p['quantity']);

                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id ;
                $orderProduct->quantity = $p['quantity'];
                $orderProduct->product_price = $product->price;
                $orderProduct->product_id = $product->id;
                $orderProduct->sub_price = $product->price * $p['quantity'];
                $order->status = '0';
                $orderProduct->save();

                return [ 'total' => $orderProduct->sub_price ];
            })->all();

            $total = array_sum($addToOrders['total']->toArray());
            $carts->each->delete();

            DB::commit();
            return response()->json(['status' => 'success' , 'data' => 'successfully ordered' , 'total' => $total , 'order_id' => $orderId ]);

        }catch (\Exception $err){
            DB::rollBack();

            return response()->json(['status' => 'error' , 'data' => $err->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $order = Order::with('orderProduct')->where('unique_id',$id)->get();

        return response()->json(['status' => 'success' , 'data' => $order]);

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
        return  $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
