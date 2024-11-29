<x-layout>
    <x-slot:title>Tambah Ruangan</x-slot:title>
    
    <div class="min-h-full">
        <x-navbar-akademik></x-navbar-akademik>
        
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-xl font-semibold mb-4">Tambah Ruangan Baru</h1>

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Alert Error --}}
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Alert Error untuk Validasi --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Tambah Ruangan --}}
                <form action="{{ route('ruang.store') }}" method="POST" class="space-y-4 mb-6">
                    @csrf
                    
                    {{-- Nama Ruangan --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                        <input type="text" name="nama" id="nama" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Nama Ruangan" value="{{ old('nama') }}" required>
                    </div>

                    {{-- Gedung --}}
                    <div>
                        <label for="gedung" class="block text-sm font-medium text-gray-700">Gedung</label>
                        <input type="text" name="gedung" id="gedung" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Nama Gedung" value="{{ old('gedung') }}" required>
                    </div>

                    {{-- Kapasitas --}}
                    <div>
                        <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                        <input type="number" name="kapasitas" id="kapasitas" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Kapasitas Ruangan" value="{{ old('kapasitas') }}" required min="1">
                    </div>

                    {{-- Prodi --}}
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
                    </div>

                    {{-- Tombol Submit --}}
                    <div>
                        <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Tambah Ruangan
                        </button>
                    </div>
                </form>

                {{-- List Ruangan --}}
                <h2 class="text-xl font-semibold mt-8 mb-4">Daftar Ruangan</h2>
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2">Nama Ruangan</th>
                            <th class="border p-2">Gedung</th>
                            <th class="border p-2">Kapasitas</th>
                            <th class="border p-2">Prodi</th>
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
                                <td class="border p-2">
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
            </div>
        </main>
    </div>
</x-layout>
