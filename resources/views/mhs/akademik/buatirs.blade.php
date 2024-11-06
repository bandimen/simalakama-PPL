
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
        <div id="alert-additional-content-1" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
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

        {{-- kotak informasi mahasiswa --}}
        <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Nama: {{ $mahasiswa->nama }}</p>
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">NIM: {{ $mahasiswa->nim }}</p>
            <!-- Garis Horizontal -->
            <hr class="border-gray-300 w-full mb-4 dark:border-gray-600">
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Tahun Ajaran: {{ $mahasiswa->tahun_ajaran }}</p>
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Indeks Prestasi Kumulatif: {{ $mahasiswa->ipk }}</p>
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Indeks Prestasi Semester (lalu): {{ $mahasiswa->ips_lalu }}</p>
            <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Maksimal Beban SKS: {{ $mahasiswa->max_sks }}</p>
        </section>

        {{-- kotak untuk milih mata kuliah --}}
        <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700 mt-6">
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
        {{-- ini buat milih jadwal --}}

        <br>
        {{-- Section untuk memilih jadwal --}}
        <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 mt-1">
          <label for="schedule">
            <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Pilih Jadwal</p>
          </label>
          <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Silakan pilih waktu untuk setiap mata kuliah yang diambil.</p>

          {{-- Tabel Jadwal --}}
        <div id="scheduleDisplay" class="mt-4 overflow-x-auto flex justify-center">
            <div class="w-full">
                <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-white">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 bg-gray-100 dark:bg-gray-700 text-center">Waktu</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 bg-gray-100 dark:bg-gray-700 text-center">Senin</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 bg-gray-100 dark:bg-gray-700 text-center">Selasa</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 bg-gray-100 dark:bg-gray-700 text-center">Rabu</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 bg-gray-100 dark:bg-gray-700 text-center">Kamis</th>
                            <th class="border border-gray-300 dark:border-gray-600 p-2 bg-gray-100 dark:bg-gray-700 text-center">Jumat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($hour = 7; $hour <= 19; $hour++)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 p-2 text-center">
                                    {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                                </td>
                                @for ($day = 0; $day < 5; $day++)
                                    <td class="border border-gray-300 dark:border-gray-600 p-2 text-center">
                                        {{-- Tempat untuk memilih jadwal mata kuliah --}}
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        </section>

        <br>
        {{-- ini isinya pop up buat nampilin irs yg jadi diambil --}}
        {{-- ini karena aku blm bisa bikin pop up jadi kubikin manual aja hehe --}}
        <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
          <label for="schedule">
            <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Isi IRS</p>
          </label>
          {{-- <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Jadwal mata kuliah yang dipilih akan ditampilkan di bawah ini.</p> --}}
          <div id="selectedScheduleList">
            <ul id="selectedScheduleList"></ul>
          </div>
        </section>

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
            Masa IRS-an sudah selesai. Tidak ada lagi pengisian, perubahan, dan pembatalan IRS untuk semester ini, silakan nikmati perkuliahan dengan baik. Miaw.
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