<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
    <!-- Your content -->

    <div class="min-h-full">
        <x-navbar-pa></x-navbar-pa>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Judul -->
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Perwalian</h1>
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
                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Perwalian</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <br>

                {{-- Tabel --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                        <caption
                            class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            IRS Mahasiswa
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"><br>Pembimbing Akademik
                                dapat melakukan persetujuan dan pembatalan untuk IRS mahasiswa perwaliannya. Klik
                                nama/NIM mahasiswa untuk melihat rincian mata kuliah yang diambil mahasiswa pada periode
                                semester ini.</p>
                            <br><br>
                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                                <div>
                                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Action button</span>
                                        Status
                                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownAction"
                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownActionButton">
                                            <li>
                                                <a href="#" data-status="semua"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white active">Semua</a>
                                            </li>
                                            <li>
                                                <a href="#" data-status="disetujui"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Disetujui</a>
                                            </li>
                                            <li>
                                                <a href="#" data-status="belum_disetujui"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belum
                                                    disetujui</a>
                                            </li>
                                            <li>
                                                <a href="#" data-status="belum_mengisi"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belum
                                                    mengisi</a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="searchTabel" name="search"
                                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        autocomplete="off" placeholder="Cari nim/nama mahasiswa">
                                </div>
                            </div>
                        </caption>

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        No
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Chat
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        NIM

                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Nama
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Jurusan
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Angkatan
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Total SKS
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Status
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="bodyTabel">
                            @foreach ($mhs as $index => $m)
                                {{-- Jika mahasiswa sudah mengisi IRS --}}
                                @if ($m->irs->isNotEmpty() && $m->irs->first()->irsDetails->isNotEmpty())
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $index + 1 }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <a href="https://wa.me/{{ $m->no_hp }}?text=Halo,%20{{ $m->nama }}"
                                                target="_blank">
                                                <img src="/images/icons/whatsapp.png" alt="WA"
                                                    class="max-w-10 max-h-10">
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="font-medium hover:underline"
                                                data-modal-target="modal-{{ $m->irs->first()->id }}"
                                                data-modal-toggle="modal-{{ $m->irs->first()->id }}">{{ $m->nim }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="font-medium hover:underline"
                                                data-modal-target="modal-{{ $m->irs->first()->id }}"
                                                data-modal-toggle="modal-{{ $m->irs->first()->id }}">
                                                {{ $m->nama }}</a>
                                            <!-- Main modal jika Mhs sudah mengisi IRS-->
                                            <div id="modal-{{ $m->irs->first()->id }}" tabindex="-1"
                                                aria-hidden="true"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-6xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div
                                                            class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3
                                                                class="text-xl font-semibold text-gray-900 dark:text-white text-center flex-grow">
                                                                IRS {{ $m->nama }} - {{ $m->nim }}
                                                                ({{ $m->irs->first()->status }})
                                                            </h3>
                                                            <button type="button"
                                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-hide="modal-{{ $m->irs->first()->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <div class="relative overflow-x-auto">
                                                                <table
                                                                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    <thead
                                                                        class="text-xs text-gray-700 uppercase bg-blue-200 dark:bg-blue-700 dark:text-blue-400">
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
                                                                                Kelas
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                SKS
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Ruang
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Status
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Dosen Pengampu
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $counterDetail = 0;
                                                                        @endphp
                                                                        @foreach ($m->irs as $irs)
                                                                            @if ($irs->irsDetails->isNotEmpty())
                                                                                @foreach ($irs->irsDetails as $detail)
                                                                                    <tr
                                                                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                                        <td class="px-6 py-4">
                                                                                            {{ ++$counterDetail }}
                                                                                        </td>
                                                                                        <td class="px-6 py-4">
                                                                                            {{ $detail->kodemk }}
                                                                                        </td>
                                                                                        <td class="px-6 py-4">
                                                                                            {{ $detail->mataKuliah->nama }}
                                                                                        </td>
                                                                                        <td class="px-6 py-4">
                                                                                            {{ $detail->jadwalKuliah->kelas }}
                                                                                        </td>
                                                                                        <td class="px-6 py-4">
                                                                                            {{ $detail->mataKuliah->sks }}
                                                                                        </td>
                                                                                        <td class="px-6 py-4">
                                                                                            {{ $detail->jadwalKuliah->ruang->nama }}
                                                                                        </td>
                                                                                        <td class="px-6 py-4">
                                                                                            {{ $detail->status }}
                                                                                        </td>
                                                                                        <td class="px-6 py-4">
                                                                                            @if ($detail->mataKuliah->dosenPengampu->isNotEmpty())
                                                                                                <ul>
                                                                                                    @foreach ($detail->mataKuliah->dosenPengampu as $dosen)
                                                                                                        <li>{{ $dosen->nama }}
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            @else
                                                                                                Tidak ada Dosen
                                                                                                Pengampu
                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @else
                                                                                <tr
                                                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                                    <td colspan="8"
                                                                                        class="px-6 py-4">Tidak ada
                                                                                        mata kuliah.</td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>

                                                                </table>
                                                            </div>

                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div
                                                            class="flex justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                            @if ($m->irs->first()->status == 'Belum disetujui')
                                                                <button
                                                                    onclick="setujuiIrs({{ $m->irs->first()->id }})"
                                                                    type="button"
                                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                    Setujui
                                                                </button>
                                                            @elseif ($m->irs->first()->status == 'Disetujui')
                                                                <button
                                                                    onclick="batalkanIrs({{ $m->irs->first()->id }})"
                                                                    type="button"
                                                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Batalkan</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Modal --}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->prodi->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->angkatan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->irs->first()->total_sks }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($m->irs->first()->status == 'Disetujui')
                                                <span
                                                    class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    {{ $m->irs->first()->status }}
                                                </span>
                                            @elseif ($m->irs->first()->status == 'Belum disetujui')
                                                <span
                                                    class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                    {{ $m->irs->first()->status }}
                                                </span>
                                            @endif

                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if ($m->irs->first()->status == 'Belum disetujui')
                                                <a href="#" onclick="setujuiIrs({{ $m->irs->first()->id }})"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Setujui</a>
                                            @elseif ($m->irs->first()->status == 'Disetujui')
                                                <a href="{{ route('batalkanIrs', $m->irs->first()->id) }}"
                                                    class="font-medium text-red-500 dark:text-red-500 hover:underline">Batalkan</a>
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- Jika mahasiswa belum mengisi IRS --}}
                                @else
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $index + 1 }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <a href="https://wa.me/{{ $m->no_hp }}?text=Halo,%20{{ $m->nama }}"
                                                target="_blank">
                                                <img src="/images/icons/whatsapp.png" alt="WA"
                                                    class="max-w-10 max-h-10">
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="font-medium hover:underline"
                                                data-modal-target="modal-{{ $m->nim }}"
                                                data-modal-toggle="modal-{{ $m->nim }}">{{ $m->nim }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="font-medium hover:underline"
                                                data-modal-target="modal-{{ $m->nim }}"
                                                data-modal-toggle="modal-{{ $m->nim }}">
                                                {{ $m->nama }}</a>
                                            <!-- Main modal jika belum mengisi IRS-->
                                            <div id="modal-{{ $m->nim }}" tabindex="-1" aria-hidden="true"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-6xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div
                                                            class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3
                                                                class="text-xl font-semibold text-gray-900 dark:text-white text-center flex-grow">
                                                                {{ $m->nama }} - {{ $m->nim }}
                                                                (Belum mengisi IRS)
                                                            </h3>
                                                            <button type="button"
                                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-hide="modal-{{ $m->nim }}">
                                                                <svg class="w-3 h-3" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <div class="relative overflow-x-auto">
                                                                <table
                                                                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                    <thead
                                                                        class="text-xs text-gray-700 uppercase bg-blue-200 dark:bg-blue-700 dark:text-blue-400">
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
                                                                                Kelas
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                SKS
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Ruang
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Status
                                                                            </th>
                                                                            <th scope="col" class="px-6 py-3">
                                                                                Dosen Pengampu
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <tr
                                                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                            <td colspan="8" class="px-6 py-4">
                                                                                Mahasiswa belum melakukan pengisian IRS.
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div
                                                            class="flex justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                            <button data-modal-hide="modal-{{ $m->nim }}"
                                                                type="button"
                                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Modal --}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->prodi->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->angkatan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            -
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-900 dark:text-gray-300">
                                                Belum mengisi
                                            </span>

                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            -
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>

    <script>
        function setujuiIrs(id) {
            // Konfirmasi pengguna sebelum mengupdate
            Swal.fire({
                title: 'Yakin ingin menyetujui IRS?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, kirim permintaan AJAX
                    $.ajax({
                        url: "{{ route('setujuiIrs', '') }}/" + id, // Sesuaikan route
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}" // Token CSRF
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'IRS berhasil disetujui.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload halaman jika perlu
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menyetujui IRS.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function batalkanIrs(id) {
            // Konfirmasi pengguna sebelum mengupdate
            Swal.fire({
                title: 'Yakin ingin membatalkan IRS?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, kirim permintaan AJAX
                    $.ajax({
                        url: "{{ route('batalkanIrs', '') }}/" + id, // Sesuaikan route
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}" // Token CSRF
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                'IRS berhasil dibatalkan.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload halaman jika perlu
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat membatalkan IRS.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        $(document).ready(function() {


            function fetchTableData() {
                var query = $('#searchTabel').val(); // Ambil input dari pencarian
                var status = $('#dropdownAction a.active').data('status'); // Ambil status yang dipilih

                $.ajax({
                    url: "{{ route('ajaxPerwalian') }}", // Endpoint untuk live search dan filter
                    type: "GET",
                    data: {
                        search: query,
                        status: status
                    }, // Kirim search dan status ke server
                    success: function(data) {
                        $('#bodyTabel').html(data); // Update isi tabel
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText); // Debug jika ada error
                    }
                });
            }

            // Handle modal toggle and close dynamically
            $(document).on('click', '[data-modal-toggle]', function(e) {
                e.preventDefault();
                var modalId = $(this).data('modal-target');
                $('#' + modalId).removeClass('hidden');

                // Inisialisasi ulang Flowbite modal jika perlu
                const modal = new Modal(document.getElementById(modalId));
                modal.show(); // Menampilkan modal setelah di-setup
            });

            $(document).on('click', '[data-modal-hide]', function(e) {
                e.preventDefault();
                var modalId = $(this).data('modal-hide');
                $('#' + modalId).addClass('hidden');

                // Inisialisasi ulang Flowbite modal saat menutup
                const modal = new Modal(document.getElementById(modalId));
                modal.hide(); // Menyembunyikan modal dengan benar
            });

            // Event untuk Live Search
            $('#searchTabel').on('keyup', function() {
                fetchTableData(); // Panggil fungsi fetchTableData
            });

            // Event untuk Dropdown
            $('#dropdownAction a').on('click', function(e) {
                e.preventDefault(); // Mencegah navigasi ke `#`
                $('#dropdownAction a').removeClass('active'); // Hapus status aktif dari semua link
                $(this).addClass('active'); // Tandai link yang dipilih
                fetchTableData(); // Panggil fungsi fetchTableData
            });

        });
    </script>
</x-layout>
