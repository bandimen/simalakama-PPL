<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
    <!-- Your content -->

    <div class="min-h-full">
        <x-navbar-pa></x-navbar-pa>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
              {{-- Judul --}}
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">IRS Mahasiswa</h1>
                <br>
                {{-- Profil --}}
                <section
                    class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <h1 class="text-xl font-medium tracking-tight text-gray-900">Profil</h1>
                    <br>

                    <div id="accordion-flush" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400">
                        ini profil
                    </div>
                </section>

                <br>
                {{-- IRS --}}
                <section
                    class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <h1 class="text-xl font-medium tracking-tight text-gray-900">Isian Rencana Studi</h1>
                    <br>

                    <div id="accordion-flush" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400">
                        @if ($irs->isNotEmpty())
                            @php
                                $countSemester = 0;
                            @endphp
                            @foreach ($irs as $i)
                                <h2 id="accordion-flush-heading-{{ $i->id }}">
                                    <button type="button"
                                        class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
                                        data-accordion-target="#accordion-flush-body-{{ $i->id }}"
                                        aria-expanded="false" aria-controls="accordion-flush-body-{{ $i->id }}">
                                        <span>Semester {{ ++$countSemester }} | Tahun Akademik {{ $i->tahun_ajaran }} {{ $i->jenis_semester }}</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-flush-body-{{ $i->id }}" class="hidden"
                                    aria-labelledby="accordion-flush-heading-{{ $i->id }}">
                                    <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                      <h3
                                          class="text-xl font-semibold text-gray-900 dark:text-white text-center flex-grow">
                                          IRS {{ $mhs->nama }} - {{ $mhs->nim }}
                                          ({{ $i->status }})
                                      </h3>
                                      {{-- Tabel --}}
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
                                                        $details = $i->irsDetails;
                                                    @endphp
                                                    @if ($details)
                                                        @foreach ($details as $detail)
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
                                                                    @if ($detail->dosenPengampuList->isNotEmpty())
                                                                        <ul>
                                                                            @foreach ($detail->dosenPengampuList as $dosen)
                                                                                <li>{{ $dosen->nama }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @else
                                                                        Tidak ada Dosen Pengampu
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <td class="px-6 py-4">
                                                            Tidak ada mata kuliah.
                                                        </td>
                                                    @endif
                                                </tbody>

                                            </table>
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
