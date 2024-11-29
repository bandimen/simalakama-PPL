<x-layout>
  <x-slot:title>Verifikasi Ruangan</x-slot:title>

  <div class="min-h-full">
      <x-navbar-dekan></x-navbar-dekan>
      <main>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
              <h1 class="text-2xl font-bold mb-4">Verifikasi Ruangan</h1>

              {{-- Tampilkan alert sukses atau error --}}
              @if (session('success'))
                  <div class="bg-green-500 text-white p-4 mb-4 rounded">
                      {{ session('success') }}
                  </div>
              @elseif (session('error'))
                  <div class="bg-red-500 text-white p-4 mb-4 rounded">
                      {{ session('error') }}
                  </div>
              @endif

              <table class="min-w-full bg-white border border-gray-200">
                  <thead>
                      <tr>
                          <th class="px-4 py-2 border">Nama</th>
                          <th class="px-4 py-2 border">Gedung</th>
                          <th class="px-4 py-2 border">Kapasitas</th>
                          <th class="px-4 py-2 border">Prodi</th>
                          <th class="px-4 py-2 border">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($ruangs as $ruang)
                          <tr>
                              <td class="px-4 py-2 border">{{ $ruang->nama }}</td>
                              <td class="px-4 py-2 border">{{ $ruang->gedung }}</td>
                              <td class="px-4 py-2 border">{{ $ruang->kapasitas }}</td>
                              <td class="px-4 py-2 border">{{ $ruang->prodi->nama }}</td>
                              <td class="px-4 py-2 border">
                                  <form action="{{ route('ruangs.approve', $ruang->id) }}" method="POST">
                                      @csrf
                                      @method('PATCH')
                                      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                          Setujui
                                      </button>
                                  </form>
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="5" class="text-center p-4">Tidak ada ruangan yang membutuhkan persetujuan.</td>
                          </tr>
                      @endforelse
                  </tbody>
              </table>
          </div>
      </main>
  </div>
</x-layout>
