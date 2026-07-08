<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSessionTimeout
{
    protected int $timeoutMinutes = 10;

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('admin_last_activity');

            if ($lastActivity && (time() - $lastActivity) > ($this->timeoutMinutes * 60)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->withErrors(['email' => 'Votre session a expiré après ' . $this->timeoutMinutes . ' minutes d\'inactivité. Veuillez vous reconnecter.']);
            }

            session(['admin_last_activity' => time()]);
        }

        return $next($request);
    }
}
