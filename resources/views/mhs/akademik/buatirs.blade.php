
<x-layout>

  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  <!-- Your content -->
  
  <div class="min-h-full">
    <x-navbar-mhs></x-navbar-mhs>

   <x-header-irs-mhs></x-header-irs-mhs> 
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-2xl font-bold tracking-tight text-gray-900">Buat IRS</h1>
      <br>
      @if ($currentPeriod)

        @if ($activePeriodType == 'pengisian')
        <div id="alert-additional-content-1" class="p-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
          <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Anda dalam Masa Pengisian IRS</h3>
          </div>
          <div class="mt-2 mb-4 text-sm">
            Masa pengisian IRS dimulai pada tanggal {{ $currentPeriod->periode_pengisian_start }} hingga {{ $currentPeriod->periode_pengisian_end }}.
          </div>
        </div>

        <br>

        {{-- kotak informasi mahasiswa --}}
        <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Nama: {{ $mahasiswa->nama }}</p>
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">NIM: {{ $mahasiswa->nim }}</p>
            <!-- Garis Horizontal -->
            <hr class="border-gray-300 w-full mb-4 dark:border-gray-600">
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Tahun Ajaran: {{ $currentPeriod->tahun_ajaran }}</p>
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Indeks Prestasi Kumulatif: {{ $mahasiswa->ipk }}</p>
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Indeks Prestasi Semester (lalu): {{ $mahasiswa->ips_lalu }}</p>
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Maksimal Beban SKS: {{ $mahasiswa->max_sks }}</p>
        </section>

        <br>

        {{-- kotak untuk milih mata kuliah --}}
        <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700">
          <label for="courses">
            <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Pilih Mata Kuliah</p>
          </label>
          <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Mata kuliah yang tersedia adalah mata kuliah yang bisa diambil pada periode semester ini. Mahasiswa disarankan untuk mengambil semua mata kuliah wajib terlebih dahulu baru mengambil mata kuliah pilihan/mengulang jika SKS masih tersedia.</p>
          <br>
          <select name="courses" id="courses" onchange="addCourse()">
            <option value="" hidden>-- Pilih Mata Kuliah --</option>
            @foreach ($matkuls as $matkul)
              <option value="{{ $matkul }}">[{{ $matkul->kodemk }}] {{ $matkul->nama }} | {{ $matkul->sks }} SKS | Semester {{$matkul->semester}} | {{ $matkul->sifat }}</option>
            @endforeach
          </select>
          <br><br>
          <div class="selected-courses" id="selectedCourses">
            <h3>Mata Kuliah yang Dipilih:</h3>
            <ul id="courseList"></ul>
          </div>
        </section>
          
        <br>

        <section class="block w-full p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 mt-1">
          <label for="schedule">
            <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Pilih Jadwal</p>
          </label>
          <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Silakan pilih waktu untuk setiap mata kuliah yang diambil.</p>

          {{-- Tabel Jadwal --}}
          <div id="scheduleDisplay" class="mt-4 overflow-x-auto flex justify-center">
            <div class="w-full">
              <table class="min-w-full w-full border-collapse border border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-white">
                <thead>
                  <tr>
                    <th class="border p-2 bg-gray-100 text-center" style="width: 80px;">Waktu</th>
                    <th class="border p-2 bg-gray-100 text-center" data-day="Senin">Senin</th>
                    <th class="border p-2 bg-gray-100 text-center" data-day="Selasa">Selasa</th>
                    <th class="border p-2 bg-gray-100 text-center" data-day="Rabu">Rabu</th>
                    <th class="border p-2 bg-gray-100 text-center" data-day="Kamis">Kamis</th>
                    <th class="border p-2 bg-gray-100 text-center" data-day="Jumat">Jumat</th>
                  </tr>
                </thead>
                <tbody>
                  @for ($hour = 7; $hour <= 19; $hour++)
                    <tr data-time="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                      <td class="border p-2 text-center">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00</td>
                      <td class="border p-2 text-center"></td>
                      <td class="border p-2 text-center"></td>
                      <td class="border p-2 text-center"></td>
                      <td class="border p-2 text-center"></td>
                      <td class="border p-2 text-center"></td>
                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <div x-data="{ open: false }" class="relative min-h-screen">
          <!-- Overlay Background -->
          <div x-show="open" class="fixed inset-0 z-50">
            <div 
              x-show="open" 
              x-transition:enter="transition-opacity ease-out duration-300" 
              x-transition:enter-start="opacity-0" 
              x-transition:enter-end="opacity-100" 
              x-transition:leave="transition-opacity ease-in duration-300" 
              x-transition:leave-start="opacity-100" 
              x-transition:leave-end="opacity-0" 
              class="absolute inset-0 bg-gray-500 bg-opacity-75">
            </div>

            <!-- Konten Modal (Sidebar yang menjadi kotak di tengah) -->
            <section 
              x-show="open" 
              x-transition:enter="transition-transform ease-out duration-300" 
              x-transition:enter-start="scale-75 opacity-0" 
              x-transition:enter-end="scale-100 opacity-100" 
              x-transition:leave="transition-transform ease-in duration-300" 
              x-transition:leave-start="scale-100 opacity-100" 
              x-transition:leave-end="scale-75 opacity-0" 
              class="fixed inset-0 flex items-center justify-center z-50">
              
              <!-- Kotak Konten -->
              <div class="bg-white w-[80%] max-w-4xl h-[70%] rounded-lg shadow-lg p-6 overflow-auto">
                <!-- Header -->
                <div class="flex justify-between items-center border-b pb-4 mb-4">
                  <h3 class="text-lg font-bold">Mata Kuliah yang Diambil</h3>
                  <button x-on:click="open = false" class="text-gray-500 hover:text-gray-700">
                    <span class="sr-only">Close</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>

                <div id="sidebar">
                  <table id="sidebarTable" class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                      <tr>
                        <th class="border px-4 py-2 text-center">No</th>
                        <th class="border px-4 py-2 text-center">Kode MK</th>
                        <th class="border px-4 py-2 text-center">Matakuliah</th>
                        <th class="border px-4 py-2 text-center">Kelas</th>
                        <th class="border px-4 py-2 text-center">Ruang</th>
                        <th class="border px-4 py-2 text-center">Jam</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Pesan default ketika tabel kosong -->
                      <tr id="emptyMessage">
                        <td colspan="6" class="text-center text-gray-500">Tidak ada jadwal yang dipilih</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </section>
          </div>

          <!-- Button .. SKS -->
          <div 
            class="fixed right-0 top-1/2 transform -translate-y-1/2 z-50" 
            x-show="!open" 
            x-transition>
            <button 
              x-on:click="open = true" 
              class="px-4 py-2 bg-black text-white rounded-md">
              .. SKS
            </button>
          </div>
        </div>

        <!-- Overlay dan Modal Alert IRS -->
        <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
          <div class="bg-white rounded-lg p-6 w-80 text-center z-50">
            <h2 class="text-xl font-semibold mb-4">Konfirmasi IRS</h2>
            <p class="text-gray-700 mb-6">Apakah anda yakin ingin memilih mata kuliah ini?</p>
            <div class="flex justify-center gap-4">
              <button id="confirmButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ya</button>
              <button id="cancelButton" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Tidak</button>
            </div>
          </div>
        </div>

        <!-- Overlay dan Modal Alert Pembatalan IRS -->
        <div id="cancelConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
          <div class="bg-white rounded-lg p-6 w-80 text-center z-50">
            <h2 class="text-xl font-semibold mb-4">Pembatalan IRS</h2>
            <p class="text-gray-700 mb-6">Apakah anda yakin ingin membatalkan pengambilan mata kuliah ini?</p>
            <div class="flex justify-center gap-4">
              <button id="confirmCancelButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ya</button>
              <button id="cancelCancelButton" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Tidak</button>
            </div>
          </div>
        </div>

        @elseif ($activePeriodType == 'perubahan')
        <div id="alert-additional-content-1" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
          <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Anda dalam Masa Perubahan IRS</h3>
          </div>
          <div class="mt-2 mb-4 text-sm">
            Masa perubahan IRS dimulai pada tanggal {{ $currentPeriod->periode_perubahan_start }} hingga {{ $currentPeriod->periode_perubahan_end }}.
          </div>
        </div>

        @elseif ($activePeriodType == 'pembatalan')
        <div id="alert-additional-content-1" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
          <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Anda dalam Masa Pembatalan IRS</h3>
          </div>
          <div class="mt-2 mb-4 text-sm">
            Masa pembatalan IRS dimulai pada tanggal {{ $currentPeriod->periode_pembatalan_start }} hingga {{ $currentPeriod->periode_pembatalan_end }}.
          </div>
        </div>


        @else
        <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
          <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Tidak dalam masa IRS-an</h3>
          </div>
          <div class="mt-2 mb-4 text-sm">
            Masa IRS sudah selesai. Tidak ada lagi pengisian, perubahan, dan pembatalan IRS untuk semester ini, silakan nikmati perkuliahan dengan baik. Miaw.
          </div>
          <div class="flex">
            <a href="/mhs">
              <button type="button" class="text-red-800 bg-transparent border border-red-800 hover:bg-red-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-red-600 dark:border-red-600 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800" data-dismiss-target="#alert-additional-content-2" aria-label="Close">
                Kembali
              </button>
            </a>
          </div>
        </div>
        @endif

      @endif

    </div>

  </main>
</div>

</x-layout>