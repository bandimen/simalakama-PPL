@if (count($data) > 0)
    @foreach ($data as $index => $m)
        {{-- Jika mahasiswa sudah mengisi IRS --}}
        @if ($m->irs->isNotEmpty() && $m->irs->first()->irsDetails->isNotEmpty())
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $index + 1 }}
                </th>
                <td class="px-6 py-4">
                    <a href="https://wa.me/{{ $m->no_hp }}?text=Halo,%20{{ $m->nama }}" target="_blank">
                        <img src="/images/icons/whatsapp.png" alt="WA" class="max-w-10 max-h-10">
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
                    <div id="modal-{{ $m->irs->first()->id }}" tabindex="-1" aria-hidden="true"
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
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                                            <td colspan="8" class="px-6 py-4">Tidak ada
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
                                        <button onclick="setujuiIrs({{ $m->irs->first()->id }})" type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setujui</button>
                                    @elseif ($m->irs->first()->status == 'Disetujui')
                                        <button onclick="batalkanIrs({{ $m->irs->first()->id }})" type="button"
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
                        <a href="#" onclick="batalkanIrs({{ $m->irs->first()->id }})"
                            class="font-medium text-red-500 dark:text-red-500 hover:underline">Batalkan</a>
                    @endif
                </td>
            </tr>
            {{-- Jika mahasiswa belum mengisi IRS --}}
        @else
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $index + 1 }}
                </th>
                <td class="px-6 py-4">
                    <a href="https://wa.me/{{ $m->no_hp }}?text=Halo,%20{{ $m->nama }}" target="_blank">
                        <img src="/images/icons/whatsapp.png" alt="WA" class="max-w-10 max-h-10">
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
                        data-modal-target="modal-{{ $m->nim }}" data-modal-toggle="modal-{{ $m->nim }}">
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
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
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

                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                                    <button data-modal-hide="modal-{{ $m->nim }}" type="button"
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

@else
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td class="px-6 py-4 text-center align-middle" colspan="9">
            Data mahasiswa yang Anda cari tidak ditemukan.
        </td>
    </tr>


@endif
