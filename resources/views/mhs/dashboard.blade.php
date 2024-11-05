
<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  <!-- Your content -->
  
  <div class="min-h-full">
    <x-navbar-mhs></x-navbar-mhs>

   {{-- <x-header>{{ $title }}</x-header> title diambil datanya dari route web --}}
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard</h1>
      <br>

      <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-l hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="/images/mhs/{{ $mahasiswa->foto}}" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $mahasiswa->nama }}</h5>
            <br>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">NIM : {{ $mahasiswa->nim }}  |  Informatika S1</p>
        </div>
    </div>

      
    </div>
  </main>
</div>
</x-layout>