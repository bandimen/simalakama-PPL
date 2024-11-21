
<x-layout>

  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  <!-- Your content -->
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

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

        <!-- Bottom Sheet -->
        <div id="bottomSheet" class="relative bg-white rounded-lg shadow-lg mt-6 transform translate-y-full transition-transform duration-300">
          <!-- Tombol Toggle -->
          <div 
            id="toggleButton" 
            class="flex justify-center items-center py-5 cursor-pointer bg-gray-200 rounded-t-lg relative"
          >
            <div id="toggleIcon" class="absolute top-2 text-lg font-bold text-gray-500">&#x25B2;</div> <!-- Panah -->
          </div>

          <!-- Konten Bottom Sheet -->
          <div class="p-4 hidden" id="content">
            <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">Jadwal Mata Kuliah</h2>

            <!-- Tabel Bottom Sheet -->
            <table id="bottomSheetTable" class="w-full border-collapse border border-gray-300">
              <thead class="bg-gray-100">
                <tr>
                  <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Kode MK</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Mata Kuliah</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Kelas</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Hari</th>
                  <th class="border border-gray-300 px-4 py-2 text-left">Jam</th>
                </tr>
              </thead>
              <tbody>
              <tbody>
                  <tr id="emptyMessage">
                  </tr>
              </tbody>
              </tbody>
            </table>
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
        @include('components.perubahan')
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
   
      <br>

  </main>
</div>

</x-layout>