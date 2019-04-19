<?php

namespace App\Http\Middleware;

use App\Whitelist;
use Closure;

class IpMiddleware
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
        $whitelist = new Whitelist;

        if (!in_array($request->ip(), $whitelist->get()->pluck('ip_address')->toArray()))
        {
            return response()
                ->json([
                    'error' => 'ip niet bekend',
                    'status' => 404,
                ], 404);
        }

        return $next($request);
    }
}
