<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
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
        $usuario=\Auth::user();
        /*if($usuario->type != "USER"){
            $notification = array( 'message' => 'No tienes permiso para entrar a esta pagina.',
                  'alert-type' => 'error',
            );
            return redirect('/denied')->with($notification);
        }*/
        return $next($request);
    }
}
