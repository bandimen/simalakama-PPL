{{-- resources/views/dekan/tambah-mata-kuliah.blade.php --}}
<x-layout>
    <x-slot:title>Dashboard Akademik</x-slot:title>
    
    <div class="min-h-full">
        <x-navbar-akademik></x-navbar-akademik>
        
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard Akademik</h1>
                <br>
                
                {{-- Info Alert --}}
                <div id="alert-1"
                    class="flex items-center p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                    role="alert">
                    <div class="ms-3 text-sm font-medium">
                        <strong>Selamat datang, {{ $tenagaPendidik->nama }}!</strong> Anda masuk sebagai <strong>Bagian Akademik</strong>.
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                {{-- Statistik --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <h2 class="text-lg font-bold">Jumlah Mahasiswa</h2>
                        <p class="text-4xl font-bold text-blue-600">1200</p>
                        <p class="text-sm text-gray-500">Total mahasiswa aktif</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <h2 class="text-lg font-bold">Jumlah Mata Kuliah</h2>
                        <p class="text-4xl font-bold text-green-600">45</p>
                        <p class="text-sm text-gray-500">Total mata kuliah terdaftar</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <h2 class="text-lg font-bold">Jumlah Dosen</h2>
                        <p class="text-4xl font-bold text-purple-600">75</p>
                        <p class="text-sm text-gray-500">Total dosen aktif</p>
                    </div>
                </div>

                {{-- Grafik Kehadiran Mahasiswa --}}
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-lg font-bold mb-4">Grafik Kehadiran Mahasiswa</h2>
                    <canvas id="attendanceChart" class="h-64"></canvas>
                </div>
            </div>
        </main>
    </div>

    {{-- Tambahkan script untuk Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                datasets: [{
                    label: 'Kehadiran Mahasiswa',
                    data: [120, 110, 130, 140, 125, 135],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layout>
