<?php

namespace App\Http\Middleware;

use Closure;
use Setting;

/**
 * Class NotInstalled
 * @package App\Http\Middleware
 */
class NotInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Setting::get('server.installed')) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
