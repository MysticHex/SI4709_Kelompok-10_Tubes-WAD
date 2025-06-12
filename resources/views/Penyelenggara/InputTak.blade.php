@extends('Layouts.AdminLayouts')

@section('main')
    <div class="p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Input TAK Kolektif</h1>
        <form action="{{ route('penyelenggara.storeTak') }}" method="POST">
            @csrf
            <div id="tak-input-container">
                <div class="tak-input-group mb-4">
                    <input type="text" name="mahasiswa_ids[]" placeholder="ID Mahasiswa" class="border rounded px-2 py-1">
                    <input type="text" name="activity_names[]" placeholder="Nama Aktivitas" class="border rounded px-2 py-1">
                    <input type="text" name="categories[]" placeholder="Kategori" class="border rounded px-2 py-1">
                    <input type="text" name="levels[]" placeholder="Level" class="border rounded px-2 py-1">
                    <input type="date" name="activity_dates[]" class="border rounded px-2 py-1">
                </div>
            </div>
            <button type="button" id="add-tak-input" class="btn btn-primary">Tambah Input</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('add-tak-input').addEventListener('click', function () {
            const container = document.getElementById('tak-input-container');
            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'tak-input-group mb-4';
            newInputGroup.innerHTML = `
                <input type="text" name="mahasiswa_ids[]" placeholder="ID Mahasiswa" class="border rounded px-2 py-1">
                <input type="text" name="activity_names[]" placeholder="Nama Aktivitas" class="border rounded px-2 py-1">
                <input type="text" name="categories[]" placeholder="Kategori" class="border rounded px-2 py-1">
                <input type="text" name="levels[]" placeholder="Level" class="border rounded px-2 py-1">
                <input type="date" name="activity_dates[]" class="border rounded px-2 py-1">
            `;
            container.appendChild(newInputGroup);
        });
    </script>
@endsection
