<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdviceRequest;
use App\Http\Requests\UpdateAdviceRequest;
use App\Models\Advice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Illuminate\Events\queueable;

class AdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advices = Advice::when(isset($request->keyword),function ($q) use ($request){
            return $q->whereHas('user',function ($u) use ($request){
                return $u->where('name','LIKE',"%$request->keyword%");
            })->orWhere('description','LIKE',"%$request->keyword%");
        })->latest()->paginate(10);
        return  view('Dashboard.Advice.index',compact('advices'));
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
     * @param  \App\Http\Requests\StoreAdviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdviceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advice  $advice
     * @return \Illuminate\Http\Response
     */
    public function show(Advice $advice)
    {
        return $advice;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advice  $advice
     * @return \Illuminate\Http\Response
     */
    public function edit(Advice $advice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdviceRequest  $request
     * @param  \App\Models\Advice  $advice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdviceRequest $request, Advice $advice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advice  $advice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advice $advice)
    {
        $advice->delete();
        if($advice->photo != 'advice.png'){
            Storage::delete('/app/public/advice_photo/'.$advice->photo);
        }
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully Deleted']);
    }
}
