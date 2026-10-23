<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
  public function handle(Request $request, Closure $next)
    {
        // Giả sử truyền token qua URL (?token=123456)
        if (!$request->has('token') || $request->query('token') !== '123456') {
            return redirect('/login');
        }

        return $next($request);
    }
}