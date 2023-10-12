<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::when(isset($request->keyword),function ($q) use ($request){
            return $q->where('name','LIKE',"%$request->keyword%");
        })->latest()->paginate(10);
        return view('Dashboard.User.index',compact('users'));
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return  view('Dashboard.User.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
       $request->validate([
           'name' => 'nullable|string',
           'email' => 'nullable|email|unique:users,email,'.$user->id,
           'phone' => 'nullable|unique:users,phone,'.$user->id,
           'password' => 'nullable|min:8|max:20',

        ]);

        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->phone = $request->phone ?? $user->phone;
        $user->password = $request->password != null ? Hash::make($request->password) : $user->getAuthPassword();
        $user->update();

        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message',['icon'=>'success','text'=>$user->name . 'is successfully deleted!']);
    }

    public function userDetail(Request $request)
    {
        $user = UserDetail::where('user_id',Auth::id())->first();

        if($user){
            $user->messager_id = $request->messager_id;
            $user->page_id = $request->page_id;
            $user->address = $request->address;
            $user->update();
        }else{
            $new = new UserDetail();
            $new->user_id = Auth::id();
            $new->messager_id = $request->messager_id;
            $new->page_id = $request->page_id;
            $new->address = $request->address;
            $new->save();
        }

        return redirect()->back()->with('message',['icon'=>'success','text'=>'Information is successfully updated!']);

    }
}
