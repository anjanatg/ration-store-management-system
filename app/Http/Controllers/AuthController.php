<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {}
    public function loggedIn(LoginRequest $request)
    {
        try {
            $result = $this->authService->login( $request->validated(),$request );

            if ($result === 'invalid') { return response()->json(['errors' => ['login' => ['Invalid email or password']]], 422);}
            if ($result === 'inactive') { return response()->json(['errors' => ['login' => ['Your account is deactivated']]], 422);}
            $route = $this->authService->dashboard(Auth::user());

            if ($route === null) { 
                $this->authService->logout($request);
                return response()->json(['errors' => ['login' => ['Invalid email or password']]], 422);
            }
            return response()->json(['redirect' => route($route)]);
        } 
        catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function login ()
    {
        return view('auth.login');
    }
    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return redirect()->route('login');
    }
}
