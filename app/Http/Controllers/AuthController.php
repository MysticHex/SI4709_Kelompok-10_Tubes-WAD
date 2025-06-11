<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private const LOGIN_SUCCESS_MESSAGE = 'Login successful';
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['message' => 'User registered successfully', 'user' => $user, 'token' => $token], 201);
        } else {
            return response()->json(['message' => 'User registration failed'], 500);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['error' => 'The email or password you entered is incorrect.']);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        $responseData = [
            'message' => self::LOGIN_SUCCESS_MESSAGE,
            'user' => $user,
            'token' => $token
        ];

        if ($request->wantsJson()) {
            return response()->json($responseData, 200);
        }

        if (strtolower($user->role) === 'admin') {
            $redirectRoute = 'admin.dashboard';
        }
        if (strtolower($user->role) === 'mahasiswa' ||strtolower($user->role) === 'student') {
            $redirectRoute = 'mahasiswa.dashboard';
        }
        return redirect()->route($redirectRoute)->with($responseData);
    }
}
