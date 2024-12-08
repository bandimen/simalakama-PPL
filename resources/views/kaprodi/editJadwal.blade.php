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
                                    <option value="{{ $k }}" {{ $jadwalKuliah->kelas == $k ? 'selected' : '' }}
                                            @foreach ($existingJadwals as $existingJadwal)
                                                @if ($existingJadwal->kelas == $k)
                                                    disabled
                                                @endif
                                            @endforeach
                                    >
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
        const ruangSelect = document.getElementById('ruang_id');
        const kuotaInput = document.getElementById('kuota_kelas');

        ruangSelect.addEventListener('change', function() {
            const selectedOption = ruangSelect.options[ruangSelect.selectedIndex];
            const kapasitas = selectedOption ? selectedOption.getAttribute('data-kapasitas') : null;

            kuotaInput.value = kapasitas;
            document.getElementById('kuota_kelas').value = kapasitas;
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen waktu mulai dan waktu selesai
            const waktuMulaiElement = document.getElementById('waktu_mulai');
            const waktuSelesaiElement = document.getElementById('waktu_selesai');

            // Ambil SKS dari mata kuliah yang sedang dipilih
            const mataKuliahElement = document.getElementById('kodemk');
            const selectedMataKuliah = mataKuliahElement.options[mataKuliahElement.selectedIndex];
            const sks = selectedMataKuliah ? parseInt(selectedMataKuliah.getAttribute('data-sks')) : 0;

            // Fungsi untuk menghitung waktu selesai
            function hitungWaktuSelesai(waktuMulai) {
                if (waktuMulai && sks > 0) {
                    const waktuMulaiParts = waktuMulai.split(':');
                    const jamMulai = parseInt(waktuMulaiParts[0]);
                    const menitMulai = parseInt(waktuMulaiParts[1]);

                    // Hitung durasi waktu selesai berdasarkan SKS
                    const durasiMenit = sks * 50; // 1 SKS = 50 menit
                    const waktuSelesaiDate = new Date(0, 0, 0, jamMulai, menitMulai + durasiMenit);

                    // Format waktu selesai ke format HH:MM
                    const jamSelesai = String(waktuSelesaiDate.getHours()).padStart(2, '0');
                    const menitSelesai = String(waktuSelesaiDate.getMinutes()).padStart(2, '0');

                    return `${jamSelesai}:${menitSelesai}`;
                }

                return '';
            }

            // Set waktu selesai saat halaman dimuat pertama kali
            waktuSelesaiElement.value = hitungWaktuSelesai(waktuMulaiElement.value);

            // Tambahkan event listener untuk perubahan waktu mulai
            waktuMulaiElement.addEventListener('change', function() {
                waktuSelesaiElement.value = hitungWaktuSelesai(this.value);
            });
        });
    </script>
</x-layout>
