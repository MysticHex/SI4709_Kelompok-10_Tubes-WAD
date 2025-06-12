@extends('Layouts.MahasiswaLayouts')

@section('main')
    <div class="p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Input TAK Kolektif</h1>
        <form action="{{ route('mahasiswa.tak.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="tak-input-container">
                <div class="tak-input-group mb-4">
                    <input type="hidden" name="mahasiswa_id" placeholder="ID Mahasiswa" class="input input-bordered w-full mb-2" value="{{ Auth::user()->id }}">
                    <input type="text" name="activity_names" placeholder="Nama Aktivitas"
                        class="input input-bordered w-full mb-2">
                    <select name="categories" class="select select-bordered w-full mb-2">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Lomba">Lomba</option>
                        <option value="Organisasi">Organisasi</option>
                        <option value="Seminar">Seminar</option>
                    </select>
                    <select name="levels" class="select select-bordered w-full mb-2">
                        <option value="" disabled selected>Pilih Level</option>
                        <option value="Regional">Regional</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                    <input type="date" name="activity_dates" class="input input-bordered w-full mb-2">
                    <input type="file" name="activity_files" class="input input-bordered w-full"accept=".pdf,.doc,.docx">
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">Simpan</button>
        </form>
    </div>
@endsection