<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
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

        // Si l'utilisateur n'est pas un membre de l'équipe web, il ne peut pas procéder
        if($request->user()->userMeta->team != 'web') {
          return redirect('/error');
        }

        return $next($request);
    }
}
