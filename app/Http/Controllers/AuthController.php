<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ErrorResponse;
use App\Models\JwtResponse;
use App\Models\SuccessResponse;
use App\Models\UserResponse;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login_post', 'register']]);
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json(new ErrorResponse('Unauthorized'), 401);
        }

        return response()->json(new JwtResponse($token, $this->getExpiration()));
    }

    public function login_get()
    {
        $user = Auth::user();

        return response()->json(new UserResponse($user));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(new SuccessResponse());
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(new SuccessResponse());
    }

    public function refresh()
    {
        return response()->json(new JwtResponse(Auth::refresh(), $this->getExpiration()));
    }

    /**
     * Returns the expiration time of the current token in seconds
     * @return int Expiration time
     */
    private function getExpiration() {
        return Auth::factory()->getTTL() * 60;
    }
}
