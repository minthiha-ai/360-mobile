<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email' ,'unique:users,email'],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
            'password' => ['required', 'min:8'],
        ]);

        if($validate->fails()){
            return response()->json(['data' => $validate->getMessageBag()]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        $token = $user->createToken('api_user')->plainTextToken;
        return response()->json(['status' => 'success' , 'data' => $user ,'token' => $token]);
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => ['required', 'string', 'max:255',],
            'password' => ['required', 'string',  ],
        ]);

        if($validate->fails()){
            return response()->json(['data' => 'Email Or Password Wrong!']);
        }

        if(Auth::attempt($validate->validated())){

            $token = Auth::user()->createToken('api_user')->plainTextToken;
            return response()
                ->json(['status' => 'success','token' => $token, 'user' => Auth::user()], 200);
        }else{
            return response()
                ->json(['status' => 'error',  'data' => 'Something Was Wrong!'], 200);
        }

    }

    public function logout()
    {

        $user = User::where('id',Auth::id())->first();
        $user->tokens()->delete();
        return response()->json(['status' => 'success',  'data' => 'Successfully Logout!'], 200);
    }

    public function deleteUser($id)
    {
        $user = User::where('id',$id)->first();
        if(!$user){
            return response()->json(['status' => 'error',  'data' => 'User Not Found'], 200);
        }
        $orders = Order::where('user_id',$user->id)->get();
        $orders->each->delete();
        $user->forceDelete();
        return response()->json(['status' => 'success',  'data' => 'Successfully Deleted!'], 200);
    }
}
