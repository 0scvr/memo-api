<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Exception;
use Closure;

class AuthMiddleware
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
            $apiKey = $request->input('api_key');
            $player = $request->input('player');

            $result = DB::table('players')->where([
                ['username', '=', $player],
                ['api_key', '=', $apiKey],
            ])->get();
    
            // Stop the request if api key is invalid
            if (sizeof($result) != 1) {
                throw new Exception("API key is missing or invalid.", 1);
            }

            // Forward request if api key is valid
            return $next($request);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 403);
        }
    }
}
