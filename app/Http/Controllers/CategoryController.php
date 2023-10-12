<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::when(isset($request->keyword),function ($q) use ($request){
            return $q->where('name','LIKE',"%$request->keyword%");
        })->paginate(10);
        return  view('Dashboard.Category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {

        $category = new Category();
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newName = uniqid().$file->getClientOriginalName();
            $filePath = 'public/category_photo';

            if(!Storage::exists($filePath)){
                Storage::makeDirectory($filePath);
            }

            Storage::putFileAs($filePath,$file,$newName);
            $category->photo = $newName;
        }

        $category->name = $request->name;
        $category->save();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully '.$request->name.' category created!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newName = uniqid().$file->getClientOriginalName();
            $filePath = 'public/category_photo/';

            if(!Storage::exists($filePath)){
                Storage::makeDirectory($filePath);
            }

            Storage::putFileAs($filePath,$file,$newName);
            Storage::delete($filePath.$category->photo);
            $ar = array_merge($request->only('name'),['updated_at'=>now(),'photo' => $newName]);

        }else{
            $ar = array_merge($request->only('name'),['updated_at'=>now()]);
        }


        DB::table('categories')->where('id',$category->id)->update($ar);

        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully '.$request->name.' category updated!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
//        Storage::delete('public/brand_photo/'.$category->photo);
        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully '.$category->name.' category deleted!']);
    }
}
