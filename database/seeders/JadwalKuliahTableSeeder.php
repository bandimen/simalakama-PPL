<?php

namespace Database\Seeders;

use App\Models\JadwalKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalKuliahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwalKuliah = [
            // semester 5
            ['kodemk' => 'PAIK6501', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Selasa', 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '16:20:00'], //pbp
            ['kodemk' => 'PAIK6501', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Selasa', 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00'], //pbp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 18, 'kelas' => 'D', 'hari' => 'Kamis', 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00'], //ktp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 18, 'kelas' => 'C', 'hari' => 'Rabu', 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00'], //ktp
            ['kodemk' => 'PAIK6503', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Kamis', 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00'], //si
            ['kodemk' => 'PAIK6503', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Jumat', 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00'], //si
            ['kodemk' => 'PAIK6504', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Jumat', 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00'], //ppl
            ['kodemk' => 'PAIK6504', 'ruang_id' => 18, 'kelas' => 'D', 'hari' => 'Rabu', 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00'], //ppl
            ['kodemk' => 'PAIK6505', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Rabu', 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00'], //ml
            ['kodemk' => 'PAIK6505', 'ruang_id' => 18, 'kelas' => 'C', 'hari' => 'Kamis', 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00'], //ml
        ];

        foreach($jadwalKuliah as $jadwal){
            JadwalKuliah::create($jadwal);
        }
    }
}
