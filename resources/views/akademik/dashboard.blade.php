{{-- resources/views/dekan/tambah-mata-kuliah.blade.php --}}
<x-layout>
    <x-slot:title>Dashboard Akademik</x-slot:title>
    
    <div class="min-h-full">
        <x-navbar-akademik></x-navbar-akademik>
        
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
              <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard</h1>
              <br>
              {{-- info alert --}}
              <div id="alert-1"
                  class="flex items-center p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                  role="alert">
                  <span class="sr-only">Info</span>
                  <div class="ms-3 text-sm font-medium">
                      <strong>Selamat datang, {{ $tenagaPendidik->nama }}!</strong> Anda masuk sebagai <strong>Bagian Akademik</strong>.
                  </div>
                  <button type="button"
                      class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                      data-dismiss-target="#alert-1" aria-label="Close">
                      <span class="sr-only">Close</span>
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                  </button>
              </div>
        
              
            </div>
          </main>
           
    </div>
</x-layout>
