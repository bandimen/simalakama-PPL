
<x-layout>

  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  <!-- Your content -->
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <div class="min-h-full">
    <x-navbar-mhs></x-navbar-mhs>

   <x-header-irs-mhs></x-header-irs-mhs> 
  <main>
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
                    @if($mahasiswa->irs->first()->irsDetails->isNotEmpty())
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($mahasiswa->irs->first()->irsDetails as $detail)
                            @foreach ($detail->khsDetails as $khsDetail)
                                @php
                                    // Logika konversi nilai huruf ke angka
                                    $konversi = ['A' => 4, 'B' => 3, 'C' => 2, 'D' => 1, 'E' => 0];
                                    $bobot = $konversi[$khsDetail->nilai] ?? 0; // Nilai default jika kosong
                                    $sksXBobot = $bobot * ($detail->mataKuliah->sks ?? 0);
                                @endphp
                                <tr>
                                    <td class="px-2 py-2 border border-gray-300 w-12">{{ ++$counter }}</td>
                                    <td class="px-2 py-2 border border-gray-300 w-20">{{ $detail->mataKuliah->kodemk }}</td>
                                    <td class="px-2 py-2 border border-gray-300 w-40">{{ $detail->mataKuliah->nama }}</td>
                                    <td class="px-2 py-2 border border-gray-300 w-16">{{ $detail->mataKuliah->sifat }}</td>
                                    <td class="px-2 py-2 border border-gray-300 w-12">{{ $detail->status }}</td>
                                    <td class="px-2 py-2 border border-gray-300 w-32">{{ $detail->mataKuliah->sks }}</td>
                                    <td class="px-2 py-2 border border-gray-300 w-32">{{ $khsDetail->nilai ?? '-' }}</td>
                                    <td class="px-2 py-2 border border-gray-300 w-20">{{ $bobot }}</td>
                                    <td class="px-2 py-2 border border-gray-300 w-20">{{ $sksXBobot }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
      <br>
      
  </main>
</div>

</x-layout>