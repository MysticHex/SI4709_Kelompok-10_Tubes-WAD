@extends('Layouts.MahasiswaLayouts')

@section('main')
    <div class="p-6 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Edit Feedback</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('feedbacks.update', $feedback->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block font-semibold mb-2">Judul</label>
                <input type="text" name="title" id="title" class="input input-bordered w-full" value="{{ old('title', $feedback->title) }}" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block font-semibold mb-2">Pesan</label>
                <textarea name="message" id="message" rows="4" class="input input-bordered w-full" required>{{ old('message', $feedback->message) }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('mahasiswa.feedback') }}" class="btn btn-secondary ml-2">Kembali</a>
        </form>
    </div>
@endsection