<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsTeacher
{
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->IsTeacher()) {
            return $next($request);
        }
        abort(403,'You are not a Teacher');
    }
}
