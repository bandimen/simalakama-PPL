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
            ['kodemk' => 'PAIK6501', 'ruang_id' => 15, 'kelas' => 'A', 'hari' => 'Senin', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '11:20:00'], //pbp
            ['kodemk' => 'PAIK6501', 'ruang_id' => 7, 'kelas' => 'B', 'hari' => 'Kamis', 'waktu_mulai' => '14:00:00', 'waktu_selesai' => '17:20:00'], //pbp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 20, 'kelas' => 'A', 'hari' => 'Rabu', 'waktu_mulai' => '09:00:00', 'waktu_selesai' => '11:30:00'], //ktp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 12, 'kelas' => 'B', 'hari' => 'Selasa', 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00'], //ktp
            ['kodemk' => 'PAIK6503', 'ruang_id' => 24, 'kelas' => 'A', 'hari' => 'Jumat', 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '12:30:00'], //si
            ['kodemk' => 'PAIK6503', 'ruang_id' => 3, 'kelas' => 'B', 'hari' => 'Senin', 'waktu_mulai' => '15:00:00', 'waktu_selesai' => '17:30:00'], //si
            ['kodemk' => 'PAIK6504', 'ruang_id' => 11, 'kelas' => 'A', 'hari' => 'Kamis', 'waktu_mulai' => '08:30:00', 'waktu_selesai' => '11:00:00'], //ppl
            ['kodemk' => 'PAIK6504', 'ruang_id' => 25, 'kelas' => 'B', 'hari' => 'Rabu', 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00'], //ppl
            ['kodemk' => 'PAIK6505', 'ruang_id' => 6, 'kelas' => 'A', 'hari' => 'Selasa', 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00'], //ml
            ['kodemk' => 'PAIK6505', 'ruang_id' => 19, 'kelas' => 'B', 'hari' => 'Kamis', 'waktu_mulai' => '16:00:00', 'waktu_selesai' => '18:30:00'], //ml
            ['kodemk' => 'PAIK6506', 'ruang_id' => 4, 'kelas' => 'A', 'hari' => 'Rabu', 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '12:30:00'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 22, 'kelas' => 'B', 'hari' => 'Jumat', 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 8, 'kelas' => 'C', 'hari' => 'Senin', 'waktu_mulai' => '07:30:00', 'waktu_selesai' => '10:00:00'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 13, 'kelas' => 'D', 'hari' => 'Kamis', 'waktu_mulai' => '15:00:00', 'waktu_selesai' => '17:30:00'], //kji
            ['kodemk' => 'UUW00008', 'ruang_id' => 14, 'kelas' => 'A', 'hari' => 'Selasa', 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 27, 'kelas' => 'B', 'hari' => 'Rabu', 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '11:40:00'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 10, 'kelas' => 'C', 'hari' => 'Jumat', 'waktu_mulai' => '14:00:00', 'waktu_selesai' => '15:40:00'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 5, 'kelas' => 'D', 'hari' => 'Senin', 'waktu_mulai' => '09:00:00', 'waktu_selesai' => '10:40:00'], //kwu
            ['kodemk' => 'PAIK6102', 'ruang_id' => 1, 'kelas' => 'A', 'hari' => 'Senin', 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00'], //daspro
            ['kodemk' => 'PAIK6102', 'ruang_id' => 21, 'kelas' => 'B', 'hari' => 'Senin', 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00'], //daspro
            ['kodemk' => 'PAIK6102', 'ruang_id' => 15, 'kelas' => 'C', 'hari' => 'Rabu', 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00'], //daspro
            ['kodemk' => 'PAIK6102', 'ruang_id' => 11, 'kelas' => 'D', 'hari' => 'Jumat', 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00'], //daspro
            ['kodemk' => 'PAIK6303', 'ruang_id' => 2, 'kelas' => 'A', 'hari' => 'Selasa', 'waktu_mulai' => '07:30:00', 'waktu_selesai' => '10:50:00'], //basdat
            ['kodemk' => 'PAIK6303', 'ruang_id' => 25, 'kelas' => 'B', 'hari' => 'Senin', 'waktu_mulai' => '09:50:00', 'waktu_selesai' => '13:10:00'], //basdat
            ['kodemk' => 'PAIK6303', 'ruang_id' => 3, 'kelas' => 'C', 'hari' => 'Kamis', 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '16:20:00'], //basdat
            ['kodemk' => 'PAIK6303', 'ruang_id' => 6, 'kelas' => 'D', 'hari' => 'rabu', 'waktu_mulai' => '12:10:00', 'waktu_selesai' => '15:30:00'], //basdat
            ['kodemk' => 'PAIK6702', 'ruang_id' => 20, 'kelas' => 'A', 'hari' => 'Rabu', 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00'], //tbo
            ['kodemk' => 'PAIK6702', 'ruang_id' => 13, 'kelas' => 'B', 'hari' => 'Kamis', 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00'], //tbo
            ['kodemk' => 'PAIK6702', 'ruang_id' => 4, 'kelas' => 'C', 'hari' => 'Kamis', 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00'], //tbo
            ['kodemk' => 'PAIK6702', 'ruang_id' => 2, 'kelas' => 'D', 'hari' => 'Selasa', 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00'], //tbo


        ];

        foreach($jadwalKuliah as $jadwal){
            JadwalKuliah::create($jadwal);
        }
    }
}
