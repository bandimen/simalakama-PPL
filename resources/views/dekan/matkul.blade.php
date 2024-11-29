<x-layout>
    <x-slot:title>Jadwal Kuliah</x-slot:title>

    <div class="min-h-full">
        <!-- Navbar Dekan -->
        <x-navbar-dekan></x-navbar-dekan>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold mb-4">Daftar Jadwal Kuliah Belum Disetujui</h1>

                {{-- Tampilkan alert sukses --}}
                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tampilkan alert jika tidak ada jadwal --}}
                @if($jadwalKuliah->isEmpty())
                    <div class="bg-gray-300 text-center p-4 mb-4 rounded">
                        <strong>Tidak ada jadwal kuliah yang perlu disetujui.</strong>
                    </div>
                @else
                    {{-- Tabel Jadwal Kuliah --}}
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Kode MK</th>
                                <th class="px-4 py-2 border">Nama Mata Kuliah</th>
                                <th class="px-4 py-2 border">Kelas</th>
                                <th class="px-4 py-2 border">Hari</th>
                                <th class="px-4 py-2 border">Waktu</th>
                                <th class="px-4 py-2 border">Ruang</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwalKuliah as $jadwal)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $jadwal->mataKuliah->kodemk }}</td>
                                    <td class="px-4 py-2 border">{{ $jadwal->mataKuliah->nama }}</td>
                                    <td class="px-4 py-2 border">{{ $jadwal->kelas }}</td>
                                    <td class="px-4 py-2 border">{{ $jadwal->hari }}</td>
                                    <td class="px-4 py-2 border">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                                    <td class="px-4 py-2 border">{{ $jadwal->ruang->nama ?? 'Belum ditentukan' }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <form action="{{ route('dekan.matkul.approve', $jadwal->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                                <i class="bi bi-check-circle"></i> Setujui
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </main>
    </div>
</x-layout>
