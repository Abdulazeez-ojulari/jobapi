<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email and password',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                'Content-Type' => 'application/json',
            ]);

        }else{
            return response()->json([
                'status' => 'success',
                'message' => 'successful',
                'code' => 200,
                'data' => Auth::user(),
            ])->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
    }
}
