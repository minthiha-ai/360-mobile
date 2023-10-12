<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class BrandController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $brands = Brand::when(isset($request->keyword),function ($q) use ($request){
            return $q->where('name','LIKE',"%$request->keyword%");
        })->paginate(10);
        return  view('Dashboard.Brand.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newName = uniqid().$file->getClientOriginalName();
            $filePath = 'public/brand_photo';

            if(!Storage::exists($filePath)){
                Storage::makeDirectory($filePath);
            }

            Storage::putFileAs($filePath,$file,$newName);
            $brand->photo = $newName;

        }
        $brand->category_id = $request->category_id;
        $brand->name = $request->name;
        $brand->save();
        return redirect()->back()->with('message',['icon'=>'success','text'=> $request->name.' brand successfully created!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newName = uniqid().$file->getClientOriginalName();
            $filePath = 'public/brand_photo/';

            if(!Storage::exists($filePath)){
                Storage::makeDirectory($filePath);
            }

            Storage::putFileAs($filePath,$file,$newName);
            Storage::delete($filePath.$brand->photo);

            $ar = array_merge($request->only(['name','category_id']),['updated_at'=>now(),'photo' => $newName]);

        }else{
            $ar = array_merge($request->only(['name','category_id']),['updated_at'=>now()]);
        }

        DB::table('brands')->where('id',$brand->id)->update($ar);

        return redirect()->back()->with('message',['icon'=>'success','text'=> $request->name.' brand successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        Storage::delete('public/brand_photo/'.$brand->photo);
        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully '.$brand->name.' category deleted!']);
    }
}
