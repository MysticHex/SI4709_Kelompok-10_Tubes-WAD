@extends('Layouts.AdminLayouts')
@section('title', 'Dashboard Admin')

@section('main')
    <div class="flex-1 p-6 bg-gray-100">
        <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="card bg-white shadow-md p-4">
                <h2 class="text-lg font-semibold mb-2">Selamat Datang, {{ auth()->user()->nama }}</h2>
                <p class="text-gray-600">Ini adalah dashboard admin Anda. Gunakan menu di sebelah kiri untuk mengelola
                    aplikasi.</p>
            </div>
        </div>
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-3">Data Tabel TAK</h2>

            @if (isset($tak) && count($tak) > 0)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Mahasiswa
                                    </th>
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
                                        Tanggal Pengajuan
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
                                @foreach ($tak as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->user->nama }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->activity_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->category }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->level }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->activity_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <input type="number" min="0" id="point-{{ $item->id }}" value="{{ $item->point }}"
                                                class="border rounded px-2 py-1 text-sm w-16"
                                                onchange="updatePoint({{ $item->id }}, this.value)">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div>
                                                <select id="status-{{ $item->id }}"
                                                    onchange="updateStatus({{ $item->id }}, this.value)"
                                                    class="border rounded px-2 py-1 text-sm
                                                    {{ $item->approval_status_id == 1 ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $item->approval_status_id == 2 ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $item->approval_status_id == 3 ? 'bg-red-100 text-red-800' : '' }}">
                                                    <option value="1"
                                                        {{ $item->approval_status_id == 1 ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="2"
                                                        {{ $item->approval_status_id == 2 ? 'selected' : '' }}>Approve
                                                    </option>
                                                    <option value="3"
                                                        {{ $item->approval_status_id == 3 ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if ($item->file_path)
                                                <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank"
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
                        {{ $tak->links('vendor.pagination.daisyui') }}
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

@section('scripts')
    <script>
        function updateStatus(id, statusId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const select = document.getElementById(`status-${id}`);
            select.disabled = true;

            fetch(`/api/admin/update-status/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        approval_status_id: statusId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    select.className = 'border rounded px-2 py-1 text-sm';
                    if (statusId == 1) select.classList.add('bg-yellow-100', 'text-yellow-800');
                    if (statusId == 2) select.classList.add('bg-green-100', 'text-green-800');
                    if (statusId == 3) select.classList.add('bg-red-100', 'text-red-800');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update status');
                })
                .finally(() => {
                    select.disabled = false;
                });
        }

        function updatePoint(id, point) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const input = document.getElementById(`point-${id}`);
            input.disabled = true;
            

            fetch(`/api/admin/update-point/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        point: point
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    input.className = 'border rounded px-2 py-1 text-sm w-16';
                    if (data.success) {
                        input.value = data.point; // Update the input value with the new point
                    } else {
                        alert('Failed to update point');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update point');
                })
                .finally(() => {
                    input.disabled = false;
                });
        }
    </script>
@endsection
