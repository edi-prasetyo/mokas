<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role_as == '1' || Auth::user()->role_as == '2' || Auth::user()->role_as == '4') {
            return redirect('/member/dashboard')->with('status', 'Access Denied. As you are not Seller');
        }
        return $next($request);
    }
}
