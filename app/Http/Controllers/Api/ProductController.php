<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $products = Product::with('Category','Brand','Photos')
                ->when(isset($request->keyword),function ($q) use ($request){
                    return $q
                        ->orWhere('name','LIKE',"%$request->keyword%")->orWhere('size','LIKE',"%$request->keyword%")
                        ->orWhereHas('Category',function ($c) use ($request){
                            return $c->where('name','LIKE',"%$request->keyword%");
                        })
                        ->orWhereHas('Brand',function ($b) use ($request){
                            return $b->where('name','LIKE',"%$request->keyword%");
                        });
                })
                ->latest('id')->paginate(10);

        return response()->json([
           'status' => 'success',
           'data' => ProductResource::collection($products),
           'meta' => [
               'total_product' => $products->total(),
               'current_page' => $products->currentPage(),
               'last_page' => $products->lastPage(),
               'has_more_page' => $products->hasMorePages()
           ],
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->with(['Category','Brand','Photos'])->first();
        if(!$product){
            return response()->json(['status' => 'error' , 'data' => 'Product Not Found!'],404);
        }
        return response()->json([
            'status' => 'success',
            'data' => new ProductResource($product),
        ]);
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
        //
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
