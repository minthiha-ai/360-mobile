<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::with('Brand')->when(isset($request->keyword),function ($q) use ($request){
            return $q->where('name','LIKE',"%$request->keyword%");
        })->get();

        return response()->json(['status'=>'success','data' => CategoryResource::collection($categories)]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $category = Category::where('id',$id)->first();
       if(!$category){
        return response()->json(['status' => 'error' , 'data' => 'Category not Found!'],400);
       }

       return response()->json(['staus' => 'success', 'data' => [
        'id' => $category->id,
        'name' => $category->name,
        'photo' => asset(Storage::url('category_photo'.$category->photo)),
        'brands' => BrandResource::collection($category->Brand)
       ]]);

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
