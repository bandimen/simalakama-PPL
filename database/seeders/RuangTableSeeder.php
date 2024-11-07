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
            ['nama' => 'E101', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'E102', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'E103', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'E201', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'E202', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'E203', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'E301', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'E302', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'E303', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A101', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A102', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A103', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A201', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A202', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A203', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A301', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A302', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'A303', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G101', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G102', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G103', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G201', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G202', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G203', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G301', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G302', 'kapasitas' => '50', 'status' => 'Disetujui'],
            ['nama' => 'G303', 'kapasitas' => '50', 'status' => 'Disetujui'],

        ];

        foreach($ruangs as $ruangData){
            Ruang::create($ruangData);
        }
    }
}
