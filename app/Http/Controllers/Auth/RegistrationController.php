<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request){

        $user = User::create([
            'firstname'     => $request->firstname,
            'lastname'     => $request->lastname,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),

        ]);
        if($user){
            event(new Registered($user));


            return response()->json(['status' => 'success','message' => 'Account Created Successfully'], 200);
        } else {
            return response()->json(['status' => 'error','message' => 'Error While creating Account'], 401);

        }
    }
}
