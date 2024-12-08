<x-layout>
    <x-slot:title>Tambah Mata Kuliah</x-slot:title>

    <div class="min-h-full">
        <x-sidebar-kaprodi></x-sidebar-kaprodi>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Tambah Mata Kuliah untuk Program Studi {{ $prodi->nama }}</h1>

                <!-- Form Tambah Mata Kuliah -->
                <form action="{{ route('kaprodi.storeMataKuliah') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <!-- Kode Mata Kuliah -->
                        <div>
                            <label for="kodemk" class="block text-sm font-medium text-gray-700">Kode Mata Kuliah</label>
                            <input type="text" name="kodemk" id="kodemk" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="UUW00000" required>
                        </div>

                        <!-- Nama Mata Kuliah -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Mata Kuliah" required>
                        </div>

                        <!-- SKS -->
                        <div>
                            <label for="sks" class="block text-sm font-medium text-gray-700">SKS</label>
                            <select name="sks" id="sks" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                                <option value="" disabled selected>Pilih SKS</option>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Semester -->
                        <div>
                            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                            <select name="semester" id="semester" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                                <option value="" disabled selected>Pilih Semester</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Sifat -->
                        <div>
                            <label for="sifat" class="block text-sm font-medium text-gray-700">Sifat</label>
                            <select name="sifat" id="sifat" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                                <option value="" disabled selected>Pilih Sifat</option>
                                <option value="Wajib">Wajib</option>
                                <option value="Pilihan">Pilihan</option>
                            </select>
                        </div>

                        <!-- Hidden Prodi ID -->
                        <input type="hidden" name="prodi_id" value="{{ $prodi->id }}">

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600">Simpan Mata Kuliah</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-layout>
