@extends('Layouts.MahasiswaLayouts')

@section('main')
    <div class="p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Update TAK Kolektif</h1>
        <form action="{{ route('mahasiswa.tak.update', $tak->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">ID Mahasiswa</span>
                </label>
                <input type="text" name="mahasiswa_ids" value="{{ $tak->mahasiswa_ids }}" placeholder="ID Mahasiswa" class="input input-bordered w-full">
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Nama Aktivitas</span>
                </label>
                <input type="text" name="activity_names" value="{{ $tak->activity_names }}" placeholder="Nama Aktivitas" class="input input-bordered w-full">
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Kategori</span>
                </label>
                <input type="text" name="categories" value="{{ $tak->categories }}" placeholder="Kategori" class="input input-bordered w-full">
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Level</span>
                </label>
                <input type="text" name="levels" value="{{ $tak->levels }}" placeholder="Level" class="input input-bordered w-full">
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Tanggal Aktivitas</span>
                </label>
                <input type="date" name="activity_dates" value="{{ $tak->activity_dates }}" class="input input-bordered w-full">
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">File Aktivitas</span>
                </label>
                <input type="file" name="activity_file" class="input input-bordered w-full">
                @if($tak->activity_file)
                    <p class="mt-2 text-sm">File saat ini: <a href="{{ asset('storage/' . $tak->activity_file) }}" target="_blank" class="text-blue-600 underline">Lihat File</a></p>
                @endif
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
@endsection