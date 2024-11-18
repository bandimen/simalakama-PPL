<x-layout>
    <x-slot:title>Jadwal Kuliah</x-slot:title>
    <div class="min-h-full">
        <x-sidebar-kaprodi></x-sidebar-kaprodi>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-6">Daftar Jadwal Kuliah</h1>

                <!-- Tombol Tambah Jadwal -->
                <a href="{{ route('tambahJadwal') }}"
                   class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                   Tambah Jadwal Kuliah
                </a>

                <!-- Tabel Jadwal Kuliah -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Kode MK</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Mata Kuliah</th>
                                <th class="border border-gray-300 px-4 py-2">Kelas</th>
                                <th class="border border-gray-300 px-4 py-2">Hari</th>
                                <th class="border border-gray-300 px-4 py-2">Waktu</th>
                                <th class="border border-gray-300 px-4 py-2">Ruang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwalKuliah as $jadwal)
                                <tr class="bg-white hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $jadwal->kodemk }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $jadwal->mataKuliah->nama }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $jadwal->kelas }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $jadwal->hari }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $jadwal->ruang->nama }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center border border-gray-300 px-4 py-2">Tidak ada jadwal kuliah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-layout>
