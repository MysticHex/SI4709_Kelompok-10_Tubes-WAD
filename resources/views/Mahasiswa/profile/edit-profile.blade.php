@extends('Layouts.MahasiswaLayouts')
@section('title', 'Edit Profil Mahasiswa')

@section('main')
    <div class="container mx-auto max-w-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Profil Mahasiswa</h2>
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('mahasiswa.update.profile.submit') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->nama) }}"
                    class="input input-bordered w-full" required>
            </div>
            <div>
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="input input-bordered w-full" required>
            </div>
            <div>
                <label for="password" class="label">
                    <span class="label-text">
                        Password <small class="text-gray-400">(Kosongkan jika tidak ingin mengubah)</small>
                    </span>
                </label>
                <input type="password" id="password" name="password" class="input input-bordered w-full">
                <input type="password" id="password_confirmation" name="password_confirmation" class="input input-bordered w-full mt-2" placeholder="Konfirmasi Password">
            </div>
            <button type="submit" class="btn btn-primary w-full">Simpan Perubahan</button>
        </form>

        <hr class="my-8">

        <!-- Modal trigger -->
        <label for="delete-modal" class="btn btn-error w-full mt-2">Hapus Akun</label>

        <!-- Modal -->
        <input type="checkbox" id="delete-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Konfirmasi Hapus Akun</h3>
                <p class="py-4">Apakah Anda yakin ingin menghapus akun ini?</p>
                <div class="modal-action">
                    <label for="delete-modal" class="btn">Batal</label>
                    <form action="{{ route('mahasiswa.delete.profile') }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection