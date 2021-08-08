<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Response\API;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;
use Exception;

class JwtMiddleware extends API
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
        //Cek middlewareException
        $getCurrentUri = $request->getRequestUri();
        if (in_array($getCurrentUri, config('middlewareException'))) {
            return $next($request);
        }

        //Cek bearerToken if Not Set
        $token = $request->bearerToken();
        if (!$token) {
            return $this->respondUnauthorized('This access requires a Token.');
        }

        try {
            JWTAuth::parseToken()->authenticate();

            //Menambahkan data pada tiap request token
            $payload = JWTAuth::parseToken()->getPayload();
            $request['user_id'] = $payload->get('data')->user_id;
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->respondInvalidRequest('Incorrect token.');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->respondInvalidRequest('The token has expired.');
            } else {
                return $this->respondInvalidRequest('Token not found.');
            }
        }

        return $next($request);
    }
}
