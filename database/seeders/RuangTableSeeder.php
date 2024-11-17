<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangs = [
            ['nama' => 'E101', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'E102', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'E103', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'E201', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'E202', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'E203', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'E301', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'E302', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'E303', 'gedung' => 'E', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A101', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A102', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A103', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A201', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A202', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A203', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A301', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A302', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'A303', 'gedung' => 'A', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G101', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G102', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G103', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G201', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G202', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G203', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G301', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G302', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
            ['nama' => 'G303', 'gedung' => 'G', 'kapasitas' => '50', 'status' => 'Disetujui', 'prodi_id' => 1],
        ];

        foreach($ruangs as $ruangData){
            Ruang::create($ruangData);
        }
    }
}
