<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  <!-- Your content -->
  
  <div class="min-h-full">
    <x-navbar-mhs></x-navbar-mhs>

   {{-- <x-header>{{ $title }}</x-header> title diambil datanya dari route web --}}
 <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Judul -->
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard</h1>
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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Dashboard</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <br>
        {{-- info alert --}}
        <div id="alert-{{ $mahasiswa->nim }}"
            class="flex items-center p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
            role="alert">
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                <strong>Selamat datang, {{ $mahasiswa->nama }}!</strong> Anda masuk sebagai <strong>Mahasiswa</strong>.
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-{{ $mahasiswa->nim }}" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        <!-- Card Pertama -->
        <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-l  dark:border-gray-700 dark:bg-gray-800  mb-4">
            <img class="object-contain w-28 h-28 rounded-full md:rounded-lg" src="/images/mhs/{{ $mahasiswa->foto }}" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $mahasiswa->nama }}</h5>
                <p class="flex mb-0 font-normal text-gray-700 dark:text-gray-400 space-x-1">
                    <span>NIM : {{ $mahasiswa->nim }}</span>
                    <span>|</span>
                    <span>Informatika S1</span>
                </p>
            </div>
        </div>

        <!-- Container untuk Card Kedua dan Ketiga dalam satu baris -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 w-full">
            <!-- Card Kedua -->
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow p-4 dark:border-gray-700 dark:bg-gray-800">
                <!-- Judul -->
                <h5 class="mb-4 text-xl font-bold text-center text-gray-900 dark:text-white">Status Akademik</h5>
                    
                <!-- Garis Horizontal -->
                <hr class="border-gray-300 w-full mb-4 dark:border-gray-600">

                <!-- Konten dalam grid 3 kolom dengan garis vertikal di tengah -->
                <div class="grid grid-cols-3 divide-x divide-gray-300 w-full text-center dark:divide-gray-600">
                    <!-- Tahun Akademik -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">Tahun Akademik</p>
                        <p class="text-lg font-bold text-gray-900">{{ $currentPeriod->tahun_ajaran }}</p>
                    </div>

                    <!-- Semester Studi -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">Semester Studi</p>
                        <p class="text-lg font-bold text-gray-900">{{ $semester }}</p>
                    </div>

                    <!-- Status Mahasiswa -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">Status Mahasiswa</p>
                        <p class="text-lg font-bold">
                        @php
                            $backgroundColor = $mahasiswa->status == 'Aktif' ? '#28a745' : '#db0202';
                        @endphp
                        <span class="inline-block px-4 py-1 text-white rounded-lg" style="background-color: {{ $backgroundColor }}">{{ $mahasiswa->status }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Ketiga -->
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow p-4 dark:border-gray-700 dark:bg-gray-800">
                <!-- Judul -->
                <h5 class="mb-4 text-xl font-bold text-center text-gray-900 dark:text-white">Prestasi Akademik</h5>
                    
                <!-- Garis Horizontal -->
                <hr class="border-gray-300 w-full mb-4 dark:border-gray-600">

                <!-- Konten dalam grid 2 kolom dengan garis vertikal di tengah -->
                <div class="grid grid-cols-2 divide-x divide-gray-300 w-full text-center dark:divide-gray-600">
                    <!-- IPK -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">IPK</p>
                        <p class="text-lg font-bold text-gray-900"> {{ $mahasiswa->getIPK() }} </p>
                    </div>

                    <!-- SKS -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">SKSk</p>
                        <p class="text-lg font-bold text-gray-900"> {{ $mahasiswa->getSKSK() }} </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container untuk Card Keempat, Kelima dan keenam dalam satu baris -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 w-full mt-5">
            <!-- Card Keempat -->
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow p-4 dark:border-gray-700 dark:bg-gray-800">
                <!-- Judul -->
                <h5 class="mb-2 text-xl font-bold text-center text-gray-900 dark:text-white">Dosen Wali</h5>
                    <!-- Nama dan NIDN PA -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">{{ $pa->nama }}</p>
                        <p class="text-sm font-medium text-center text-gray-500">NIDN: {{ $pa->nidn }}</p>
                    </div>
            </div>

            <!-- Card Kelima -->
            <a href="/mhs/akademik/buatirs" class="flex flex-col bg-white border border-gray-200 rounded-lg shadow p-4 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                <!-- Container untuk Gambar dan Teks dalam satu baris -->
                <div class="flex items-center">
                    <!-- Gambar di sebelah kiri -->
                    <img src="/images/irs.png" alt="IRS" class="w-16 h-16 mr-4">
                    <!-- Teks di sebelah kanan -->
                    <div>
                        <!-- Judul -->
                        <h5 class="text-xl font-bold text-gray-900 dark:text-white">Isian Rencana Studi</h5> 
                        <!-- Tahun Akademik -->
                        <p class="text-sm font-medium text-gray-500">{{ $currentPeriod->tahun_ajaran }}</p>
                    </div>
                </div>
            </a>

            <!-- Card Keenam -->
            <a href="/mhs/akademik/lihatkhs" class="flex flex-col bg-white border border-gray-200 rounded-lg shadow p-4 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <!-- Container untuk Gambar dan Teks dalam satu baris -->
                <div class="flex items-center">
                    <!-- Gambar di sebelah kiri -->
                    <img src="/images/khs.png" alt="IRS" class="w-16 h-16 mr-4">
                    <!-- Teks di sebelah kanan -->
                    <div>
                        <!-- Judul -->
                        <h5 class="text-xl font-bold text-gray-900 dark:text-white">Kartu Hasil Studi</h5>
                        <!-- Tahun Akademik -->
                        <p class="text-sm font-medium text-gray-500">{{ $currentPeriod->tahun_ajaran }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</main>

</div>
</x-layout>