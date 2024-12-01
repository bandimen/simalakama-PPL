<x-layout>
    <x-slot:title>Edit Jadwal Kuliah</x-slot:title>
    <div class="min-h-full">
        <x-sidebar-kaprodi></x-sidebar-kaprodi>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h4 class="text-4xl font-bold text-gray-900 mb-6">Edit Jadwal Kuliah</h4>
                <form action="{{ route('kaprodi.updateJadwal', $jadwalKuliah->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Mata Kuliah -->
                    <div class="form-group">
                        <label for="kodemk">Mata Kuliah</label>
                        <select name="kodemk" id="kodemk" class="form-control" required>
                            @foreach($mataKuliah as $mk)
                                <option value="{{ $mk->kodemk }}" {{ $jadwalKuliah->kodemk == $mk->kodemk ? 'selected' : '' }}>
                                    {{ $mk->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ruang -->
                    <div class="form-group">
                        <label for="ruang_id">Ruang</label>
                        <select name="ruang_id" id="ruang_id" class="form-control" required>
                            @foreach($ruang as $r)
                                <option value="{{ $r->id }}" {{ $jadwalKuliah->ruang_id == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kelas -->
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            @foreach(['A', 'B', 'C', 'D'] as $kelas)
                                <option value="{{ $kelas }}" {{ $jadwalKuliah->kelas == $kelas ? 'selected' : '' }}>
                                    {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Hari -->
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" class="form-control" required>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                                <option value="{{ $hari }}" {{ $jadwalKuliah->hari == $hari ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Waktu Mulai -->
                    <div class="form-group">
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <select name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                            @foreach(['07:00', '09:40', '13:00', '15:40'] as $waktu)
                                <option value="{{ $waktu }}" {{ $jadwalKuliah->waktu_mulai == $waktu ? 'selected' : '' }}>
                                    {{ $waktu }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Waktu Selesai -->
                    <div class="form-group">
                        <label for="waktu_selesai">Waktu Selesai</label>
                        <input type="text" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ $jadwalKuliah->waktu_selesai }}" readonly>
                    </div>

                    <!-- Kuota Kelas -->
                    <div class="form-group">
                        <label for="kuota_kelas">Kuota Kelas</label>
                        <input type="number" name="kuota_kelas" id="kuota_kelas" class="form-control" value="{{ $jadwalKuliah->kuota_kelas }}" min="30" max="50" required>
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('kaprodi.jadwalKuliah') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </main>
    </div>
</x-layout>
