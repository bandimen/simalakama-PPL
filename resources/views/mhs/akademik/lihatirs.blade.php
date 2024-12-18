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
          <img src="/images/logo-undip.png" alt="Simalakama Undip" class="mx-auto w-20 mb-2"> <!-- Tambahkan path logo -->
          <h1 class="text-2xl font-bold">SIMALAKAMA UNDIP</h1>
          <p class="text-xl font-semibold">Isian Rencana Studi</p>
          <p class="text-xl font-semibold">TA {{ $currentPeriod->tahun_ajaran }}</p>
        </div>

        <div class="mb-6 flex items-start print-only">
          <!-- Kontainer informasi mahasiswa dengan Flexbox -->
          <div class="flex items-start space-x-2">
            <!-- Label kolom kiri -->
            <div class="text-left min-w-[120px]">
              <p>Nama</p>
              <p>NIM</p>
              <p>Program Studi</p>
              <p>Dosen Wali</p>
            </div>
            
            <!-- Kolom isi data mahasiswa di kanan -->
            <div class="text-left">
              <p>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $mahasiswa->nama }}</p>
              <p>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $mahasiswa->nim }}</p>
              <p>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $mahasiswa->program_studi ?? '-' }}</p>
              <p>:&nbsp;&nbsp;&nbsp;&nbsp;{{ $pa->nama ?? '-' }}</p>
            </div>
          </div>
        </div>

        <!-- Status IRS -->
        <div class="no-print">
          <h1 class="text-2xl font-bold tracking-tight text-gray-900 text-center">IRS Mahasiswa</h1>
          <p class="text-center mt-2 text-gray-700">Status IRS: <span class="font-semibold">{{ $irs->status ?? 'Belum mengisi' }}</span> ({{ $irs->updated_at }})</p>
          <br>
          @if ($irs)
          <p class="text-xl text-center font-semibold">Semester {{ $irs->semester ?? ''}} | Tahun Ajaran {{ $irs->tahun_ajaran ?? ''}} {{ $irs->jenis_semester ?? ''}}</p>
          @endif
        </div> 

        <br>

        <!-- Menu Semester IRS -->
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
                window.location.href = `{{ url('/mhs/akademik/lihatirs') }}?semester=${semester}`;
            }
        </script>

        <!-- Tabel IRS -->
        <table class="min-w-full bg-white border border-gray-300 text-center mt-4">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="px-2 py-2 border border-gray-300 w-12">No</th>
                    <th class="px-2 py-2 border border-gray-300 w-20">Kode</th>
                    <th class="px-2 py-2 border border-gray-300 w-40">Mata Kuliah</th>
                    <th class="px-2 py-2 border border-gray-300 w-16">Kelas</th>
                    <th class="px-2 py-2 border border-gray-300 w-12">SKS</th>
                    <th class="px-2 py-2 border border-gray-300 w-32">Ruang</th>
                    <th class="px-2 py-2 border border-gray-300 w-20">Hari</th>
                    <th class="px-2 py-2 border border-gray-300 w-32 whitespace-nowrap">Jam</th>
                    <th class="px-2 py-2 border border-gray-300 w-20">Status</th>
                    <th class="px-2 py-2 border border-gray-300 w-32">Nama Dosen</th>
                </tr>
            </thead>
            <tbody>
                @php $counterDetail = 0; @endphp

                @if ($irsDetails && count($irsDetails) > 0)
                    @foreach ($irsDetails as $detail)
                        <tr class="{{ $counterDetail % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                            <td class="px-2 py-4 border border-gray-300">{{ ++$counterDetail }}</td>
                            <td class="px-2 py-4 border border-gray-300">{{ $detail->kodemk }}</td>
                            <td class="px-2 py-4 border border-gray-300">{{ $detail->mataKuliah->nama ?? '-' }}</td>
                            <td class="px-2 py-4 border border-gray-300">{{ $detail->jadwalKuliah->kelas ?? '-' }}</td>
                            <td class="px-2 py-4 border border-gray-300">{{ $detail->mataKuliah->sks ?? '-' }}</td>
                            <td class="px-2 py-4 border border-gray-300">{{ $detail->jadwalKuliah->ruang->nama ?? '-' }}</td>
                            <td class="px-2 py-4 border border-gray-300">{{ $detail->jadwalKuliah->hari ?? '-' }}</td>
                            <td class="px-2 py-4 border border-gray-300 whitespace-nowrap">
                                {{ $detail->jadwalKuliah->waktu_mulai ?? '-' }} - {{ $detail->jadwalKuliah->waktu_selesai ?? '-' }}
                            </td>
                            <td class="px-2 py-4 border border-gray-300">{{ $detail->status ?? '-' }}</td>
                            <td class="px-2 py-4 border border-gray-300">
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
                    <tr>
                        <td colspan="10" class="px-6 py-4 text-center border border-gray-300">
                            Tidak ada mata kuliah.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Tombol Cetak IRS -->
        <div class="mt-4 flex justify-start no-print">
          <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600" onclick="window.print()">Cetak IRS</button>
        </div>

        <div class="ttd print-only">
          <div class="rows">
              <div class="date-row"></div>
              <div class="date-row"></div>
              <div class="date-row">Semarang, {{ now()->format('d F Y') }}</div>
          </div> 
          <br><br><br><br>
          <div class="row">
              <div class="col">Pembimbing Akademik (Dosen Wali)</div>
              <div class="col"></div>
              <div class="col">Nama Mahasiswa</div>
          </div>
          <div class="row spacer"></div>
          <div class="row spacer"></div>
          <div class="row spacer"></div>
          <div class="row">
              <div class="col">{{ $pa->nama }}</div>
              <div class="col"></div>
              <div class="col">{{ $mahasiswa->nama }}</div>
          </div>
          <div class="row">
              <div class="col">NIDN. {{ $pa->nidn }}</div>
              <div class="col"></div>
              <div class="col">NIM. {{ $mahasiswa->nim }}</div>
          </div>
      </div>

      </div>
    </main>
  </div>
</x-layout>

<!-- CSS khusus untuk tampilan cetak -->
<style>
  @media print {
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
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 8px;
      text-align: center;
    }

    thead th {
      background-color: #ffffff !important; /* Pastikan background menjadi putih */
      color: #000000 !important;            /* Pastikan teks menjadi hitam */
    }
  }

  /* Styling khusus untuk layout tanda tangan */
  .ttd.print-only {
      font-size: 11px;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
  }

  .rows {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: -110px; /* Spasi antar baris */
    padding: 50px 0; /* Tambahkan padding vertikal untuk ruang tambahan */
  }

  .row {
      display: flex;
      margin-bottom: 10px; /* Spasi antar baris */
  }

  .col {
      flex: 1;
  }

  .date-row {
      flex: 1;
  }

  .spacer {
      height: 15px; /* Ruang kosong antara tanda tangan */
  }

  /* Tersembunyi di layar biasa */
  .print-only {
    display: none;
  }
</style>
