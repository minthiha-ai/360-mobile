<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = User::count();
        $product = Product::count();
        $orderCount = Order::count();

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

        return view('home',compact('user','product','orders','orderCount','totalEarning'));
    }
}
