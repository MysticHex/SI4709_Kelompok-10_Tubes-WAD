@extends('layouts.adminLayouts')
@section('title', 'Edit Profil Admin')

@section('main')
    <div class="container mx-auto max-w-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Profil Admin</h2>
        <form action="{{ route('admin.update', $admin->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $admin->nama) }}"
                    class="input input-bordered w-full" required>
            </div>
            <div>
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}"
                    class="input input-bordered w-full" required>
            </div>
            <div>
                <label for="password" class="label">
                    <span class="label-text">
                        Password <small class="text-gray-400">(Kosongkan jika tidak ingin mengubah)</small>
                    </span>
                </label>
                <input type="password" id="password" name="password" class="input input-bordered w-full">
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
                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
