<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
    <!-- Your content -->

    <div class="min-h-full">
        <x-navbar-pa></x-navbar-pa>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Judul -->
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard</h1>
                    <!-- Breadcrumb -->
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="/pa"
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
                <div id="alert-{{ $pa->nidn }}"
                    class="flex items-center p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                    role="alert">
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        <strong>Selamat datang, {{ $pa->nama }}!</strong> Anda masuk sebagai <strong>Pembimbing
                            Akademik</strong>.
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-{{ $pa->nidn }}" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <div class="max-w-[85rem] px-4 pt-4 mx-auto">
                    <!-- Grid -->
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 sm:gap-6">

                        <!-- Data to be Labeled Card -->
                        <div
                            class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between p-4 md:p-5 gap-x-3">
                                <div>
                                    <p class="text-xs tracking-wide text-gray-500 uppercase dark:text-gray-400">
                                        Total Mahasiswa Perwalian
                                    </p>
                                    <div class="flex items-center mt-1 gap-x-2">
                                        <h3 class="text-xl font-medium text-gray-800 sm:text-2xl dark:text-gray-100">
                                            {{ $totalMahasiswaPerwalian }} 
                                        </h3>
                                    </div>
                                </div>
                                <div
                                    class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-600 text-white rounded-full dark:bg-blue-900 dark:text-blue-200">
                                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="2 2 21 21" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M20 9.33333V6C20 4.89543 19.1046 4 18 4H14.6667M20 9.33333H14.6667M20 9.33333V14.6667M4 9.33333V6C4 4.89543 4.89543 4 6 4H9.33333M4 9.33333H9.33333M4 9.33333V14.6667M14.6667 9.33333H9.33333M14.6667 9.33333V4M14.6667 9.33333V14.6667M9.33333 9.33333V4M9.33333 9.33333V14.6667M20 14.6667V18C20 19.1046 19.1046 20 18 20H14.6667M20 14.6667H14.6667M4 14.6667V18C4 19.1046 4.89543 20 6 20H9.33333M4 14.6667H9.33333M14.6667 14.6667H9.33333M14.6667 14.6667V20M9.33333 14.6667V20M9.33333 4H14.6667M9.33333 20H14.6667">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <a class="inline-flex items-center justify-between px-4 py-3 text-sm text-gray-600 border-t border-gray-200 md:px-5 hover:bg-gray-50 rounded-b-xl dark:border-gray-700 dark:text-gray-400 dark:hover:bg-slate-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/pa/rekapmhs" wire:navigate="">
                                Lihat selengkapnya
                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </a>
                        </div>
                        <!-- End Data to be Labeled Card -->

                        <!-- Data to be Voted Card -->
                        <div
                            class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between p-4 md:p-5 gap-x-3">
                                <div>
                                    <p class="text-xs tracking-wide text-gray-500 uppercase dark:text-gray-400">
                                        Total IRS yang Sudah Disetujui
                                    </p>
                                    <div class="flex items-center mt-1 gap-x-2">
                                        <h3 class="text-xl font-medium text-gray-800 sm:text-2xl dark:text-gray-100">
                                            {{ $totalIrsDisetujui }}
                                        </h3>
                                    </div>
                                </div>
                                <div
                                    class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-600 text-white rounded-full dark:bg-blue-900 dark:text-blue-200">
                                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="2 2 21 21" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M20 9.33333V6C20 4.89543 19.1046 4 18 4H14.6667M20 9.33333H14.6667M20 9.33333V14.6667M4 9.33333V6C4 4.89543 4.89543 4 6 4H9.33333M4 9.33333H9.33333M4 9.33333V14.6667M14.6667 9.33333H9.33333M14.6667 9.33333V4M14.6667 9.33333V14.6667M9.33333 9.33333V4M9.33333 9.33333V14.6667M20 14.6667V18C20 19.1046 19.1046 20 18 20H14.6667M20 14.6667H14.6667M4 14.6667V18C4 19.1046 4.89543 20 6 20H9.33333M4 14.6667H9.33333M14.6667 14.6667H9.33333M14.6667 14.6667V20M9.33333 14.6667V20M9.33333 4H14.6667M9.33333 20H14.6667">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <a class="inline-flex items-center justify-between px-4 py-3 text-sm text-gray-600 border-t border-gray-200 md:px-5 hover:bg-gray-50 rounded-b-xl dark:border-gray-700 dark:text-gray-400 dark:hover:bg-slate-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/pa/perwalian" wire:navigate="">
                                Lihat selengkapnya
                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </a>
                        </div>
                        <!-- End Data to be Voted Card -->

                        <!-- Label Card -->
                        <div
                            class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between p-4 md:p-5 gap-x-3">
                                <div>
                                    <p class="text-xs tracking-wide text-gray-500 uppercase dark:text-gray-400">
                                        Total IRS yang Belum Disetujui
                                    </p>
                                    <div class="flex items-center mt-1 gap-x-2">
                                        <h3 class="text-xl font-medium text-gray-800 sm:text-2xl dark:text-gray-100">
                                            {{ $totalIrsBelumDisetujui }}
                                        </h3>
                                    </div>
                                </div>
                                <div
                                    class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-600 text-white rounded-full dark:bg-blue-900 dark:text-blue-200">
                                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="2 2 21 21" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M20 9.33333V6C20 4.89543 19.1046 4 18 4H14.6667M20 9.33333H14.6667M20 9.33333V14.6667M4 9.33333V6C4 4.89543 4.89543 4 6 4H9.33333M4 9.33333H9.33333M4 9.33333V14.6667M14.6667 9.33333H9.33333M14.6667 9.33333V4M14.6667 9.33333V14.6667M9.33333 9.33333V4M9.33333 9.33333V14.6667M20 14.6667V18C20 19.1046 19.1046 20 18 20H14.6667M20 14.6667H14.6667M4 14.6667V18C4 19.1046 4.89543 20 6 20H9.33333M4 14.6667H9.33333M14.6667 14.6667H9.33333M14.6667 14.6667V20M9.33333 14.6667V20M9.33333 4H14.6667M9.33333 20H14.6667">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <a class="inline-flex items-center justify-between px-4 py-3 text-sm text-gray-600 border-t border-gray-200 md:px-5 hover:bg-gray-50 rounded-b-xl dark:border-gray-700 dark:text-gray-400 dark:hover:bg-slate-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/pa/perwalian" wire:navigate="">
                                Lihat selengkapnya
                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </a>
                        </div>
                        <!-- End Label Card -->

                        <!-- Vote Card -->
                        <div
                            class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between p-4 md:p-5 gap-x-3">
                                <div>
                                    <p class="text-xs tracking-wide text-gray-500 uppercase dark:text-gray-400">
                                        Total Mahasiswa yang Belum Mengisi IRS
                                    </p>
                                    <div class="flex items-center mt-1 gap-x-2">
                                        <h3 class="text-xl font-medium text-gray-800 sm:text-2xl dark:text-gray-100">
                                            {{ $totalMhsBelumIrs }}
                                        </h3>
                                    </div>
                                </div>
                                <div
                                    class="flex-shrink-0 flex justify-center items-center w-[46px] h-[46px] bg-blue-600 text-white rounded-full dark:bg-blue-900 dark:text-blue-200">
                                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="2 2 21 21" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M20 9.33333V6C20 4.89543 19.1046 4 18 4H14.6667M20 9.33333H14.6667M20 9.33333V14.6667M4 9.33333V6C4 4.89543 4.89543 4 6 4H9.33333M4 9.33333H9.33333M4 9.33333V14.6667M14.6667 9.33333H9.33333M14.6667 9.33333V4M14.6667 9.33333V14.6667M9.33333 9.33333V4M9.33333 9.33333V14.6667M20 14.6667V18C20 19.1046 19.1046 20 18 20H14.6667M20 14.6667H14.6667M4 14.6667V18C4 19.1046 4.89543 20 6 20H9.33333M4 14.6667H9.33333M14.6667 14.6667H9.33333M14.6667 14.6667V20M9.33333 14.6667V20M9.33333 4H14.6667M9.33333 20H14.6667">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <a class="inline-flex items-center justify-between px-4 py-3 text-sm text-gray-600 border-t border-gray-200 md:px-5 hover:bg-gray-50 rounded-b-xl dark:border-gray-700 dark:text-gray-400 dark:hover:bg-slate-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/pa/perwalian" wire:navigate="">
                                Lihat selengkapnya
                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </a>
                        </div>
                        <!-- End Vote Card -->
                    </div>
                    <!-- End Grid -->
                </div>

            </div>
        </main>
    </div>
</x-layout>
