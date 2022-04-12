<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
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

       
        // ALLOW OPTIONS METHOD
        $headers = [
             'supportsCredentials' => false,
            'allowedOrigins' => ['*'],
            'allowedOriginsPatterns' => [],
            'allowedHeaders' => ['*'],
            'allowedMethods' => ['*'],
            'exposedHeaders' => [],
            'maxAge' => 0,
        ];
        if($request->getMethod() == "OPTIONS") {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return Response::make('OK', 200, $headers);
        }

        $response = $next($request);
        foreach($headers as $key => $value)
            $response->header($key, $value);
        return $response;
    }



}
