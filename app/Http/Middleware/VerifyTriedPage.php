<?php

namespace App\Http\Middleware;

use Closure;

class VerifyTriedPage
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
        if (\Auth::check()) {
            $tried = $request->session()->get('tried_to', 'none');
            if ($tried != 'none') {
                $request->session()->forget('tried_to');
                return redirect()->route($tried);
            }
        }
        
        return $next($request);
    }
}
