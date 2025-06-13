{{-- filepath: resources/views/Mahasiswa/feedback/index.blade.php --}}
@extends('Layouts.MahasiswaLayouts')

@section('main')
    <div class="p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Daftar Feedback</h1>

        <a href="{{ route('feedbacks.create') }}" class="btn btn-primary mb-4">Tambah Feedback</a>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($feedbacks->isEmpty())
            <p>Tidak ada feedback.</p>
        @else
            <table class="table-auto w-full bg-white rounded shadow">
                <thead>
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Pesan</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $index => $feedback)
                        <tr>
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $feedback->message }}</td>
                            <td class="border px-4 py-2">{{ $feedback->created_at->format('d-m-Y H:i') }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus feedback ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection