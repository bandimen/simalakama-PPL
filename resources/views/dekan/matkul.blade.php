{{-- resources/views/dekan/tambah-mata-kuliah.blade.php --}}
<x-layout>
    <x-slot:title>Tambah Mata Kuliah</x-slot:title>
    
    <div class="min-h-full">
        <x-navbar-dekan></x-navbar-dekan>
        
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="max-w-2xl mx-auto py-8">
                    <h2 class="text-xl font-semibold mb-4">Tambah Mata Kuliah Baru</h2>
                    <form method="POST" action="{{ route('mataKuliah.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="kodemk" class="block text-sm font-medium text-gray-700">Kode Mata Kuliah</label>
                            <input type="text" name="kodemk" id="kodemk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="sks" class="block text-sm font-medium text-gray-700">SKS</label>
                            <input type="number" name="sks" id="sks" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                            <input type="number" name="semester" id="semester" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="sifat" class="block text-sm font-medium text-gray-700">Sifat Mata Kuliah</label>
                            <select name="sifat" id="sifat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="Wajib">Wajib</option>
                                <option value="Pilihan">Pilihan</option>
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Mata Kuliah</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-layout>
