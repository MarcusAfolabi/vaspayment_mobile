<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\ConnectionException;


class CheckLoginSession
{
    public function handle(Request $request, Closure $next)
    {
        try {
            Http::get('https://www.google.com');
            $token = Session::has("token");
            if ($token) {
                return $next($request);
            } else {
                return redirect("/login");
            }
        } catch (ConnectionException $e) {
            return response()->view('errors.no_internet', [], 503);
        }
    }
}
