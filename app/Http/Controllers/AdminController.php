<?php

namespace App\Http\Controllers;

use App\Models\TAKSubmission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tak = TAKSubmission::with('user')->latest()->paginate(10);
        $users = User::latest()->paginate(10);
        return view('admin.dashboard', compact('tak', 'users'));
    }
    public function editUser()
    {
        $admin = auth()->user();
        return view('admin.edit', compact('admin'));
    }
    public function updateUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $id = auth()->id();
        $user = User::findOrFail($id);
        $user->nama = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('admin.users')->with('success', 'Profile updated successfully.');
    }
    public function deleteUser()
    {
        $user = auth()->user();
        if ($user->role !== 'admin') {
            return redirect()->route('admin.users')->with('error', 'You do not have permission to delete this user.');
        }
        $user->delete();
        return redirect()->route('login')->with('success', 'User deleted successfully.');
    }


}
