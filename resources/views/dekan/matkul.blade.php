<x-layout>
    <x-slot:title>Verifikasi Jadwal Kuliah</x-slot:title>

    <div class="min-h-full">
        <x-navbar-dekan></x-navbar-dekan>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold mb-4">Daftar Jadwal Kuliah Belum Disetujui</h1>

                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @foreach($prodis as $prodi)
                    <div class="mb-6">
                        <h2 class="text-xl font-bold mb-4">Prodi: {{ $prodi->nama }}</h2>

                        @php
                            // Ambil hanya mata kuliah yang memiliki jadwal belum disetujui
                            $mataKuliahBelumDisetujui = $prodi->mataKuliah->filter(function ($mataKuliah) {
                                return $mataKuliah->jadwalKuliah->isNotEmpty();
                            });
                        @endphp

                        @if($mataKuliahBelumDisetujui->isEmpty())
                            <div class="bg-gray-300 text-center p-4 mb-4 rounded">
                                <strong>Tidak ada jadwal kuliah yang perlu disetujui.</strong>
                            </div>
                        @else
                            <form action="{{ route('dekan.approveAll', $prodi->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 mb-4 rounded">
                                    Setujui Semua
                                </button>
                            </form>

                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 border">Kode MK</th>
                                        <th class="px-4 py-2 border">Nama Mata Kuliah</th>
                                        <th class="px-4 py-2 border">Kelas</th>
                                        <th class="px-4 py-2 border">Hari</th>
                                        <th class="px-4 py-2 border">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mataKuliahBelumDisetujui as $mataKuliah)
                                        @foreach($mataKuliah->jadwalKuliah as $jadwal)
                                            <tr>
                                                <td class="px-4 py-2 border">{{ $mataKuliah->kodemk }}</td>
                                                <td class="px-4 py-2 border">{{ $mataKuliah->nama }}</td>
                                                <td class="px-4 py-2 border">{{ $jadwal->kelas }}</td>
                                                <td class="px-4 py-2 border">{{ $jadwal->hari }}</td>
                                                <td class="px-4 py-2 border">
                                                    {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</x-layout>
