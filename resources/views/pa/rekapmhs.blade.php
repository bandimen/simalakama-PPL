<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
    <!-- Your content -->

    <div class="min-h-full">
        <x-navbar-pa></x-navbar-pa>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Judul -->
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Rekap Mahasiswa</h1>
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
                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Rekap
                                        Mhs</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <p>Berikut adalah mahasiswa perwalian Anda:</p>
                <br>
                {{-- search --}}
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="searchTabel" name="search"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        autocomplete="off" placeholder="Cari mahasiswa">
                </div>
                <br>
                {{-- tabel --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Nama
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        NIM
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jurusan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Angkatan
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    IPK
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SKSK
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    IRS
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    KHS
                                </th>
                            </tr>
                        </thead>
                        {{-- isi tabel --}}
                        <tbody id="bodyTabel">
                            @if ($mhs)
                                @foreach ($mhs as $index => $m)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->nim }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->prodi->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->angkatan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->getIPK() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $m->getSKSK() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('showIrsByNim', $m->nim) }}">
                                                <img src="/images/irs.png" class="h-6 w-6" alt="irs">
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('showKhsByNim', $m->nim) }}">
                                                <img src="/images/khs.png" class="h-6 w-6" alt="irs">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>

                <br>
            </div>



    </div>
    </main>
    </div>
    <script>
        $(document).ready(function() {
            // Event ketika pencarian diketik
            $('#searchTabel').on('keyup', function() {
                var query = $('#searchTabel').val(); // Ambil nilai dari input

                $.ajax({
                    url: "{{ route('ajaxRekapMhs') }}", // Endpoint untuk mendapatkan data
                    type: "GET",
                    data: {
                        search: query // Kirim query pencarian
                    },
                    success: function(data) {
                        $('#bodyTabel').html(data); // Update tabel dengan data yang diterima
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText); // Debug error jika ada
                    }
                });
            });
        });
    </script>
</x-layout>
