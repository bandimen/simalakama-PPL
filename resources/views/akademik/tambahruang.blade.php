{{-- resources/views/dekan/tambah-mata-kuliah.blade.php --}}
<x-layout>
    <x-slot:title>Tambah Ruangan</x-slot:title>
    
    <div class="min-h-full">
        <x-navbar-akademik></x-navbar-akademik>
        
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-xl font-semibold mb-4">Tambah Ruangan Baru</h1>
                @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/>
            </svg>
        </span>
    </div>
@endif

                <form action="{{ route('ruang.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    {{-- Nama Ruangan --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                        <input type="text" name="nama" id="nama" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Nama Ruangan" required>
                    </div>

                    {{-- Gedung --}}
                    <div>
                        <label for="gedung" class="block text-sm font-medium text-gray-700">Gedung</label>
                        <input type="text" name="gedung" id="gedung" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Nama Gedung" required>
                    </div>

                    {{-- Kapasitas --}}
                    <div>
                        <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                        <input type="number" name="kapasitas" id="kapasitas" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                               placeholder="Kapasitas Ruangan" required min="1">
                    </div>

                    {{-- Prodi --}}
                    <div>
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="prodi_id" id="prodi_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="" disabled selected>Pilih Program Studi</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
            </div>
        </main>
    </div>
</x-layout>
