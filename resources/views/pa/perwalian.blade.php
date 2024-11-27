<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
    <!-- Your content -->

    <div class="min-h-full">
        <x-navbar-pa></x-navbar-pa>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Perwalian</h1>
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
                                                <a href="#"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Disetujui</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belum
                                                    disetujui</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belum mengisi</a>
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
                                    <input type="text" id="table-search-users"
                                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Cari mahasiswa">
                                </div>
                            </div>
                        </caption>

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        No
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        NIM
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Nama
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Jurusan
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Angkatan
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Total SKS
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Status
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 0 @endphp
                            @foreach ($mhs as $m)
                                {{-- Jika mahasiswa sudah mengisi IRS --}}
                                @if ($m->irs->isNotEmpty() && $m->irs->first()->irsDetails->isNotEmpty())
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ ++$counter }}
                                        </th>
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
                                                                <a
                                                                    href="{{ route('setujuiIrs', $m->irs->first()->id) }}">
                                                                    <button
                                                                        data-modal-hide="modal-{{ $m->irs->first()->id }}"
                                                                        type="button"
                                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setujui</button>
                                                                </a>
                                                            @elseif ($m->irs->first()->status == 'Disetujui')
                                                                <a
                                                                    href="{{ route('batalkanIrs', $m->irs->first()->id) }}">
                                                                    <button
                                                                        data-modal-hide="modal-{{ $m->irs->first()->id }}"
                                                                        type="button"
                                                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Batalkan</button>
                                                                </a>
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
                                            {{ $m->irs->first()->status }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if ($m->irs->first()->status == 'Belum disetujui')
                                                <a href="{{ route('setujuiIrs', $m->irs->first()->id) }}"
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
                                            {{ ++$counter }}
                                        </th>
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
                                            <div id="modal-{{ $m->nim }}" tabindex="-1"
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
                                            Belum mengisi
                                        </td>
                                        <td class="px-6 py-4 text-right">
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

</x-layout>
