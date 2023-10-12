<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
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
        $payments = Payment::when(isset($request->keyword),function ($q) use ($request){
            return $q->where('name','LIKE',"%$request->keyword%");
        })->paginate(10);
        return  view('Dashboard.Payment.create',compact('payments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = new Payment();
        if($request->hasFile('pimage')){
            $file = $request->file('pimage');

            $newPname = uniqid().$file->getClientOriginalName();
            $filePath = 'public/payment_photo';

            if(!Storage::exists($filePath)){
                Storage::makeDirectory($filePath);
            }

            Storage::putFileAs($filePath,$file,$newPname);
            $payment->payment_image = $newPname;

        }
        if($request->hasFile('qrimage')){
            $file = $request->file('qrimage');

            $newName = uniqid().$file->getClientOriginalName();
            $filePath = 'public/payment_photo';

            if(!Storage::exists($filePath)){
                Storage::makeDirectory($filePath);
            }

            Storage::putFileAs($filePath,$file,$newName);
            $payment->payment_qr = $newName;

        }

        $payment->payment_name = $request->payment_name;
        $payment->payment_number = $request->payment_number;
        $payment->save();
        return redirect()->back()->with('message',['icon'=>'success','text'=> $request->name.' Payment successfully created!']);

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

    public function changeStatus(Request $request)
    {
        $payment = Payment::find($request->id);
        $payment->status = !$payment->status;
        $payment->save();
        return redirect()->with(['message'=>'Status change successfully.']);
    }
}
