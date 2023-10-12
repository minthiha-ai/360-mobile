<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdviceController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required|string',
            'photo' => 'nullable|image'
        ]);
        if($validate->fails()){
            return response()->json(['status'=>'error','data'=>$validate->getMessageBag()]);
        }
        $advice = new Advice();
        $advice->user_id = Auth::id();
        $advice->title = $request->title;
        $advice->description = $request->description;

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newname = uniqid().$file->getClientOriginalName();


            $path = '/public/advice_photo';
            if(!Storage::exists($path)){
                Storage::makeDirectory($path);
            }

            Storage::putFileAs($path,$file,$newname);
            $advice->photo = $newname;

        }


        $advice->save();

        return response()->json(['status' => 'success' , 'data' => 'successfully sended!']);

    }
}
