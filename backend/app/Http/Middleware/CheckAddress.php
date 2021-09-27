<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class CheckAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (App::environment(['staging', 'production'])) {
            $ip = [
                ['id' => 3, 'ip' => '192.168.0.3', 'name' => '自宅'],
            ];

            // check your ip
            $detect = collect($ip)->contains('ip', $request->ip());

            if (!$detect) {
                abort(403);
            }
        }

        return $next($request);
    }
}
