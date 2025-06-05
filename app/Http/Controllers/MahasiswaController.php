<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //
    public function index()
    {
        // Logika untuk menampilkan dashboard mahasiswa
        return view('mahasiswa.dashboard');
}
}
