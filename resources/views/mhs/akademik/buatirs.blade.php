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
                <div class="flex justify-between items-center">
                    <!-- Judul -->
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Buat IRS</h1>
                    <!-- Breadcrumb -->
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="/mhs"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                    </svg>
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="/mhs/akademik"
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Akademik</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Buat
                                        IRS</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <br>
                @if ($currentPeriod)

                    @if ($activePeriodType == 'pengisian')
                        <div id="alert-additional-content-1"
                            class="p-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                            role="alert">
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <h3 class="text-lg font-medium">Anda dalam Masa Pengisian IRS</h3>
                            </div>
                            <div class="mt-2 mb-4 text-sm">
                                Masa pengisian IRS dimulai pada tanggal {{ $currentPeriod->periode_pengisian_start }}
                                hingga {{ $currentPeriod->periode_pengisian_end }}.
                            </div>
                        </div>
                        <br>
                        @php
                            $irsForCurrentPeriod = $mahasiswa
                                ->irs()
                                ->where('jenis_semester', $currentPeriod->semester)
                                ->where('tahun_ajaran', $currentPeriod->tahun_ajaran)
                                ->first();
                        @endphp
                        @if ($irsForCurrentPeriod && $irsForCurrentPeriod->status == 'Disetujui')
                            <div
                                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">IRS Anda sudah
                                    disetujui.</h5>
                                <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">IRS Anda disetujui
                                    oleh Pembimbing Akademik. Anda tidak bisa mengubah IRS. Jika Anda
                                    ingin melihat IRS, silakan menuju ke halaman Lihat IRS. Jika Anda ingin melakukan
                                    perubahan IRS, hubungi Pembimbing Akademik Anda untuk mendapatkan akses.</p>
                                {{-- <div class="flex items-center justify-center ">
                                    <img src="/images/sonic.png" alt="Sonic" class="bg-center">
                                </div> --}}
                                <div
                                    class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                                    <a href="/mhs/akademik/lihatirs"
                                        class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                        <div class="text-left rtl:text-right">
                                            <div class="-mt-1 font-sans text-sm font-semibold">Lihat IRS</div>
                                        </div>
                                    </a>
                                    <a href="https://wa.me/6285227715658"
                                        class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                        <div class="text-left rtl:text-right">
                                            <div class="-mt-1 font-sans text-sm font-semibold">Hubungi Pembimbing
                                                Akademik</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @else
                            {{-- kotak informasi mahasiswa --}}
                            <section
                                class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Nama:
                                    {{ $mahasiswa->nama }}</p>
                                <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">NIM:
                                    {{ $mahasiswa->nim }}</p>
                                <!-- Garis Horizontal -->
                                <hr class="border-gray-300 w-full mb-4 dark:border-gray-600">
                                <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Tahun Ajaran:
                                    {{ $currentPeriod->tahun_ajaran }}</p>
                                <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Indeks Prestasi
                                    Kumulatif: {{ $mahasiswa->getIPK() }} </p>
                                <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Indeks Prestasi
                                    Semester (lalu): {{ $mahasiswa->getIPSemesterLalu() }}</p>
                                <p class="mb-2 text-m tracking-tight text-gray-700 dark:text-white">Maksimal Beban SKS:
                                    {{ $mahasiswa->getMaxBebanSks() }}</p>
                            </section>

                            <br>

                            {{-- kotak untuk milih mata kuliah --}}
                            <section
                                class="block max-w p-6 bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700">
                                <label for="courses">
                                    <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Pilih
                                        Mata Kuliah</p>
                                </label>
                                <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Mata kuliah yang
                                    tersedia adalah mata kuliah yang bisa diambil pada periode semester ini. Mahasiswa
                                    disarankan untuk mengambil semua mata kuliah wajib terlebih dahulu baru mengambil
                                    mata kuliah pilihan/mengulang jika SKS masih tersedia.</p>
                                <br>
                                <select name="courses" id="courses" onchange="addCourse()">
                                    <option value="" hidden>-- Pilih Mata Kuliah --</option>
                                    @foreach ($matkuls as $matkul)
                                        <option value="{{ $matkul }}">[{{ $matkul->kodemk }}]
                                            {{ $matkul->nama }} | {{ $matkul->sks }} SKS | Semester
                                            {{ $matkul->semester }} | {{ $matkul->sifat }}</option>
                                    @endforeach
                                </select>
                                <br><br>
                                <div class="selected-courses" id="selectedCourses">
                                    <h3>Mata Kuliah yang Dipilih:</h3>
                                    <ul id="courseList"></ul>
                                </div>
                            </section>

                            <br>

                            <section
                                class="block w-full p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 mt-1">
                                <label for="schedule">
                                    <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Pilih
                                        Jadwal</p>
                                </label>
                                <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Silakan pilih waktu
                                    untuk setiap mata kuliah yang diambil.</p>

                                {{-- Tabel Jadwal --}}
                                <div id="scheduleDisplay" class="mt-4 overflow-x-auto flex justify-center">
                                    <div class="w-full">
                                        <table
                                            class="min-w-full w-full border-collapse border border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-white">
                                            <thead>
                                                <tr>
                                                    <th class="border p-2 bg-gray-100 text-center" style="width: 80px;">
                                                        Waktu</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Senin">
                                                        Senin</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Selasa">
                                                        Selasa</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Rabu">
                                                        Rabu</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Kamis">
                                                        Kamis</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Jumat">
                                                        Jumat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($hour = 7; $hour <= 19; $hour++)
                                                    <tr data-time="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                                        <td class="border p-2 text-center">
                                                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00</td>
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

                            <div id="bottomSheet"
                                class="fixed bottom-0 inset-x-0 bg-white shadow-lg rounded-t-lg transition-transform duration-300 z-50 max-w-7xl mx-auto"
                                style="transform: translateY(0);">
                                <!-- Bagian Kecil untuk Expand -->
                                <div id="toggleButton"
                                    class="flex justify-center items-center h-12 bg-black-200 rounded-t-lg cursor-pointer">
                                    <div id="toggleIcon" class="text-lg font-bold text-white">
                                        <span id="totalsks"></span> SKS
                                    </div>
                                </div>

                                <!-- Bagian Konten -->
                                <div id="content" class="p-4 hidden">
                                    <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">Jadwal Mata Kuliah
                                    </h2>

                                    <!-- Tabel -->
                                    <table id="bottomSheetTable"
                                        class="w-full border-collapse border border-gray-300">
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
                                            <tr id="emptyMessage">
                                                <td colspan="6" class="text-center text-gray-500">Belum ada jadwal
                                                    yang dipilih.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <style>
                                /* Bagian utama bottom sheet */
                                #bottomSheet {
                                    max-width: 1220px;
                                    /* max-w-7xl (1280px) */
                                    width: 100%;
                                    /* Responsif penuh hingga max-width */
                                    margin: 0 auto;
                                    /* Pusatkan secara horizontal */
                                    transform: translateY(0);
                                    /* Default collapsed */
                                    transition: transform 0.3s ease-in-out;
                                }

                                /* Konten bottom sheet saat expanded */
                                #bottomSheet.expand {
                                    transform: translateY(-70%);
                                    /* Expand ke atas 70% layar */
                                }

                                /* Bagian kecil (toggle button) */
                                #toggleButton {
                                    height: 50px;
                                    /* Tinggi bagian kecil */
                                    background-color: #5c7ec4;
                                    /* Warna abu-abu terang */
                                    border-radius: 10px 10px 0 0;
                                    /* Rounded di bagian atas */
                                    cursor: pointer;
                                    /* Tampilkan pointer */

                                }

                                /* Ikon toggle */
                                #toggleIcon {
                                    font-size: 16px;
                                    /* Ukuran ikon */
                                    color: #ffffff;
                                    /* Warna ikon */
                                }

                                /* Konten bagian utama */
                                #content {
                                    max-height: 90%;
                                    /* Batasi tinggi maksimal */
                                    overflow-y: auto;
                                    /* Tambahkan scrollbar jika konten terlalu banyak */
                                }

                                table th,
                                table td {
                                    font-size: 12px;
                                    /* Ukuran font untuk tabel */
                                    padding: 4px;
                                    /* Jarak konten di tabel */
                                }
                            </style>


                            <!-- Overlay dan Modal Alert IRS -->
                            <div id="confirmationModal"
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                <div class="bg-white rounded-lg p-6 w-80 text-center z-50">
                                    <h2 class="text-xl font-semibold mb-4">Konfirmasi IRS</h2>
                                    <p class="text-gray-700 mb-6">Apakah anda yakin ingin memilih mata kuliah ini?</p>
                                    <div class="flex justify-center gap-4">
                                        <button id="confirmButton"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ya</button>
                                        <button id="cancelButton"
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Tidak</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Overlay dan Modal Alert Pembatalan IRS -->
                            <div id="cancelConfirmationModal"
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                <div class="bg-white rounded-lg p-6 w-80 text-center z-50">
                                    <h2 class="text-xl font-semibold mb-4">Pembatalan IRS</h2>
                                    <p class="text-gray-700 mb-6">Apakah anda yakin ingin membatalkan pengambilan mata
                                        kuliah ini?</p>
                                    <div class="flex justify-center gap-4">
                                        <button id="confirmCancelButton"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ya</button>
                                        <button id="cancelCancelButton"
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Tidak</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @elseif ($activePeriodType == 'perubahan')
                            <div id="alert-additional-content-1"
                                class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                                role="alert">
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <h3 class="text-lg font-medium">Anda dalam Masa Perubahan IRS</h3>
                                </div>
                                <div class="mt-2 mb-4 text-sm">
                                    Masa perubahan IRS dimulai pada tanggal
                                    {{ $currentPeriod->periode_perubahan_start }} hingga
                                    {{ $currentPeriod->periode_perubahan_end }}.
                                </div>
                            </div>

                            <br>

                            <section
                                class="block w-full p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 mt-1">
                                <label for="schedule">
                                    <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Pilih
                                        Jadwal</p>
                                </label>
                                <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Silakan pilih waktu
                                    untuk setiap mata kuliah yang diambil.</p>

                                {{-- Tabel Jadwal --}}
                                <div id="scheduleDisplay" class="mt-4 overflow-x-auto flex justify-center">
                                    <div class="w-full">
                                        <table
                                            class="min-w-full w-full border-collapse border border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-white">
                                            <thead>
                                                <tr>
                                                    <th class="border p-2 bg-gray-100 text-center"
                                                        style="width: 80px;">Waktu</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Senin">
                                                        Senin</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Selasa">
                                                        Selasa</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Rabu">
                                                        Rabu</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Kamis">
                                                        Kamis</th>
                                                    <th class="border p-2 bg-gray-100 text-center" data-day="Jumat">
                                                        Jumat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($hour = 7; $hour <= 19; $hour++)
                                                    <tr data-time="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                                        <td class="border p-2 text-center">
                                                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00</td>
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

                            <div id="bottomSheet"
                                class="fixed bottom-0 inset-x-0 bg-white shadow-lg rounded-t-lg transition-transform duration-300 z-50 max-w-7xl mx-auto"
                                style="transform: translateY(0);">
                                <!-- Bagian Kecil untuk Expand -->
                                <div id="toggleButton"
                                    class="flex justify-center items-center h-12 bg-black-200 rounded-t-lg cursor-pointer">
                                    <div id="toggleIcon" class="text-lg font-bold text-white">
                                        <span id="totalSKS">0</span> SKS
                                    </div>
                                </div>

                                <!-- Bagian Konten -->
                                <div id="content" class="p-4 hidden">
                                    <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">Jadwal Mata Kuliah
                                    </h2>

                                    <!-- Tabel -->
                                    <table id="bottomSheetTable"
                                        class="w-full border-collapse border border-gray-300">
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
                                            <tr id="emptyMessage">
                                                <td colspan="6" class="text-center text-gray-500">Belum ada jadwal
                                                    yang dipilih.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <style>
                                /* Bagian utama bottom sheet */
                                #bottomSheet {
                                    max-width: 1220px;
                                    /* max-w-7xl (1280px) */
                                    width: 100%;
                                    /* Responsif penuh hingga max-width */
                                    margin: 0 auto;
                                    /* Pusatkan secara horizontal */
                                    transform: translateY(0);
                                    /* Default collapsed */
                                    transition: transform 0.3s ease-in-out;
                                }

                                /* Konten bottom sheet saat expanded */
                                #bottomSheet.expand {
                                    transform: translateY(-70%);
                                    /* Expand ke atas 70% layar */
                                }

                                /* Bagian kecil (toggle button) */
                                #toggleButton {
                                    height: 50px;
                                    /* Tinggi bagian kecil */
                                    background-color: #f3f4f6;
                                    /* Warna abu-abu terang */
                                    border-radius: 10px 10px 0 0;
                                    /* Rounded di bagian atas */
                                    cursor: pointer;
                                    /* Tampilkan pointer */
                                }

                                /* Ikon toggle */
                                #toggleIcon {
                                    font-size: 16px;
                                    /* Ukuran ikon */
                                    color: #4b5563;
                                    /* Warna ikon */
                                }

                                /* Konten bagian utama */
                                #content {
                                    max-height: 90%;
                                    /* Batasi tinggi maksimal */
                                    overflow-y: auto;
                                    /* Tambahkan scrollbar jika konten terlalu banyak */
                                }

                                table th,
                                table td {
                                    font-size: 12px;
                                    /* Ukuran font untuk tabel */
                                    padding: 4px;
                                    /* Jarak konten di tabel */
                                }
                            </style>
                        @elseif ($activePeriodType == 'pembatalan')
                            <div id="alert-additional-content-1"
                                class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                                role="alert">
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <h3 class="text-lg font-medium">Anda dalam Masa Pembatalan IRS</h3>
                                </div>
                                <div class="mt-2 mb-4 text-sm">
                                    Masa pembatalan IRS dimulai pada tanggal
                                    {{ $currentPeriod->periode_pembatalan_start }} hingga
                                    {{ $currentPeriod->periode_pembatalan_end }}.
                                </div>
                            </div>

                            <table id="cancellationTableBody"
                                class="min-w-full bg-white border border-gray-300 text-center mt-4">
                                <thead class="bg-gray-700 text-white">
                                    <tr>
                                        <th class="px-2 py-2 border border-gray-300 w-12">No</th>
                                        <th class="px-2 py-2 border border-gray-300 w-20">Kode MK</th>
                                        <th class="px-2 py-2 border border-gray-300 w-40">Mata Kuliah</th>
                                        <th class="px-2 py-2 border border-gray-300 w-16">Kelas</th>
                                        <th class="px-2 py-2 border border-gray-300 w-12">Hari</th>
                                        <th class="px-2 py-2 border border-gray-300 w-32">Jam</th>
                                        <th class="px-2 py-2 border border-gray-300 w-20">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="cancellationTableBodyContent">
                                    <!-- Data akan ditambahkan di sini -->
                                    @if ($mahasiswa->irs->first()->irsDetails->isNotEmpty())
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($mahasiswa->irs->first()->irsDetails as $detail)
                                            <tr>
                                                <td class="px-2 py-2 border border-gray-300 w-12"> {{ ++$counter }}
                                                </td>
                                                <td class="px-2 py-2 border border-gray-300 w-20">
                                                    {{ $detail->mataKuliah->kodemk }}</td>
                                                <td class="px-2 py-2 border border-gray-300 w-40">
                                                    {{ $detail->mataKuliah->nama }}</td>
                                                <td class="px-2 py-2 border border-gray-300 w-16">
                                                    {{ $detail->jadwalKuliah->kelas }}</td>
                                                <td class="px-2 py-2 border border-gray-300 w-12">
                                                    {{ $detail->jadwalKuliah->hari }}</td>
                                                <td class="px-2 py-2 border border-gray-300 w-32">
                                                    {{ $detail->jadwalKuliah->waktu_mulai }} -
                                                    {{ $detail->jadwalKuliah->waktu_selesai }}</td>
                                                <td class="px-2 py-2 border border-gray-300 w-20"><a
                                                        href="{{ route('deleteIrsDetail', $detail->id) }}">X</a></td>
                                            </tr>
                                        @endforeach

                                    @endif
                                </tbody>
                            </table>
                        @else
                            <div id="alert-additional-content-2"
                                class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                                role="alert">
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <h3 class="text-lg font-medium">Tidak dalam masa IRS-an</h3>
                                </div>
                                <div class="mt-2 mb-4 text-sm">
                                    Masa IRS sudah selesai. Tidak ada lagi pengisian, perubahan, dan pembatalan IRS
                                    untuk semester ini, silakan nikmati perkuliahan dengan baik. Miaw.
                                </div>
                                <div class="flex">
                                    <a href="/mhs">
                                        <button type="button"
                                            class="text-red-800 bg-transparent border border-red-800 hover:bg-red-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-red-600 dark:border-red-600 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800"
                                            data-dismiss-target="#alert-additional-content-2" aria-label="Close">
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
