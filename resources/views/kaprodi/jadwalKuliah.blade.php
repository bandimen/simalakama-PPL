<x-layout>
    <x-slot:title>Jadwal Kuliah</x-slot:title>
    <div class="min-h-full">
        <x-sidebar-kaprodi></x-sidebar-kaprodi>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h4 class="text-4xl font-bold text-gray-900 mb-6">Daftar Jadwal Kuliah</h4>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="w-full text-left text-gray-500">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-sm font-medium text-gray-900">No</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-900">Mata Kuliah</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-900">Kelas</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-900">Ruang</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-900">Kuota</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-900">Hari</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-900">Waktu</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalKuliah as $index => $jadwal)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 text-sm">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $jadwal->matakuliah->nama }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $jadwal->kelas }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $jadwal->ruang->nama }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $jadwal->kuota_kelas }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $jadwal->hari }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <button href="{{ route('kaprodi.editJadwal', $jadwal->id) }}" class="text-yellow-500 hover:text-yellow-600">Edit</button>
                                        <form action="{{ route('kaprodi.deleteJadwal', $jadwal->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-layout>

<!-- Alert pop-up untuk pesan sukses -->
@if(session('success'))
<div id="toast-success" class="toast toast-success absolute top-10 right-10 z-50 p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg shadow-lg dark:bg-green-200 dark:text-green-800" role="alert">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16Zm-1-7V9h2v2h-2Zm0 4V11h2v4h-2Z"/>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
        <button type="button" class="ml-auto text-green-500 bg-transparent border-0 p-1.5 inline-flex items-center rounded-lg hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-300 dark:hover:bg-green-400 dark:focus:ring-green-800" data-dismiss-target="#toast-success" aria-label="Close">
            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M14.828 5.172a4 4 0 1 0-5.656 5.656l4.243 4.243a4 4 0 0 0 5.656-5.656l-4.243-4.243Zm-4.242 4.243a2 2 0 1 1 2.828-2.828 2 2 0 0 1-2.828 2.828Z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
</div>

<script>
    // Auto-dismiss toast after a few seconds
    setTimeout(function() {
        document.getElementById('toast-success').style.display = 'none';
    }, 5000);
</script>
@endif
