<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user && $request->routeIs('login.store')) {

            $candidate = User::where('email', $request->input('email'))->first();

            if ( $candidate &&Hash::check((string) $request->input('password'),$candidate->password) &&! $candidate->is_active)
            {
                return $this->deactivated($request);
            }
        }

        if ($user && ! $user->is_active) {

            Auth::logout(); 
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return $this->deactivated($request);
        }

        return $next($request);
    }
    private function deactivated(Request $request): Response
    {
        $message = 'Your account is deactivated';

        if ($request->expectsJson()) {
            return response()->json(['errors' => ['login' => [$message]]], 422);
        }

        return redirect()->route('login')->withErrors(['login' => $message]);
    }
}
