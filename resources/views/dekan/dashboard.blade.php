<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <div class="min-h-full">
      <x-navbar-dekan></x-navbar-dekan>
      
      <main>
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

              {{-- Header --}}
              <div class="text-center mb-6">
                  <h1 class="text-2xl font-bold text-gray-900">Selamat Datang di Fakultas Sains dan Matematika</h1>
                  <p class="text-sm text-gray-600">Selamat datang, <strong>{{ $infoDekan->nama }}</strong></p>
              </div>

              {{-- Statistik Ringkasan --}}
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                  {{-- Card Total Mahasiswa --}}
                  <div class="flex items-center p-4 bg-blue-100 rounded-lg shadow-md">
                      <div class="p-3 bg-blue-500 text-white rounded-full">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a6 6 0 00-6-6h-4a6 6 0 00-6 6v2h5M12 12a5 5 0 100-10 5 5 0 000 10z" />
                          </svg>
                      </div>
                      <div class="ml-4">
                          <h2 class="text-lg font-bold text-gray-800">Total Mahasiswa</h2>
                          <p class="text-2xl font-bold text-gray-900">2,745</p>
                      </div>
                  </div>

                  {{-- Card Total Dosen --}}
                  <div class="flex items-center p-4 bg-green-100 rounded-lg shadow-md">
                      <div class="p-3 bg-green-500 text-white rounded-full">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-5-8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2m-6 6h10" />
                          </svg>
                      </div>
                      <div class="ml-4">
                          <h2 class="text-lg font-bold text-gray-800">Total Dosen</h2>
                          <p class="text-2xl font-bold text-gray-900">263</p>
                      </div>
                  </div>
              </div>

              {{-- Tabel Total Mahasiswa dan Grafik Pie --}}
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <!-- Tabel Total Mahasiswa -->
                  <div class="overflow-x-auto bg-white rounded-lg shadow-md p-4">
                      <h2 class="text-lg font-bold text-gray-900 mb-4">Total Mahasiswa</h2>
                      <table class="min-w-full table-auto">
                          <thead>
                              <tr class="bg-gray-100">
                                  <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Program Studi</th>
                                  <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Jumlah Mahasiswa</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr><td class="px-4 py-2">Informatika</td><td class="px-4 py-2">564</td></tr>
                              <tr><td class="px-4 py-2">Biologi</td><td class="px-4 py-2">467</td></tr>
                              <tr><td class="px-4 py-2">Kimia</td><td class="px-4 py-2">278</td></tr>
                              <tr><td class="px-4 py-2">Bioteknologi</td><td class="px-4 py-2">260</td></tr>
                              <tr><td class="px-4 py-2">Fisika</td><td class="px-4 py-2">430</td></tr>
                              <tr><td class="px-4 py-2">Matematika</td><td class="px-4 py-2">359</td></tr>
                              <tr><td class="px-4 py-2">Statistika</td><td class="px-4 py-2">387</td></tr>
                          </tbody>
                      </table>
                  </div>

                  <!-- Grafik Pie Mahasiswa -->
                  <div class="overflow-x-auto bg-white rounded-lg shadow-md p-4">
                      <h2 class="text-lg font-bold text-gray-900 mb-4">Proporsi Mahasiswa per Program Studi</h2>
                      <canvas id="pieChart"></canvas>
                  </div>
              </div>

          </div>
      </main>
  </div>

  {{-- Script Chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      const ctx = document.getElementById('pieChart').getContext('2d');
      const pieChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ['Informatika', 'Biologi', 'Kimia', 'Bioteknologi', 'Fisika', 'Matematika', 'Statistika'],
              datasets: [{
                  data: [564, 467, 278, 260, 430, 359, 387],
                  backgroundColor: [
                      '#4CAF50', '#FF9800', '#03A9F4', '#E91E63', '#9C27B0', '#FFC107', '#8BC34A'
                  ],
                  hoverOffset: 4
              }]
          },
          options: {
              responsive: true,
          }
      });
  </script>
</x-layout>
