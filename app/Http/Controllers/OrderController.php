<?php

namespace App\Http\Controllers;

use App\Models\Order;
use PHPUnit\Exception;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orders = Order::with('orderProduct','user:id,name,phone')->where('unique_id',$order->unique_id)->first();
        $total = $orders->orderProduct->sum('sub_price');
        return view('Dashboard.Order.show')->with(['orders' => $orders , 'totalPrice' => $total]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrder($unique_id)
    {
        $order = Order::where('unique_id',$unique_id)->first();


            switch($order->status) {
                case '0':
                    $order->status = '1';
                    break;
                case '1':
                    $order->status = '2';
                    break;
                case '2':
                    $order->status = '2';
                    break;
                default:
                    break;
            }

            $order->update();


        return redirect()->back()->with('message',['icon'=>'success','text' => 'Order is ' . config('status.status.'.$order->status)]);
    }

    public function reject($unique_id){
        DB::beginTransaction();

        try {
            $order = Order::with('orderProduct')->where('unique_id',$unique_id)->first();
            $order->status = '3';
            $order->update();
            foreach ($order->orderProduct as $OP){
                $OP->product->increment('stock',$OP->quantity);
            }
            DB::commit();

            return redirect()->route('home')->with('message',['icon'=>'success','text' => 'Order is rejected']);
        }catch (Exception $err){
            DB::rollBack();
            return redirect()->back()->with('message',['icon'=>'success','text' => $err->getMessage()]);
        }


    }

    public function orderGraph(Request $request)
    {
        $years = [];
        $year = $request->year ?? now()->format('Y');
        for ( $i=1; $i<13; $i++){

            $orders = Order::whereMonth('created_at',$i)->whereYear('created_at',$year)->with('orderProduct')->first();

            array_push($years,['month' => $i , 'price' => $orders != null ? $orders->orderProduct->sum('sub_price') / 100000: 0]);
        }

        return view('Dashboard.Order.graph')->with(['years'=>$years]);

    }

    public function orderlist(Request $request)
    {

        $orders = Order::
                    when(isset($request->keyword),function ($q) use ($request){
                        return $q->orWhereHas('User',function ($p) use ($request){
                                    return $p->where('name',"LIKE","%$request->keyword%");
                                })->orWhere('unique_id',$request->keyword);
                    })->
                   when(isset(request()->status),function ($q){
                       return $q->where('status',request()->status);
                   })->latest()->paginate(10);

        $totalEarning =  OrderProduct::sum('sub_price');

        return view('Dashboard.Order.order-list',compact('orders','totalEarning'));
    }


}
