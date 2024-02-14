<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && $this->isAdmin($request)) {
            return $next($request);
        }

        return abort(403, 'Unauthorized'); 
    }
    protected function isAdmin($request) {
        return $request->user()->role_id == '1';
    }
}
