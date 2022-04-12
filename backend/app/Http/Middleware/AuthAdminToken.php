<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdminToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if(!$user = Auth::user())
            {
                return Response()->json(['status'=>false, 'message' => 'Your Session has been expired, Please login again.', 'response' => []], 401);
            }else{                
                return $next($request); 
            }
        } catch(Exception $e){
            return Response()->json(['status'=>false, 'message' => 'Your Session has been expired, Please login again.', 'response' => []], 401);
        }
        return $next($request);
    }
}