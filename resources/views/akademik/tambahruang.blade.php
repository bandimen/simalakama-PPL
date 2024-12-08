<x-layout>
    <x-slot:title>Tambah Ruangan</x-slot:title>

    <div class="min-h-full">
        <x-navbar-akademik></x-navbar-akademik>
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-xl font-semibold mb-4">Tambah atau Edit Ruangan</h1>
                
                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @elseif (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Tombol Toggle Form Tambah --}}
                <button onclick="document.getElementById('tambahRuanganForm').classList.toggle('hidden')" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mb-4">
                    Tambah Ruangan Baru
                </button>

                {{-- Form Tambah Ruangan --}}
                <form action="{{ route('ruang.store') }}" method="POST" id="tambahRuanganForm" class="space-y-4 mb-6 hidden">
                    @csrf
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                        <input type="text" name="nama" id="nama" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Nama Ruangan" value="{{ old('nama') }}" required>
                        @error('nama')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="gedung" class="block text-sm font-medium text-gray-700">Gedung</label>
                        <input type="text" name="gedung" id="gedung" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Nama Gedung" value="{{ old('gedung') }}" required>
                        @error('gedung')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                        <input type="number" name="kapasitas" id="kapasitas" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Kapasitas Ruangan" value="{{ old('kapasitas') }}" required min="1">
                        @error('kapasitas')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="prodi_id" id="prodi_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="" disabled {{ old('prodi_id') ? '' : 'selected' }}>Pilih Program Studi</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id }}" {{ old('prodi_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Tambah Ruangan
                        </button>
                    </div>
                </form>

                {{-- Tabel Daftar Ruangan --}}
                <h2 class="text-xl font-semibold mt-8 mb-4">Daftar Ruangan</h2>
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border p-2">Nama Ruangan</th>
                            <th class="border p-2">Gedung</th>
                            <th class="border p-2">Kapasitas</th>
                            <th class="border p-2">Prodi</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruangs as $ruang)
                            <tr>
                                <td class="border p-2">{{ $ruang->nama }}</td>
                                <td class="border p-2">{{ $ruang->gedung }}</td>
                                <td class="border p-2">{{ $ruang->kapasitas }}</td>
                                <td class="border p-2">{{ $ruang->prodi->nama }}</td>
                                <td class="border p-2">{{ ucfirst($ruang->status) }}</td>
                                <td class="border p-2 flex gap-2">
                                    {{-- Tombol Edit --}}
                                    <button onclick="editRuang({{ $ruang }})"
                                            class="text-blue-500 hover:text-blue-700">Edit</button>
                                    <form action="{{ route('ruang.destroy', $ruang->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?');">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                {{ $ruangs->links() }}

                {{-- Modal Edit --}}
                <div id="modalEdit" class="hidden fixed z-50 inset-0 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
                            <h2 class="text-xl font-semibold mb-4">Edit Ruangan</h2>
                            <form action="" method="POST" id="formEdit">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="edit_nama" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                                    <input type="text" name="nama" id="edit_nama" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="edit_gedung" class="block text-sm font-medium text-gray-700">Gedung</label>
                                    <input type="text" name="gedung" id="edit_gedung" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="edit_kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                    <input type="number" name="kapasitas" id="edit_kapasitas" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required min="1">
                                </div>
                                <div>
                                    <label for="edit_prodi_id" class="block text-sm font-medium text-gray-700">Prodi</label>
                                    <select name="prodi_id" id="edit_prodi_id" class="mt-1 block w-full">
                                        @foreach ($prodi as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-4 flex justify-end gap-2">
                                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function editRuang(ruang) {
            document.getElementById('formEdit').action = `/ruang/${ruang.id}`;
            document.getElementById('edit_nama').value = ruang.nama;
            document.getElementById('edit_gedung').value = ruang.gedung;
            document.getElementById('edit_kapasitas').value = ruang.kapasitas;
            document.getElementById('edit_prodi_id').value = ruang.prodi_id;
            document.getElementById('modalEdit').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modalEdit').classList.add('hidden');
        }
    </script>
</x-layout>
