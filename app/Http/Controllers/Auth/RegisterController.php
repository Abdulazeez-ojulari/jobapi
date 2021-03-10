<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|max:255'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
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
                'Content-Type' => 'application/json'
            ]);
        }
    }
}
