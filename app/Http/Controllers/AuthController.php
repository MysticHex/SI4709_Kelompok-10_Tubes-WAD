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
            'student_id' => 'required|string|max:255',
            'role' => 'required|string|in:admin,student',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'nama' => $request->input('name'),
            'user_id' => $request->input('student_id'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        if ($user) {
            if (request()->wantsJson()) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json(['message' => 'User registered successfully', 'user' => $user, 'token' => $token], 201);
            }
            return redirect()->route('login')->with('message', self::LOGIN_SUCCESS_MESSAGE);

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

        if (strtolower($user->role) === 'admin') {
            $redirectRoute = 'admin.dashboard';
        } elseif (strtolower($user->role) == 'student') {
            $redirectRoute = 'mahasiswa.dashboard';
        }

        return redirect()->route($redirectRoute);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
            Auth::guard('web')->logout();
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Logout successful'], 200);
            }
            return redirect()->route('login')->with('message', 'Logout successful');
        }
        return response()->json(['message' => 'User not authenticated'], 401);
    }
}
