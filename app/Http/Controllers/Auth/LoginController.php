<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        if (auth()->attempt($request->validated())) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;
            return response()->json([
                'status'    => 'success',
                'token' => $token,
                'message' => 'SuccessFUlly Logged In',
                'data' => auth()->guard('web')->user()], 200);
        } else {
            return response()->json(['status' => 'error',  'message' => 'Incorrect Login Details', 'status' => 'error'], 401);
        }


    }
}
