<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  
  <div class="min-h-full">
      <x-navbar-dekan></x-navbar-dekan>
      
      <main>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
              <div class="max-w-2xl mx-auto py-8">
                  <h2 class="text-xl font-semibold mb-4">Tambah Mata Kuliah ke Jadwal</h2>
                  <form method="POST" action="{{ route('JadwalKuliahController') }}">
                      @csrf
                      <div class="mb-4">
                          <label for="kodemk" class="block text-sm font-medium text-gray-700">Kode Mata Kuliah</label>
                          <select name="kodemk" id="kodemk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                              @foreach($mataKuliahs as $mataKuliah)
                                  <option value="{{ $mataKuliah->kodemk }}">{{ $mataKuliah->nama }} ({{ $mataKuliah->kodemk }})</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="mb-4">
                          <label for="prodi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                          <input type="text" name="prodi" id="prodi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                      </div>
                      <div class="mb-4">
                          <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                          <input type="number" name="semester" id="semester" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                      </div>
                      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Jadwal</button>
                  </form>
              </div>
          </div>
      </main>
  </div>
</x-layout>
