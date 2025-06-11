@extends('Layouts.MahasiswaLayouts')
@section('title', 'Dashboard Mahasiswa')

@section('main')
    <div class="flex-1 p-6 bg-gray-100">
        <h1 class="text-2xl font-semibold mb-4">Dashboard Mahasiswa</h1>
        <div class="card bg-white shadow-md p-4">
            <h2 class="text-lg font-semibold mb-2">Selamat Datang, {{ auth()->user()->nama }}</h2>
            <p class="text-gray-600">Ini adalah dashboard mahasiswa Anda. Gunakan menu di sebelah kiri untuk mengakses
                fitur-fitur aplikasi.</p>
        </div>
    </div>
@endsection