<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Client\ConnectionException;

class CheckLoginSession
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $hasInternet = Http::get('http://example.com')->successful();
            if ($hasInternet) {
                if (Session::has("user_token")) {
                    return $next($request);
                } else {
                    // User does not have a token, handle the response accordingly
                    if ($request->expectsJson()) {
                        return response()->json(['error' => 'Unauthorized'], 401);
                    } else {
                        return redirect("/login");
                    }
                }
            } else {
                return response()->json(['error' => 'No internet connection'], 503);
            }
        } catch (\Exception $e) {
            // Handle any exceptions related to session operations
            session()->flash("error", $e->getMessage());
            // Proceed with the request
            return $next($request);
        }
    }
}
