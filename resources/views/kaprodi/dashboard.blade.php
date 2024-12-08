<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-full">
        <x-sidebar-kaprodi></x-sidebar-kaprodi>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{-- Dashboard Heading --}}
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
                    Welcome to Dashboard Program Studi, {{ $prodiNama }}
                </h1>

                {{-- Card Mahasiswa Aktif --}}
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mahasiswa Aktif</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Semester Gasal 2024/2025</p>
                    <p class="text-m">Jumlah Mahasiswa Aktif: {{ $jumlahMahasiswaAktif }}</p>
                </div>
            </div>
        </main>
    </div>
</x-layout>
