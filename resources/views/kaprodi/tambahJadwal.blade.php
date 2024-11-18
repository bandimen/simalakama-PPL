<x-layout>
    <x-slot:title>Tambah Jadwal Kuliah</x-slot:title>
    <div class="min-h-full">
        <x-sidebar-kaprodi></x-sidebar-kaprodi>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-6">Tambah Jadwal Kuliah</h1>

                <form action="{{ route('simpanJadwal') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Mata Kuliah -->
                    <div>
                        <label for="kodemk" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                        <select id="kodemk" name="kodemk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach ($mataKuliah as $mk)
                                <option value="{{ $mk->kodemk }}">{{ $mk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ruang -->
                    <div>
                        <label for="ruang_id" class="block text-sm font-medium text-gray-700">Ruang</label>
                        <select id="ruang_id" name="ruang_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach ($ruang as $r)
                                <option value="{{ $r->id }}">{{ $r->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <input type="text" id="kelas" name="kelas"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Hari -->
                    <div>
                        <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                        <input type="text" id="hari" name="hari"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Waktu Mulai -->
                    <div>
                        <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                        <input type="time" id="waktu_mulai" name="waktu_mulai"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Waktu Selesai -->
                    <div>
                        <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                        <input type="time" id="waktu_selesai" name="waktu_selesai"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Tombol Simpan -->
                    <div>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-layout>
