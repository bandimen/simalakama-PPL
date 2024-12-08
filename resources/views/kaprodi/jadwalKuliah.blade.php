<x-layout>
    <x-slot:title>Jadwal Kuliah</x-slot:title>
    <div class="min-h-full">
        <x-navbar-kaprodi></x-navbar-kaprodi>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h4 class="text-4xl font-bold text-gray-900 mb-6">Daftar Jadwal Kuliah</h4>

                <!-- Tombol Tambah dan Search -->
                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('kaprodi.tambahJadwal') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Tambah Jadwal</a>
                    <form action="{{ route('kaprodi.jadwalKuliah') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" placeholder="Cari mata kuliah..." class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-300" value="{{ request('search') }}">
                        <button type="submit" class="ml-2 bg-gray-700 text-white py-2 px-4 rounded-lg hover:bg-gray-800">Cari</button>
                    </form>
                </div>

                <!-- Tabel Jadwal Kuliah -->
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
                                        <a href="{{ route('kaprodi.editJadwal', $jadwal->id) }}"
                                            class="bg-yellow-500 text-white py-1 px-3 rounded-lg hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('kaprodi.deleteJadwal', $jadwal->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600">
                                                Hapus
                                            </button>
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

    <!-- Alert Pop-up -->
    @if(session('success'))
    <div id="popup-alert" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3 text-center">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Berhasil!</h2>
            <p class="text-gray-700">{{ session('success') }}</p>
            <button id="close-popup"
                class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                OK
            </button>
        </div>
    </div>

    <script>
        // Tutup pop-up secara manual
        document.getElementById('close-popup').addEventListener('click', function() {
            document.getElementById('popup-alert').style.display = 'none';
        });

        // Auto-dismiss pop-up setelah 5 detik
        setTimeout(function() {
            document.getElementById('popup-alert').style.display = 'none';
        }, 5000);

        document.getElementById('search-input').addEventListener('input', function () {
            const search = this.value;

            fetch(`/jadwal-kuliah/search?search=${encodeURIComponent(search)}`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('table-body');
                    tableBody.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            tableBody.innerHTML += `
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 text-sm">${index + 1}</td>
                                    <td class="px-6 py-4 text-sm">${item.matakuliah.nama}</td>
                                    <td class="px-6 py-4 text-sm">${item.kelas}</td>
                                    <td class="px-6 py-4 text-sm">${item.ruang.nama}</td>
                                    <td class="px-6 py-4 text-sm">${item.kuota_kelas}</td>
                                    <td class="px-6 py-4 text-sm">${item.hari}</td>
                                    <td class="px-6 py-4 text-sm">${item.waktu_mulai} - ${item.waktu_selesai}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="/jadwal-kuliah/${item.id}/edit" class="text-yellow-500 hover:text-yellow-600">Edit</a>
                                        <form action="/jadwal-kuliah/${item.id}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="8" class="text-center py-4">Data tidak ditemukan</td></tr>`;
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    @endif
</x-layout>
