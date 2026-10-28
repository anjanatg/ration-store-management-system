<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function login(array $credentials,Request $request):string
    {
        if(!Auth::attempt($credentials))
            {
                return 'invalid';
            }
        if(!Auth::user()->is_active){
            $this->logout($request);
            return 'inactive';
        }
        $request->session()->regenerate ();
        return 'ok';
    }
    public function logout(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
    public function dashboard(User $user) : ?string
    {
        return match ($user->role)
        {
           'admin' => 'admin.dashboard',
           'staff' => 'staff.dashboard',
           default => null,
        };
    }
}
