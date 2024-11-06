<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  <!-- Your content -->
  
  <div class="min-h-full">
    <x-navbar-mhs></x-navbar-mhs>

   {{-- <x-header>{{ $title }}</x-header> title diambil datanya dari route web --}}
 <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard</h1>
        <br>
        
        <!-- Card Pertama -->
        <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-l hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 mb-4">
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
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow p-4 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <!-- Judul -->
                <h5 class="mb-4 text-xl font-bold text-center text-gray-900 dark:text-white">Status Akademik</h5>
                    
                <!-- Garis Horizontal -->
                <hr class="border-gray-300 w-full mb-4 dark:border-gray-600">

                <!-- Konten dalam grid 3 kolom dengan garis vertikal di tengah -->
                <div class="grid grid-cols-3 divide-x divide-gray-300 w-full text-center dark:divide-gray-600">
                    <!-- Tahun Akademik -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">Tahun Akademik</p>
                        <p class="text-lg font-bold text-gray-900">2024/2025</p>
                    </div>

                    <!-- Semester Studi -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">Semester Studi</p>
                        <p class="text-lg font-bold text-gray-900">5</p>
                    </div>

                    <!-- Status Mahasiswa -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">Status Mahasiswa</p>
                        <p class="text-lg font-bold">
                            <span class="inline-block px-4 py-1 text-white rounded-lg" style="background-color: #28a745;">Aktif</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Ketiga -->
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow p-4 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <!-- Judul -->
                <h5 class="mb-4 text-xl font-bold text-center text-gray-900 dark:text-white">Prestasi Akademik</h5>
                    
                <!-- Garis Horizontal -->
                <hr class="border-gray-300 w-full mb-4 dark:border-gray-600">

                <!-- Konten dalam grid 2 kolom dengan garis vertikal di tengah -->
                <div class="grid grid-cols-2 divide-x divide-gray-300 w-full text-center dark:divide-gray-600">
                    <!-- IPK -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">IPK</p>
                        <p class="text-lg font-bold text-gray-900">4.00</p>
                    </div>

                    <!-- SKS -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">SKS</p>
                        <p class="text-lg font-bold text-gray-900">84</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container untuk Card Keempat, Kelima dan keenam dalam satu baris -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 w-full mt-5">
            <!-- Card Keempat -->
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow p-4 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <!-- Judul -->
                <h5 class="mb-2 text-xl font-bold text-center text-gray-900 dark:text-white">Wali Dosen</h5>
                    <!-- Nama dan NIDN PA -->
                    <div class="px-4">
                        <p class="text-sm font-medium text-gray-500">{{ $mahasiswa->nama }}</p>
                        <p class="text-sm font-medium text-center text-gray-500">{{ $mahasiswa->nim }}</p>
                    </div>
            </div>

            <!-- Card Kelima -->
            <a href="/mhs/akademik" class="flex flex-col bg-white border border-gray-200 rounded-lg shadow p-4 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                <!-- Container untuk Gambar dan Teks dalam satu baris -->
                <div class="flex items-center">
                    <!-- Gambar di sebelah kiri -->
                    <img src="/images/irs.png" alt="IRS" class="w-16 h-16 mr-4">
                    <!-- Teks di sebelah kanan -->
                    <div>
                        <!-- Judul -->
                        <h5 class="text-xl font-bold text-gray-900 dark:text-white">Isian Rencana Studi</h5> 
                        <!-- Tahun Akademik -->
                        <p class="text-sm font-medium text-gray-500">2024/2025</p>
                    </div>
                </div>
            </a>

            <!-- Card Keenam -->
            <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow p-4 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <!-- Container untuk Gambar dan Teks dalam satu baris -->
                <div class="flex items-center">
                    <!-- Gambar di sebelah kiri -->
                    <img src="/images/khs.png" alt="IRS" class="w-16 h-16 mr-4">
                    <!-- Teks di sebelah kanan -->
                    <div>
                        <!-- Judul -->
                        <h5 class="text-xl font-bold text-gray-900 dark:text-white">Kartu Hasil Studi</h5>
                        <!-- Tahun Akademik -->
                        <p class="text-sm font-medium text-gray-500">2024/2025</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</div>
</x-layout>