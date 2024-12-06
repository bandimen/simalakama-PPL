<x-layout>
    <x-slot:title>Verifikasi Ruangan</x-slot:title>

    <div class="min-h-full">
        <x-navbar-dekan></x-navbar-dekan>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold mb-4">Verifikasi Ruangan</h1>

                {{-- Alert sukses atau error --}}
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="bg-red-500 text-white p-4 mb-4 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Iterasi untuk setiap prodi --}}
                @foreach ($prodis as $prodi)
                    @if ($prodi->ruang->isNotEmpty())
                        <h2 class="text-xl font-bold mt-8">Prodi: {{ $prodi->nama }}</h2>

                        <table class="min-w-full bg-white border border-gray-200 mt-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border">Nama</th>
                                    <th class="px-4 py-2 border">Gedung</th>
                                    <th class="px-4 py-2 border">Kapasitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prodi->ruang as $ruang)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $ruang->nama }}</td>
                                        <td class="px-4 py-2 border">{{ $ruang->gedung }}</td>
                                        <td class="px-4 py-2 border">{{ $ruang->kapasitas }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Tombol Setujui Semua --}}
                        <form action="{{ route('ruangs.approveAll', $prodi->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                Setujui Semua
                            </button>
                        </form>
                    @else
                        <p class="text-center p-4">Prodi {{ $prodi->nama }} tidak memiliki ruangan untuk disetujui.</p>
                    @endif
                @endforeach
            </div>
        </main>
    </div>
</x-layout>
