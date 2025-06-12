<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //
    public function index()
    {
        $user=auth()->user();
        $taks = $user->taks()->paginate(10);
        // return view('mahasiswa.index', compact('user', 'taks'));
        return view('mahasiswa.dashboard',compact('user', 'taks'));
    }

    public function createTak()
    {
        return view('mahasiswa.tak.create');
    }
    public function edit($id)
    {
        return view('mahasiswa.tak.edit', compact('id'));
    }
    public function update(Request $request, $id){
        $user=auth()->user();
        $request->validate([
            'activity_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'activity_date' => 'required|date',
            'point' => 'nullable|integer|min:0',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Adjust file validation as needed
        ]);
        $tak = $user->taks()->findOrFail($id);
        $tak->activity_name = $request->activity_name;
        $tak->category = $request->category;
        $tak->level = $request->level;
        $tak->activity_date = $request->activity_date;
        $tak->point = $request->point;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('tak_files', 'public'); // Store in public/tak_files
            $tak->file_path = $path;
        }
        $tak->save();
        return redirect()->route('mahasiswa.tak')->with('success', 'Data TAK berhasil diperbarui.');
    }
    public function editProfile()
    {
        $user = auth()->user();
        return view('mahasiswa.profile.edit-profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $user->nama = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('mahasiswa.update.profile')->with('success', 'Profil berhasil diperbarui.');
    }
    public function destroyProfile()
    {
        $user = auth()->user();
        $user->delete();
        return redirect()->route('login')->with('success', 'Akun berhasil dihapus.');
    }
}