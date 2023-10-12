<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
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
    public function create(Request $request)
    {
        $banners = Banner::all();
        return  view('Dashboard.Banner.create',compact('banners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        
        $file = $request->file('photo');
        $newName = uniqid().$file->getClientOriginalName();
        $filePath = 'public/banner_photo';

        if(!Storage::exists($filePath)){
            Storage::makeDirectory($filePath);
        }

        Storage::putFileAs($filePath,$file,$newName);

        $data = ['created_at'=>now(),'updated_at'=>now(),'photo' => $newName];
        DB::table('banners')->insert($data);

        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully banner created!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newName = uniqid().$file->getClientOriginalName();
            $filePath = 'public/banner_photo/';

            if(!Storage::exists($filePath)){
                Storage::makeDirectory($filePath);
            }

            Storage::putFileAs($filePath,$file,$newName);
            Storage::delete($filePath.$banner->photo);
            $data = ['updated_at'=>now(),'photo' => $newName];

        }else{
            $data = array_merge(['updated_at'=>now()]);
        }


        DB::table('banners')->where('id',$banner->id)->update($data);

        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully '.$request->name.' category updated!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
//        Storage::delete('public/brand_photo/'.$category->photo);
        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully '.' Banner deleted!']);
    }
}
