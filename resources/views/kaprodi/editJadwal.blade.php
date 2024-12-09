<x-layout>
    <x-slot:title>Edit Jadwal Kuliah</x-slot:title>
    <div class="min-h-full">
        <x-navbar-kaprodi></x-navbar-kaprodi>

        <main class="flex justify-center w-full px-4 py-6 sm:px-6 lg:px-8">
            <div class="max-w-lg w-full bg-white shadow-lg rounded-lg p-8">
                <h4 class="text-4xl font-bold text-gray-900 mb-6">Edit Jadwal Kuliah</h4>

                @if($jadwalKuliah)
                    <form action="{{ route('kaprodi.updateJadwal', $jadwalKuliah->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        @if ($errors->has('jadwal_bentrok'))
                        <div class="alert alert-danger">
                            {{ $errors->first('jadwal_bentrok') }}
                        </div>
                    @endif

                        <!-- Mata Kuliah -->
                        <div class="mb-4">
                            <label for="kodemk" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                            <select id="kodemk" name="kodemk" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Pilih Mata Kuliah</option>
                                @foreach ($mataKuliah as $mk)
                                    <option value="{{ $mk->kodemk }}" data-sks="{{ $mk->sks }}"
                                            {{ $jadwalKuliah->kodemk == $mk->kodemk ? 'selected' : '' }}
                                            {{ isset($mataKuliahWithClassCount[$mk->kodemk]) && $mataKuliahWithClassCount[$mk->kodemk] >= 4 ? 'disabled' : '' }}>
                                        {{ $mk->nama }} ({{ $mk->sks }} SKS)
                                    </option>
                                @endforeach
                            </select>
                            @error('kodemk')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ruang -->
                        <div class="mb-4">
                            <label for="ruang_id" class="block text-sm font-medium text-gray-700">Ruang</label>
                            <select id="ruang_id" name="ruang_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Pilih Ruang</option>
                                @foreach ($ruang as $r)
                                    @if ($r->status == 'Disetujui')
                                        <option value="{{ $r->id }}" data-kapasitas="{{ $r->kapasitas }}" {{ $jadwalKuliah->ruang_id == $r->id ? 'selected' : '' }}>
                                            {{ $r->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('ruang_id')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kelas -->
                        <div class="mb-4">
                            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select id="kelas" name="kelas" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k }}" {{ $jadwalKuliah->kelas == $k ? 'selected' : '' }}>
                                        {{ $k }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hari -->
                        <div class="mb-4">
                            <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                            <select id="hari" name="hari" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Pilih Hari</option>
                                @foreach ($hari as $h)
                                    <option value="{{ $h }}" {{ $jadwalKuliah->hari == $h ? 'selected' : '' }}>
                                        {{ $h }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hari')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">

                        <!-- Kuota Kelas -->
                        <div class="mb-4">
                            <label for="kuota_kelas" class="block text-sm font-medium text-gray-700">Kuota Kelas</label>
                        <input type="text" name="kuota_kelas" id="kuota_kelas" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('kuota_kelas', $jadwalKuliah->kuota_kelas) }}" readonly />
                            @error('kuota_kelas')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Waktu Mulai -->
                        <div class="mb-4">
                            <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                            <select id="waktu_mulai" name="waktu_mulai" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Pilih Waktu Mulai</option>
                                @foreach ($waktu_mulai as $w)
                                    <option value="{{ $w }}" {{ $jadwalKuliah->waktu_mulai == $w ? 'selected' : '' }}>
                                        {{ $w }}
                                    </option>
                                @endforeach
                            </select>
                            @error('waktu_mulai')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Waktu Selesai -->
                        <div class="mb-4">
                            <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                            <input type="text" name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai', $waktuSelesai) }}"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required readonly>
                            @error('waktu_selesai')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium text-sm rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Perbarui Jadwal</button>
                        </div>
                    </form>
                @endif
            </div>
        </main>
    </div>

    <script>
        // Fungsi untuk memperbarui kuota ruangan
        function updateRuangKuota(ruangSelectId, kuotaInputId) {
            const ruangSelect = document.getElementById(ruangSelectId);
            const kuotaInput = document.getElementById(kuotaInputId);

            ruangSelect.addEventListener('change', () => {
                const selectedOption = ruangSelect.options[ruangSelect.selectedIndex];
                kuotaInput.value = selectedOption ? selectedOption.getAttribute('data-kapasitas') : '';
            });
        }

        // Fungsi untuk memvalidasi jadwal ruangan
        function validateRuangJadwal(ruangSelectId, hariSelectId, waktuMulaiSelectId, apiUrl) {
            const ruangSelect = document.getElementById(ruangSelectId);
            const hariSelect = document.getElementById(hariSelectId);
            const waktuMulaiSelect = document.getElementById(waktuMulaiSelectId);

            ruangSelect.addEventListener('change', () => checkJadwalConflict(apiUrl));
            hariSelect.addEventListener('change', () => checkJadwalConflict(apiUrl));
            waktuMulaiSelect.addEventListener('change', () => checkJadwalConflict(apiUrl));

            function checkJadwalConflict(apiUrl) {
                const ruangId = ruangSelect.value;
                const hari = hariSelect.value;
                const waktuMulai = waktuMulaiSelect.value;

                if (ruangId && hari && waktuMulai) {
                    fetch(`${apiUrl}/${ruangId}/${hari}/${waktuMulai}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.is_conflict) {
                                alert('Ada jadwal lain pada ruang dan waktu ini.');
                            }
                        })
                        .catch(console.error);
                }
            }
        }

        // Fungsi untuk menghitung waktu selesai
        function calculateWaktuSelesai(mataKuliahSelectId, waktuMulaiSelectId, waktuSelesaiInputId) {
            const mataKuliahSelect = document.getElementById(mataKuliahSelectId);
            const waktuMulaiSelect = document.getElementById(waktuMulaiSelectId);
            const waktuSelesaiInput = document.getElementById(waktuSelesaiInputId);

            const updateWaktuSelesai = () => {
                const sks = mataKuliahSelect.options[mataKuliahSelect.selectedIndex]?.getAttribute('data-sks');
                const waktuMulai = waktuMulaiSelect.value;

                if (waktuMulai && sks) {
                    const waktuMulaiObj = new Date(`1970-01-01T${waktuMulai}Z`);
                    const waktuSelesai = new Date(waktuMulaiObj.getTime() + sks * 50 * 60 * 1000).toISOString().substr(11, 5);
                    waktuSelesaiInput.value = waktuSelesai;
                }
            };

            mataKuliahSelect.addEventListener('change', updateWaktuSelesai);
            waktuMulaiSelect.addEventListener('change', updateWaktuSelesai);
        }

        // Fungsi untuk memvalidasi jadwal kelas
        function validateKelasJadwal(hariSelectId, waktuMulaiSelectId, kelasSelectId, apiUrl) {
            const hariSelect = document.getElementById(hariSelectId);
            const waktuMulaiSelect = document.getElementById(waktuMulaiSelectId);
            const kelasSelect = document.getElementById(kelasSelectId);

            const updateKelasOptions = () => {
                const hari = hariSelect.value;
                const waktuMulai = waktuMulaiSelect.value;

                if (hari && waktuMulai) {
                    fetch(`${apiUrl}/${hari}/${waktuMulai}`)
                        .then(response => response.json())
                        .then(data => {
                            Array.from(kelasSelect.options).forEach(option => {
                                const kelas = option.value;
                                option.disabled = data.jadwalTerpakai.includes(kelas);
                                option.textContent = option.disabled
                                    ? `${kelas} (Sudah Digunakan)`
                                    : kelas;
                            });
                        })
                        .catch(console.error);
                }
            };

            hariSelect.addEventListener('change', updateKelasOptions);
            waktuMulaiSelect.addEventListener('change', updateKelasOptions);
        }

        // Inisialisasi fungsi
        updateRuangKuota('ruang_id', 'kuota_kelas');
        validateRuangJadwal('ruang_id', 'hari', 'waktu_mulai', '/cek-jadwal-ruang');
        calculateWaktuSelesai('kodemk', 'waktu_mulai', 'waktu_selesai');
        validateKelasJadwal('hari', 'waktu_mulai', 'kelas', '/cek-jadwal-kelas');
    </script>
</x-layout>
