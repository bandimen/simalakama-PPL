
<x-layout>

  <x-slot:title>{{ $title }}</x-slot:title> {{-- masukkan ke slot yg keynya title --}}
  <!-- Your content -->
  
  <div class="min-h-full">
    <x-navbar-mhs></x-navbar-mhs>

   <x-header-irs-mhs></x-header-irs-mhs> 
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-2xl font-bold tracking-tight text-gray-900">Buat IRS</h1>
      <br>
      <p>Ini nanti isinya alert semacam "masa periode pengisian irs/masa perubahan irs/masa pembatalan irs/ tidak dalam periode irs"</p>
      <br>
      <p>ini isinya informasi tentang mahasiswanya kek nama, ip semester lalu, semester skrg berapa, ipk berapa</p>
      <br>
{{-- kotak untuk milih mata kuliah --}}
      <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700 ">
        <label for="courses">
          <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Pilih Mata Kuliah</p>
        </label>
        <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Mata kuliah yang tersedia adalah mata kuliah yang bisa diambil pada periode semester ini. Mahasiswa disarankan untuk mengambil semua mata kuliah wajib terlebih dahulu baru mengambil mata kuliah pilihan/mengulang jika SKS masih tersedia.</p>
        <br>
        <select name="courses" id="courses" onchange="addCourse()">
          <option value="" hidden>-- Pilih Mata Kuliah --</option>
          @foreach ($matkuls as $matkul)
            <option value="{{ $matkul }}">[{{ $matkul->kodemk }}] {{ $matkul->nama }} | {{ $matkul->sks }} SKS | Semester {{$matkul->semester}} | {{ $matkul->sifat }}</option>
          @endforeach
        </select>
        <br><br>
        <div class="selected-courses" id="selectedCourses">
          <h3>Mata Kuliah yang Dipilih:</h3>
          <ul id="courseList"></ul>
        </div>
      </section>
        
      <br>
      {{-- ini buat milih jadwal --}}
      <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <label for="schedule">
          <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Pilih Jadwal</p>
        </label>
        <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Jadwal mata kuliah yang dipilih akan ditampilkan di bawah ini.</p>
        <div id="scheduleDisplay" class="mt-4"></div>
      </section>
      
      <br>
      {{-- ini isinya pop up buat nampilin irs yg jadi diambil --}}
      {{-- ini karena aku blm bisa bikin pop up jadi kubikin manual aja hehe --}}
      <section class="block max-w p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <label for="schedule">
          <p class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">Isi IRS</p>
        </label>
        {{-- <p class="font-normal text-sm text-gray-700 dark:text-gray-400">Jadwal mata kuliah yang dipilih akan ditampilkan di bawah ini.</p> --}}
        <div id="selectedScheduleList">
          <ul id="selectedScheduleList"></ul>
        </div>
          </section>
      
    </div>
  </main>
</div>



</x-layout>