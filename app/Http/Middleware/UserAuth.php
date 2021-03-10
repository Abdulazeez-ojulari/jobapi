<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->header('X-Header-UserId');

        $user = User::find($userId);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'User with the given id not found',
                'code' => 404,
                'data' => [],
            ])->withHeaders([
                'Content-Type' => 'application/json',
            ]);
            
        }

        return $next($request);
    }
}
