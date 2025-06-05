@extends('Layouts.AdminLayouts')
@section('title', 'Dashboard Admin')

@section('main')
    <div class="flex-1 p-6 bg-gray-100">
        <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="card bg-white shadow-md p-4">
                <h2 class="text-lg font-semibold mb-2">Selamat Datang, {{ auth()->user()->name }}</h2>
                <p class="text-gray-600">Ini adalah dashboard admin Anda. Gunakan menu di sebelah kiri untuk mengelola
                    aplikasi.</p>
            </div>
        </div>
    </div>
@endsection
