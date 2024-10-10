<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckVerifiedEmail
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $user = Session::get("user");
        // dd($user);
        if ($user['email_verified_at'] == null) {
            Session::flash("error", 'You must verify your email to continue. Check your inbox/spam for your email otp');
            return redirect('/verify-email');
        }
        return $next($request);
    }
}
