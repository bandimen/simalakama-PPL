
<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  <!-- Your content -->
  
  <div class="min-h-full">
    <x-navbar-pa></x-navbar-pa>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      @if ($irs->isNotEmpty())
      @foreach ($irs as $ir)
          <tr>
              <td>{{ $ir->jenis_semester }}</td>
              <td>{{ $ir->tahun_ajaran }}</td>
              <br>
              <!-- Tampilkan field lain yang diperlukan -->
          </tr>
      @endforeach
  @endif
      
    </div>
  </main>
</div>
</x-layout>