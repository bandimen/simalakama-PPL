<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="min-h-full">
    <div class="no-print">
      <x-navbar-mhs></x-navbar-mhs>
      <x-header-irs-mhs></x-header-irs-mhs> 
    </div>

    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        
        <!-- Informasi dan Logo -->
        <div class="text-center mb-6 print-only">
            <div class="head">
                <img src="/images/logo-undip.png" alt="Simalakama Undip" class="mx-auto w-20 mb-2"> <!-- Tambahkan path logo -->
                <h1 class="text-2xl font-bold">SIMALAKAMA UNDIP</h1>
                <p class="text-xl font-semibold">Kartu Hasil Studi</p>
                <p class="text-xl font-semibold">TA {{ $currentPeriod->tahun_ajaran }}</p>
            </div>
        </div>

        <div class="mb-6 flex items-start print-only">
            <div class="data">
                <!-- Kontainer informasi mahasiswa dengan Flexbox -->
                <div class="flex items-start space-x-2">
                    <!-- Label kolom kiri -->
                    <div class="text-left min-w-[120px]">
                    <p>Nama</p>
                    <p>NIM</p>
                    <p>Program Studi</p>
                    </div>
                    
                    <!-- Kolom isi data mahasiswa di kanan -->
                    <div class="text-left">
                    <p>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $mahasiswa->nama }}</p>
                    <p>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $mahasiswa->nim }}</p>
                    <p>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $mahasiswa->program_studi ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status KHS -->
        <div class="no-print">
          <h1 class="text-2xl font-bold tracking-tight text-gray-900 text-center">KHS Mahasiswa</h1>
          <br>
          <p class="text-xl text-center font-semibold">Semester {{ $khs->irs->semester }} | Tahun Ajaran {{ $khs->irs->tahun_ajaran }} {{ $khs->irs->jenis_semester }}</p>
        </div> 

        <br>

        <!-- Menu Semester KHS -->
        <div class="flex justify-center space-x-4 mb-6 no-print">
            @for ($i = 1; $i <= min($currentSemester, 14); $i++)
                <button onclick="redirectToSemester({{ $i }})" 
                        class="px-4 py-2 rounded {{ $selectedSemester == $i ? 'bg-[#0056b3] text-white px-6 py-3' : 'bg-[#00337c] text-white' }}">
                    SMT {{ $i }}
                </button>
            @endfor
        </div>

        <!-- JavaScript untuk mengubah semester -->
        <script>
            function redirectToSemester(semester) {
                // Redirect ke halaman dengan parameter semester yang dipilih
                window.location.href = `{{ url('/mhs/akademik/lihatkhs') }}?semester=${semester}`;
            }
        </script>

        <!-- Tabel KHS -->
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <table class="min-w-full bg-white border border-gray-300 text-center mt-4">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="px-2 py-2 border border-gray-300 w-12">No</th>
                        <th class="px-2 py-2 border border-gray-300 w-20">Kode MK</th>
                        <th class="px-2 py-2 border border-gray-300 w-40">Mata Kuliah</th>
                        <th class="px-2 py-2 border border-gray-300 w-16">Jenis</th>
                        <th class="px-2 py-2 border border-gray-300 w-12">Status</th>
                        <th class="px-2 py-2 border border-gray-300 w-32">Sks</th>
                        <th class="px-2 py-2 border border-gray-300 w-32">Nilai Huruf</th>
                        <th class="px-2 py-2 border border-gray-300 w-20">Bobot</th>
                        <th class="px-2 py-2 border border-gray-300 w-20">Sks X Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @if($khs && $khsDetails->isNotEmpty())
                        @php
                            $counter = 0;
                            $totalSks = 0;
                            $totalBobot = 0;
                            $totalSksXBobot = 0;
                        @endphp
                        @foreach ($khsDetails as $detail)
                            @php
                                $konversi = ['A' => 4, 'B' => 3, 'C' => 2, 'D' => 1, 'E' => 0];
                                $bobot = $konversi[$detail->nilai] ?? 0;
                                $sks = $detail->irsDetail->mataKuliah->sks ?? 0;
                                $sksXBobot = $bobot * $sks;

                                // Tambahkan ke total
                                $totalSks += $sks;
                                $totalBobot += $bobot;
                                $totalSksXBobot += $sksXBobot;
                            @endphp
                            <tr>
                                <td class="px-2 py-2 border border-gray-300 w-12">{{ ++$counter }}</td>
                                <td class="px-2 py-2 border border-gray-300 w-20">{{ $detail->irsDetail->mataKuliah->kodemk ?? '-' }}</td>
                                <td class="px-2 py-2 border border-gray-300 w-40">{{ $detail->irsDetail->mataKuliah->nama ?? '-' }}</td>
                                <td class="px-2 py-2 border border-gray-300 w-16">{{ $detail->irsDetail->mataKuliah->sifat ?? '-' }}</td>
                                <td class="px-2 py-2 border border-gray-300 w-12">{{ $detail->irsDetail->status ?? '-' }}</td>
                                <td class="px-2 py-2 border border-gray-300 w-32">{{ $sks ?? '-' }}</td>
                                <td class="px-2 py-2 border border-gray-300 w-32">{{ $detail->nilai ?? '-' }}</td>
                                <td class="px-2 py-2 border border-gray-300 w-20">{{ $bobot ?? '-' }}</td>
                                <td class="px-2 py-2 border border-gray-300 w-20">{{ $sksXBobot ?? '-' }}</td>
                            </tr>
                        @endforeach
                        <!-- Baris Total -->
                        <tr class="bg-gray-200 font-bold no-print">
                            <td colspan="5" class="px-2 py-2  text-center">Total</td>
                            <td class="px-2 py-2 ">{{ $totalSks ?? '-' }}</td>
                            <td class="px-2 py-2 "></td>
                            <td class="px-2 py-2 ">{{ $totalBobot ?? '-' }}</td>
                            <td class="px-2 py-2 ">{{ $totalSksXBobot ?? '-' }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="9" class="px-2 py-4 border border-gray-300 text-center">
                                Belum ada data KHS untuk semester ini.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <br>

            <!-- Perhitungan IP Semester -->
            @php
                // Pastikan nilai default untuk $totalSks dan $totalSksXBobot
                $totalSks = $totalSksXBobot = 0;

                // Cek apakah data khsDetails ada
                if (isset($khsDetails) && $khsDetails->isNotEmpty()) {
                    foreach ($khsDetails as $detail) {
                        $sks = $detail->irsDetail->mataKuliah->sks ?? 0;
                        $nilai = $detail->nilai;
                        
                        // Tentukan bobot berdasarkan nilai
                        $bobot = match ($nilai) {
                            'A' => 4,
                            'B' => 3,
                            'C' => 2,
                            'D' => 1,
                            'E' => 0,
                            default => 0,
                        };

                        $totalSks += $sks;
                        $totalSksXBobot += $sks * $bobot;
                    }
                }
            @endphp

            <div class="no-print">
                <div class="flex justify-start items-center mt-4">
                    <p class="text-lg font-semibold">IP. Semester</p>
                    @if($totalSks > 0)
                        <p class="text-lg font-bold pl-40">: {{ number_format($totalSksXBobot / $totalSks, 2) }}</p>
                    @else
                        <p class="text-lg font-bold ml-2">: -</p>
                    @endif
                </div>
                <div class="flex justify-start mt-2">
                    @if($totalSks > 0)
                        <!-- Operasi pembagian -->
                        <p>{{ $totalSksXBobot }} / {{ $totalSks }}</p>
                    @else
                        <p class="text-sm text-gray-500">Belum ada data untuk menghitung IP Semester</p>
                    @endif
                </div>
                <div class="flex justify-start mt-1">
                    <!-- Penjelasan formula -->
                    @if($totalSks > 0)
                        <p class="text-sm text-gray-500">(total (SKS x Bobot) / total SKS)</p>
                    @endif
                </div>

                <br>

                <!-- Perhitungan IP Kumulatif -->
                @php
                    // Pastikan nilai default untuk $totalSks dan $totalBobot
                    $totalSks = $mahasiswa->getSKSK() ?? 0;
                    $totalBobot = $mahasiswa->getBobotTerbaik() ?? 0;
                    $ipKumulatif = $totalSks > 0 ? number_format($totalBobot / $totalSks, 2) : 'N/A';
                @endphp

                <div class="flex justify-start items-center mt-4">
                    <p class="text-lg font-semibold">IP. Kumulatif</p>
                    @if($totalSks > 0)
                        <p class="text-lg font-bold pl-40">: {{ $ipKumulatif }}</p>
                    @else
                        <p class="text-lg font-bold ml-2">: -</p>
                    @endif
                </div>
                <div class="flex justify-start mt-2">
                    @if($totalSks > 0)
                        <!-- Operasi pembagian -->
                        <p>{{ $totalBobot }} / {{ $totalSks }}</p>
                    @else
                        <p class="text-sm text-gray-500">Belum ada data untuk menghitung IP Kumulatif</p>
                    @endif
                </div>
                <div class="flex justify-start mt-1">
                    <!-- Penjelasan formula -->
                    @if($totalSks > 0)
                        <p class="text-sm text-gray-500">(total (SKS x Bobot) <br> terbaik / total SKS terbaik)</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tombol Cetak KHS -->
        <div class="mt-4 flex justify-start no-print">
          <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600" onclick="window.print()">Cetak KHS</button>
        </div>

        <div class="ttd print-only">

            <div class="nilai">
                <div class="text-left">
                    <p>IP. Kumulatif : <span>{{ $ipKumulatif }}</span></p>
                    <p>SKS Kumulatif : <span>{{ $totalSks }}</span></p>
                </div>
                <div class="text-right">
                    <p>
                        IP Semester: 
                        <span class="fraction">
                            {{ $totalSksXBobot }} / {{ $totalSks }}
                        </span> = {{ number_format($totalSksXBobot / $totalSks, 2) }}
                    </p>
                </div>
            </div>

            <!-- Tanda tangan di kanan bawah -->
            <div class="signature-row">
                <div class="text-right">
                    Semarang, {{ now()->format('d F Y') }}<br>
                    Dekan <br><br><br><br><br><br>
                    Dr. Ngadiwiyana S.Si., M.Si. <br>
                    NIP: 196906201999031002
                </div>
            </div>
        </div>

      </div>

      </div>
    </main>
  </div>
</x-layout>

<!-- CSS khusus untuk tampilan cetak -->
<style>
    @media print {
        .head {
            font-size: 12px; /* Ukuran font diperkecil */
            text-align: center; /* Tetap rata tengah */
            margin-bottom: 20px; /* Sesuaikan jarak bawah */
        }

        .head h1 {
            font-size: 16px; /* Ukuran font judul sedikit lebih besar */
            font-weight: bold;
        }

        .head p {
            font-size: 12px; /* Ukuran font deskripsi */
            font-weight: normal;
        }

        .head img {
            width: 50px; /* Perkecil ukuran logo */
            margin-bottom: 10px; /* Atur jarak bawah logo */
        }
        /* Sembunyikan elemen non-cetak */
        .no-print, .navbar, .header, .footer { 
        display: none !important; 
        }

        /* Tampilkan elemen yang ingin dicetak saja */
        .print-only {
        display: block !important;
        }

        /* Tampilan tabel agar lebih bagus di cetak */

        table {
                width: 70%; /* Kurangi lebar tabel, misalnya menjadi 70% dari halaman */
                margin: 0 auto; /* Pusatkan tabel di halaman */
                font-size: 10px; /* Perkecil ukuran font untuk teks di dalam tabel */
        }

        th, td {
            padding: 4px; /* Perkecil padding untuk menghemat ruang */
            font-size: 10px;
            text-align: center; /* Sesuaikan ukuran font */
        }

        thead th {
        background-color: #ffffff !important; /* Pastikan background menjadi putih */
        color: #000000 !important;            /* Pastikan teks menjadi hitam */
        }

        .data {
            font-size: 12px; /* Ukuran font diperkecil */
            text-align: center; /* Tetap rata tengah */
            margin-bottom: 20px; /* Sesuaikan jarak bawah */
        }
    }

    /* Styling khusus untuk layout tanda tangan */
    .ttd.print-only {
        font-size: 11px;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    .signature-row {
        display: flex;
        justify-content: flex-end; /* Konten sejajar ke kanan */
        margin-top: 100px; /* Beri jarak cukup dari tanggal */
    }

    .text-right {
        text-align: right; /* Semua teks rata kanan */
        font-size: 12px; /* Sesuaikan ukuran font */
        line-height: 1.5; /* Memberi spasi antar baris */
    }

    .spacer {
        height: 15px; /* Ruang kosong antara tanda tangan */
    }

    /* Tersembunyi di layar biasa */
    .print-only {
        display: none;
    }

    .nilai {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    font-size: 12px; /* Ukuran font kecil */
    }

    .fraction {
        display: inline; /* Tetap berada dalam satu baris */
        font-size: 12px; /* Ukuran teks */
        vertical-align: middle; /* Sesuaikan posisi vertikal */
    }

    .text-right {
        text-align: right; /* Teks rata kanan */
        font-size: 12px; /* Ukuran font untuk seluruh teks */
        line-height: 1.5; /* Spasi antar baris */
    }

    .p {
        margin: 0; /* Hapus margin default untuk elemen paragraf */
    }


</style>
