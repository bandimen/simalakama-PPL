<x-layout>
    <x-slot:title>Edit Jadwal Kuliah</x-slot:title>
    <div class="min-h-full">
        <x-navbar-kaprodi></x-navbar-kaprodi>

        <main class="flex justify-center w-full px-4 py-6 sm:px-6 lg:px-8">
            <div class="max-w-lg w-full bg-white shadow-lg rounded-lg p-8">
                <h4 class="text-4xl font-bold text-gray-900 mb-6">Edit Jadwal Kuliah</h4>

                <!-- Pastikan $jadwalKuliah ada -->
                @if($jadwalKuliah)
                    <form action="{{ route('kaprodi.updateJadwal', $jadwalKuliah->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Mata Kuliah -->
                        <div class="mb-4">
                            <label for="kodemk" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                            <select id="kodemk" name="kodemk" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled>Pilih Mata Kuliah</option>
                                @foreach ($mataKuliah as $mk)
                                    <option value="{{ $mk->kodemk }}" data-sks="{{ $mk->sks }}" {{ $jadwalKuliah->kodemk == $mk->kodemk ? 'selected' : '' }}>
                                        {{ $mk->nama }} ({{ $mk->sks }} SKS)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ruang -->
                        <div class="mb-4">
                            <label for="ruang_id" class="block text-sm font-medium text-gray-700">Ruang</label>
                            <select id="ruang_id" name="ruang_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled>Pilih Ruang</option>
                                @foreach ($ruang as $r)
                                    @if ($r->status == 'Disetujui')
                                        <option value="{{ $r->id }}" data-kapasitas="{{ $r->kapasitas }}" {{ $jadwalKuliah->ruang_id == $r->id ? 'selected' : '' }}>
                                            {{ $r->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Kelas -->
                        <div class="mb-4">
                            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select id="kelas" name="kelas" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled>Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k }}" {{ $jadwalKuliah->kelas == $k ? 'selected' : '' }}>
                                        {{ $k }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Hari -->
                        <div class="mb-4">
                            <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                            <select id="hari" name="hari" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled>Pilih Hari</option>
                                @foreach ($hari as $h)
                                    <option value="{{ $h }}" {{ $jadwalKuliah->hari == $h ? 'selected' : '' }}>
                                        {{ $h }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">

                        <!-- Kuota Kelas -->
                        <div class="mb-4">
                            <label for="kuota_kelas" class="block text-sm font-medium text-gray-700">Kuota Kelas</label>
                            <input type="text" name="kuota_kelas" id="kuota_kelas" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $jadwalKuliah->kuota_kelas }}" readonly />
                        </div>

                        <!-- Waktu Mulai -->
                        <div class="mb-4">
                            <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                            <select id="waktu_mulai" name="waktu_mulai" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled>Pilih Waktu Mulai</option>
                                @foreach ($waktu_mulai as $w)
                                    <option value="{{ $w }}" {{ $jadwalKuliah->waktu_mulai == $w ? 'selected' : '' }}>
                                        {{ $w }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Waktu Selesai -->
                        <div class="mb-4">
                            <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                            <input type="text" id="waktu_selesai" name="waktu_selesai" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $waktuSelesai }}" readonly />
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium text-sm rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Perbarui Jadwal</button>
                        </div>
                    </form>
                @else
                    <div class="text-red-500">Jadwal Kuliah tidak ditemukan.</div>
                @endif
            </div>
        </main>
    </div>

    <script>
        // Ambil elemen select Mata Kuliah, Waktu Mulai, Waktu Selesai, dan Ruang
        const mataKuliahSelect = document.getElementById('kodemk');
        const waktuSelesaiInput = document.getElementById('waktu_selesai');
        const waktuMulaiSelect = document.getElementById('waktu_mulai');
        const ruangSelect = document.getElementById('ruang_id');
        const kuotaInput = document.getElementById('kuota_kelas');

        // Fungsi untuk mengupdate Waktu Selesai berdasarkan SKS dan Waktu Mulai
        function updateWaktuSelesai() {
            const selectedOption = mataKuliahSelect.options[mataKuliahSelect.selectedIndex];
            const sks = selectedOption ? selectedOption.getAttribute('data-sks') : null;
            const waktuMulai = waktuMulaiSelect.value;

            if (waktuMulai && sks) {
                const waktuMulaiObj = new Date('1970-01-01T' + waktuMulai + 'Z');
                const waktuSelesaiObj = new Date(waktuMulaiObj.getTime() + sks * 50 * 60 * 1000); // 50 menit per SKS
                const waktuSelesai = waktuSelesaiObj.toISOString().substr(11, 5);

                // Update input waktu selesai
                waktuSelesaiInput.value = waktuSelesai;
            }
            document.getElementById('waktu_selesai').value = waktuSelesaiInput.value;
        }

        // Fungsi untuk mengupdate Kuota Kelas berdasarkan Ruang yang dipilih
        ruangSelect.addEventListener('change', function() {
            const selectedOption = ruangSelect.options[ruangSelect.selectedIndex];
            const kapasitas = selectedOption ? selectedOption.getAttribute('data-kapasitas') : null;

            // Update kuota kelas dengan kapasitas ruang yang dipilih
            kuotaInput.value = kapasitas;
            document.getElementById('kuota_kelas').value = kapasitas;
        });

        // Event listeners untuk Mata Kuliah dan Waktu Mulai
        mataKuliahSelect.addEventListener('change', updateWaktuSelesai);
        waktuMulaiSelect.addEventListener('change', updateWaktuSelesai);
    </script>
</x-layout>
