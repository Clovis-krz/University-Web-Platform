<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\UserController;

class IsStudent
{
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->IsStudent()) {
            return $next($request);
        }
        abort(403,'You are not a Student');
    }
}
