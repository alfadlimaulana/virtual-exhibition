<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role == $role) {
            if($role == 'pelukis' && Carbon::now() > Carbon::parse($request->user()->subscription->expired_date)) {
                return redirect()->route('expired');
            }

            return $next($request);
        }
        abort(401, 'This action is unauthorized.');
    }
}
