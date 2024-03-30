<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|string',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return response()->json(['status'=>200, 'message'=>'register successfully.']);
    }

    public function login (Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = User::where("email", $request->email)->first();

        if(!empty($user)){
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken("my_token")->plainTextToken;
                return response()->json([
                    "status" => 200,
                    "message" => "login successfully",
                    "token" => $token
                ]);
            }else{
                return response()->json([
                    "status" => 401,
                    "message" => "password is wrong"
                ]);
            }
        }else{
            return response()->json([
                "status" => 401,
                "message" => "email is wrong"
            ]);
        }
    }

    public function logout (){
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => 200,
            "message" => "logout successfully"
        ]);
    }

    public function profile (){
        $user = auth()->user();
        return response()->json([
            "status" => 200,
            "data" => $user,
            'id' => auth()->id(),
        ]);
    }

}
