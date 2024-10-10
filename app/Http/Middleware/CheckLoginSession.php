<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginSession
{
   
    public function handle(Request $request, Closure $next): Response
    {
        $token = Session::get("token");
        if ($token == null) {
            Session::flash("error", 'You must login to access this page');
            return redirect('/login');
        }
        return $next($request);
    }
    
}
