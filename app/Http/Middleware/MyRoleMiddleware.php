<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class MyRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasMyRole($role)) {
            Auth::guard('web')->logout();
            request()->session()->invalidate();

            request()->session()->regenerateToken();
            return redirect('/');
        }

        // if($role == 'dealer')
        // {
        //      if (! $request->user()->hasDealerOf($request->dealer))
        //      {
        //         abort(401);
        //      }
        // }

        // if($role == 'agent')
        // {
        //      if (! $request->user()->hasAgentOf($request->agent))
        //      {
        //         abort(401);
        //      }
        // }

        return $next($request);
    }
}
