@if (count($mhs) > 0)
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