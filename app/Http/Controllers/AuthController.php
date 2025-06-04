<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
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
        
        if (!auth()->attempt($request->only('email', 'password'))) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
            
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['login_error' => 'Email atau password yang Anda masukkan salah.']);
        }
        
        $user = auth()->user();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            if ($user->role == "Admin") {
                return redirect()->route(route: 'register')->with([
                    'message' => 'Login successful',
                    'user' => $user,
                    'token' => $token
                ]);
            }
            else {
                return redirect()->route(route: 'home')->with([
                    'message' => 'Login successful',
                    'user' => $user,
                    'token' => $token
                ]);
            }
        }
    }
}
