@extends('Layouts.MahasiswaLayouts')
@section('title', 'Dashboard Mahasiswa')

@section('main')
    <div class="flex-1 p-6 bg-gray-100">
        <h1 class="text-2xl font-semibold mb-4">Dashboard Mahasiswa</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="card bg-white shadow-md p-4">
                <h2 class="text-lg font-semibold mb-2">Data Mahasiswa</h2>
                <p class="text-gray-600">Nama: {{ $user->nama }}</p>
                <p class="text-gray-600">Email: {{ $user->email }}</p>
                <p class="text-gray-600">NIM: {{ $user->user_id }}</p>
            </div>

            <div class="card bg-white shadow-md p-4">
                <h2 class="text-lg font-semibold mb-2">Total Poin TAK</h2>
                <p class="text-2xl font-bold text-gray-800">{{ $user->taks()->sum('point') }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-3">Data Tabel TAK</h2>
            @if (isset($taks))
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Kegiatan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kategori
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Level
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Kegiatan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Poin
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        File
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($taks as $tak)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $tak->activity_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $tak->category }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $tak->level }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $tak->activity_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $tak->point }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $tak->status->status }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if ($tak->file_path)
                                                <a href="{{ asset('storage/'.$tak->file_path) }}" target="_blank"
                                                    class="text-blue-600 hover:underline">
                                                    Lihat File
                                                </a>
                                            @else
                                                <span class="text-gray-500">Tidak ada file</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end mt-4">
                        {{ $taks->links() }}
                    </div>
                </div>
            @else
                <div class="bg-white shadow-md rounded-lg p-4">
                    <p class="text-gray-500">Tidak ada data TAK yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>
@endsection