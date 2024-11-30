<x-layout>
    <x-slot:title>Tambah Jadwal Kuliah</x-slot:title>
    <div class="min-h-full">
        <x-sidebar-kaprodi></x-sidebar-kaprodi>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h4 class="text-4xl font-bold text-gray-900 mb-6">Tambah Jadwal Kuliah</h4>

                <form action="{{ route('simpanJadwal') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="mb-3">
                        <label for="kodemk" class="form-label">Mata Kuliah</label>
                        <select id="kodemk" name="kodemk" class="form-control" required>
                            @foreach ($mataKuliah as $mk)
                                <option value="{{ $mk->kodemk }}">{{ $mk->nama }} ({{ $mk->sks }} SKS)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="ruang_id" class="form-label">Ruang</label>
                        <select id="ruang_id" name="ruang_id" class="form-control" required>
                            @foreach ($ruang as $r)
                                <option value="{{ $r->id }}">{{ $r->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select id="kelas" name="kelas" class="form-control" required>
                            @foreach ($kelas as $k)
                                <option value="{{ $k }}">{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <select id="hari" name="hari" class="form-control" required>
                            @foreach ($hari as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                        <select id="waktu_mulai" name="waktu_mulai" class="form-control" required>
                            @foreach ($waktuMulai as $w)
                                <option value="{{ $w }}">{{ $w }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </main>
    </div>
</x-layout>
