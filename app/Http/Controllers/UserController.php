<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function register(Request $request)
   {
      $user=  User::create(
           [
                "name" => $request->name,
                "email" => $request->email,
                "password"=> Hash::make($request->password)
            ]);
  return new UserResource($user);

   }
   public function login(LoginRequest $request)
   {
     $user= User::whereEmail($request->email)->first();
     if(isset($user->id)){
  if(Hash::check($request->password,$user->password)){
                $token= $user->createToken('token-name', ['server:update'])->plainTextToken;
                return response()->json([
                    "message" => "connected successfuly",
                    "token" => $token

                ], 200);
  } else {
                return response()->json([
                    "message" => "password invalid"
                ], 400);
            }
     }else{
return response()->json([
    "message"=>"invalide user"
],400);
     }
   }
   public function profile()
   {
    return new UserResource(auth()->user());
   }
   public function logout()
   {
     auth()->user()->tokens()->delete();
        return response()->json([
            "message" => "deconnected successfuly",


        ], 200);
   }
}
