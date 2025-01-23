<?php

namespace App\Filters;

use Closure;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;

class DefaultFilter extends Filter
{
    /**
     * Processes the current filter without altering the request.
     * 
     * @param Request $request The request to process.
     * @param Closure $next The next callback in the chain.
     * @return mixed
     */
    protected function handler(Request $request, Closure $next)
    {
        app(Logger::class)->info('DefaultFilter is processing the request');

        return $next($request);
    }
}
