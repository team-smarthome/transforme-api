<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserRole;

class AuthSanctumMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();

            $currentAccessToken = $user->currentAccessToken();  
            $latestAccessToken = $user->tokens()->latest()->first();
    
            if (!$currentAccessToken || $currentAccessToken->id !== $latestAccessToken->id) {
                return response()->json(['status' => "error", 'message' => 'Token Invalid'], 403);
            }
            // Query untuk mendapatkan role_name dari user
            $userRole = UserRole::where('id', function ($query) use ($user) {
                $query->select('user_role_id')
                    ->from('users')
                    ->where('id', $user->id);
            })->first();

            if ($userRole && in_array($userRole->role_name, $roles)) {
                $request->merge(['user' => $user]);
                return $next($request);
            } else {
              if (!$userRole) {
                return response()->json(['status' => "NO", 'message' => 'Forbidden'], 403);
            } else {
                if ($userRole->role_name == 'operator') {
                    return response()->json(['status' => "NO", 'message' => 'Must be admin or superadmin'], 403);
                } else if ($userRole->role_name == 'admin') {
                    return response()->json(['status' => "NO", 'message' => 'Must be superadmin'], 403);
                }
            }
            }
        } 

        return response()->json(['status' => "error", 'message' => 'Bearer token required'], 401);
    }
}
