<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        // dump($request);

        // return response()->json($request->email);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // $token = $user->createToken('accessToken')->plainTextToken;
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}