<x-layout>
    <x-slot:title>Edit Mata Kuliah</x-slot:title>

    <div class="min-h-full">
        <x-sidebar-kaprodi></x-sidebar-kaprodi>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h4 class="text-4xl font-bold text-gray-900 mb-6">Edit Mata Kuliah</h4>

                <form action="{{ route('kaprodi.updateMataKuliah', $mataKuliah->kodemk) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
                    @csrf
                    @method('PUT')

                    <!-- Kode Mata Kuliah -->
                    <div class="mb-4">
                        <label for="kodemk" class="block text-sm font-medium text-gray-700">Kode Mata Kuliah</label>
                        <input type="text" id="kodemk" name="kodemk"
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300"
                               value="{{ $mataKuliah->kodemk }}" readonly>
                        <p class="text-gray-500 text-sm">Kode mata kuliah tidak dapat diubah.</p>
                    </div>

                    <!-- Nama Mata Kuliah -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                        <input type="text" id="nama" name="nama"
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300"
                               value="{{ old('nama', $mataKuliah->nama) }}" required>
                        @error('nama')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SKS -->
                    <div class="mb-4">
                        <label for="sks" class="block text-sm font-medium text-gray-700">SKS</label>
                        <input type="number" id="sks" name="sks"
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300"
                               value="{{ old('sks', $mataKuliah->sks) }}" required>
                        @error('sks')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Semester -->
                    <div class="mb-4">
                        <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                        <input type="number" id="semester" name="semester"
                               class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300"
                               value="{{ old('semester', $mataKuliah->semester) }}" required>
                        @error('semester')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sifat -->
                    <div class="mb-4">
                        <label for="sifat" class="block text-sm font-medium text-gray-700">Sifat</label>
                        <select id="sifat" name="sifat"
                                class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300"
                                required>
                            <option value="Wajib" {{ old('sifat', $mataKuliah->sifat) == 'Wajib' ? 'selected' : '' }}>Wajib</option>
                            <option value="Pilihan" {{ old('sifat', $mataKuliah->sifat) == 'Pilihan' ? 'selected' : '' }}>Pilihan</option>
                        </select>
                        @error('sifat')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Program Studi -->
                    <div class="mb-4">
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select id="prodi_id" name="prodi_id"
                                class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-300"
                                required>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->id }}" {{ old('prodi_id', $mataKuliah->prodi_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end">
                        <a href="{{ route('kaprodi.mataKuliah') }}"
                           class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 mr-2">
                           Batal
                        </a>
                        <button type="submit"
                                class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-layout>
