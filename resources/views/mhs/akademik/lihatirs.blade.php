<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <style>
    /* CSS untuk menyembunyikan elemen dengan kelas .no-print saat mencetak */
    @media print {
      .no-print {
         @apply hidden;
      }
    }
  </style>

  <div class="min-h-full">
    <x-navbar-mhs class="no-print"></x-navbar-mhs>
    <x-header-irs-mhs class="no-print"></x-header-irs-mhs> 

    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900 text-center">IRS Mahasiswa</h1>
        <br>
        <table class="min-w-full bg-white border border-gray-300 text-center">
          <thead>
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
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                  <td class="px-2 py-4 border border-gray-300">Dosen Pengampu</td>
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
      </div>
    </main>
  </div>
</x-layout>
