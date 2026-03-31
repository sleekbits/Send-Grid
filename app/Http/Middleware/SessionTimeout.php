<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        $timeout = (int) config('security.session_timeout', 30);
        $last = $request->session()->get('last_activity_at');

        if ($last && now()->diffInMinutes($last) >= $timeout) {
            auth()->logout();
            $request->session()->invalidate();
            return redirect('/login')->withErrors(['email' => 'Session timed out.']);
        }

        $request->session()->put('last_activity_at', now());

        return $next($request);
    }
}
