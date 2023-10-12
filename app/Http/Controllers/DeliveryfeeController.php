<?php

namespace App\Http\Controllers;

use App\Models\Deliveryfee;
use Illuminate\Http\Request;

class DeliveryfeeController extends Controller
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
        $deliveryfees = Deliveryfee::when(isset($request->keyword),function ($q) use ($request){
            return $q->where('township','LIKE',"%$request->keyword%");
        })->paginate(10);
        return  view('Dashboard.Deliveryfee.create',compact('deliveryfees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $deliveryfee = new Deliveryfee();
        $deliveryfee->region_id = $request->region_id;
        $deliveryfee->township = $request->township;
        $deliveryfee->fees = $request->fees;
        $deliveryfee->save();
        return redirect()->back()->with('message',['icon'=>'success','text'=> $request->township.' Delivery fees successfully created!']);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Deliveryfee $deliveryfee)
    {
        $deliveryfee->region_id = $request->region_id;
        $deliveryfee->township = $request->township;
        $deliveryfee->fees = $request->fees;
        $deliveryfee->update();

        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully '.$request->township.' updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deliveryfee $deliveryfee)
    {
        $deliveryfee->delete();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully '.' Delivery Fees deleted!']);
    }

    public function change(Request $request)
{
        $deliveryfee = Deliveryfee::find($request->id);
        $deliveryfee->status = !$deliveryfee->status;
        $deliveryfee->save();
        return redirect()->with(['message'=>'Status change successfully.']);
}


}
