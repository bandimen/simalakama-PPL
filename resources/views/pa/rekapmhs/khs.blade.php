<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
    <!-- Your content -->

    <div class="min-h-full">
        <x-navbar-pa></x-navbar-pa>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Judul -->
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">KHS Mahasiswa</h1>
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
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="/pa/rekapmhs"
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Rekap Mhs</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span
                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">KHS - {{ $mhs->nim }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <br>
                {{-- Profil --}}
                <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h2 class="text-xl font-medium tracking-tight text-gray-900 dark:text-white">Profil Mahasiswa</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-4">
                        <!-- Foto Mahasiswa -->
                        <div class="flex justify-center items-center">
                            <div class="w-36 h-48 bg-gray-200 rounded-md overflow-hidden shadow">
                                <img src="/images/mhs/{{ $mhs->foto }}" alt="Foto Mahasiswa" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <!-- Informasi Mahasiswa -->
                        <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Nama -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $mhs->nama }}</p>
                            </div>
                            <!-- NIM -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">NIM</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $mhs->nim }}</p>
                            </div>
                            <!-- Program Studi -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Program Studi</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $mhs->prodi->nama }}</p>
                            </div>
                            <!-- Fakultas -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fakultas</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">Fakultas Sains dan Matematika</p>
                            </div>
                            <!-- Angkatan -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Angkatan</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $mhs->angkatan }}</p>
                            </div>
                            <!-- Email -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $mhs->user->email }}</p>
                            </div>
                            <!-- IPK -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">IPK</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $mhs->getIPK() }}</p>
                            </div>
                            <!-- SKS Kumulatif -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">SKS Kumulatif</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $mhs->getSKSK() }}</p>
                            </div>
                            <!-- Status -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $mhs->status }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <br>
                {{-- IRS --}}
                <section
                    class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <h1 class="text-xl font-medium tracking-tight text-gray-900">Kartu Hasil Studi</h1>
                    <br>

                    <div id="accordion-flush" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400">
                        @if ($mhs->irs->isNotEmpty())
                            @php
                                $countSemester = 0;
                            @endphp
                            @foreach ($mhs->irs as $irs)
                                <h2 id="accordion-flush-heading-{{ $irs->id }}">
                                    <button type="button"
                                        class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
                                        data-accordion-target="#accordion-flush-body-{{ $irs->id }}"
                                        aria-expanded="false" aria-controls="accordion-flush-body-{{ $irs->id }}">
                                        <span>Semester {{ ++$countSemester }} | Tahun Akademik {{ $irs->tahun_ajaran }}
                                            {{ $irs->jenis_semester }}</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-flush-body-{{ $irs->id }}" class="hidden"
                                    aria-labelledby="accordion-flush-heading-{{ $irs->id }}">
                                    <div class="py-5 border-b border-gray-200 dark:border-gray-700">

                                        {{-- Tabel --}}
                                        <div class="p-4 md:p-5 space-y-4">
                                            <div class="relative overflow-x-auto">
                                                <table
                                                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                    <thead
                                                        class="text-xs text-gray-700 uppercase bg-blue-400 dark:bg-blue-700 dark:text-blue-400">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3">
                                                                No
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Kode
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Mata Kuliah
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Sifat
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Status
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                SKS
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Nilai Huruf
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Bobot
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                SKS x Bobot
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $counterDetail = 0;
                                                            $details = $irs->khs->khsDetails;
                                                            $totalSks = 0;
                                                            $totalBobot = 0;
                                                            $totalSksXBobot = 0;
                                                        @endphp
                                                        @if ($details)
                                                            @foreach ($details as $detail)
                                                                @php
                                                                    $bobot = match ($detail->nilai) {
                                                                        'A' => 4,
                                                                        'B' => 3,
                                                                        'C' => 2,
                                                                        'D' => 1,
                                                                        'E' => 0,
                                                                        default => 0,
                                                                    };
                                                                    $sks = $detail->irsDetail->mataKuliah->sks ?? 0;

                                                                    $totalSks += $sks;
                                                                    $totalBobot += $bobot;
                                                                    $totalSksXBobot += $sks * $bobot;
                                                                @endphp
                                                                <tr
                                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                    <td class="px-6 py-4">
                                                                        {{ ++$counterDetail }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $detail->irsDetail->kodemk }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $detail->irsDetail->mataKuliah->nama }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $detail->irsDetail->mataKuliah->sifat }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $detail->irsDetail->status }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $sks }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $detail->nilai ?? ' ' }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $bobot ?? ' ' }}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{ $sks * $bobot ?? ' ' }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr class="font-bold bg-gray-300 dark:bg-gray-900">
                                                                <td class="px-6 py-4" colspan="5">Total</td>
                                                                <td class="px-6 py-4"> {{ $totalSks }} </td>
                                                                <td class="px-6 py-4"></td>
                                                                <td class="px-6 py-4"> {{ $totalBobot }} </td>
                                                                <td class="px-6 py-4"> {{ $totalSksXBobot }} </td>
                                                            </tr>
                                                        @else
                                                            <td class="px-6 py-4">
                                                                Tidak ada mata kuliah.
                                                            </td>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="flex flex-col gap-1">
                                                <p class="text-m">
                                                    <strong>IP Semester :
                                                        {{ $totalSks > 0 ? number_format($totalSksXBobot / $totalSks, 2) : 'N/A' }}
                                                    </strong>
                                                </p>
                                                <p class="text-sm">{{ $totalSksXBobot ?? 0 }} / {{ $totalSks ?? 0 }}
                                                </p>
                                                <p class="text-sm">total (SKS x Bobot)/total SKS</p>

                                                <br class="my-1"> <!-- Mengatur jarak antar baris -->

                                                <p class="text-m"><strong>IP Kumulatif :
                                                        {{ $mhs->getIPK() }}
                                                    </strong></p>
                                                <p class="text-sm"> {{ $mhs->getBobotTerbaik() }} /
                                                    {{ $mhs->getSKSK() }} </p>
                                                <p class="text-sm">total (SKS x Bobot) terbaik/total SKS terbaik</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Mahasiswa belum memiliki riwayat studi.</p>
                        @endif
                    </div>
                </section>

            </div>
        </main>
    </div>
</x-layout>
