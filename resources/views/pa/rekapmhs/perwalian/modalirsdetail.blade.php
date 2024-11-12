    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-6xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center flex-grow">
                      IRS {{ $i->nama }} - {{ $i->nim }} ({{ $i->status }})
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                  
                  <div class="relative overflow-x-auto">
                      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                          <thead class="text-xs text-gray-700 uppercase bg-blue-200 dark:bg-blue-700 dark:text-blue-400">
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
                                  <th scope="col" class="px-6 py-3">
                                      Aksi
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
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                                                  <li>{{ $dosen->nama }}</li>
                                              @endforeach
                                          </ul>
                                      @else
                                          Tidak ada Dosen Pengampu
                                      @endif
                                  </td>
                                  <td class="px-6 py-4">
                                      <a href="#" title="delete"><img src="/images/icons/delete.png" alt="delete" class="h-4 w-4"></a>
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
              <!-- Modal footer -->
              <div class="flex justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                  @if ($i->status == 'Belum disetujui')
                  <a href="{{ route('setujuiIrs', $i->id) }}">
                      <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Setujui</button>
                  </a>
                  @elseif ($i->status == 'Disetujui')
                  <a href="{{ route('batalkanIrs', $i->id) }}">
                      <button data-modal-hide="default-modal" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Batalkan</button>
                  </a>
                  @endif
              </div>
          </div>
      </div>
  </div>
  {{-- End Modal --}}