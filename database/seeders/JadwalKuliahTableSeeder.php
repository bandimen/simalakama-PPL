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
            // tahun ajaran 2023/2024 gasal
            // semester 1
            ['kodemk' => 'PAIK6101', 'ruang_id' => 1, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '08:40:00', 'status' => 'Disetujui'], //mtk 1 2 sks
            ['kodemk' => 'PAIK6102', 'ruang_id' => 2, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //daspro 4 sks
            ['kodemk' => 'PAIK6103', 'ruang_id' => 3, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //dasis
            ['kodemk' => 'PAIK6104', 'ruang_id' => 4, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //logif
            ['kodemk' => 'PAIK6105', 'ruang_id' => 5, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //strukdis
            ['kodemk' => 'UUW00003', 'ruang_id' => 6, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //pkn
            ['kodemk' => 'UUW00005', 'ruang_id' => 7, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '13:50:00', 'status' => 'Disetujui'], // olahraga 1 sks
            // semester 3
            ['kodemk' => 'PAIK6301', 'ruang_id' => 8, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //strukdat 4 sks
            ['kodemk' => 'PAIK6302', 'ruang_id' => 9, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], // so
            ['kodemk' => 'PAIK6303', 'ruang_id' => 10, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //basdat 4 sks
            ['kodemk' => 'PAIK6304', 'ruang_id' => 11, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //metnum
            ['kodemk' => 'PAIK6305', 'ruang_id' => 12, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //imk
            ['kodemk' => 'PAIK6306', 'ruang_id' => 1, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '08:40:00', 'status' => 'Disetujui'], //stat 2 sks
            // semester 5
            ['kodemk' => 'PAIK6501', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '16:20:00', 'status' => 'Disetujui'], //pbp
            ['kodemk' => 'PAIK6501', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //pbp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 18, 'kelas' => 'D', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00', 'status' => 'Disetujui'], //ktp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 18, 'kelas' => 'C', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00', 'status' => 'Disetujui'], //ktp
            ['kodemk' => 'PAIK6503', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00', 'status' => 'Disetujui'], //si
            ['kodemk' => 'PAIK6503', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //si
            ['kodemk' => 'PAIK6504', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00', 'status' => 'Disetujui'], //ppl
            ['kodemk' => 'PAIK6504', 'ruang_id' => 18, 'kelas' => 'D', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00', 'status' => 'Disetujui'], //ppl
            ['kodemk' => 'PAIK6505', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //ml
            ['kodemk' => 'PAIK6505', 'ruang_id' => 18, 'kelas' => 'C', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //ml
            ['kodemk' => 'PAIK6501', 'ruang_id' => 15, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '11:20:00', 'status' => 'Disetujui'], //pbp
            ['kodemk' => 'PAIK6501', 'ruang_id' => 7, 'kelas' => 'B', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '14:00:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], //pbp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 20, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '09:00:00', 'waktu_selesai' => '11:30:00', 'status' => 'Disetujui'], //ktp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 12, 'kelas' => 'B', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00', 'status' => 'Disetujui'], //ktp
            ['kodemk' => 'PAIK6503', 'ruang_id' => 24, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '12:30:00', 'status' => 'Disetujui'], //si
            ['kodemk' => 'PAIK6503', 'ruang_id' => 3, 'kelas' => 'B', 'hari' => 'Senin', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:00:00', 'waktu_selesai' => '17:30:00', 'status' => 'Disetujui'], //si
            ['kodemk' => 'PAIK6504', 'ruang_id' => 11, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '08:30:00', 'waktu_selesai' => '11:00:00', 'status' => 'Disetujui'], //ppl
            ['kodemk' => 'PAIK6504', 'ruang_id' => 25, 'kelas' => 'B', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00', 'status' => 'Disetujui'], //ppl
            ['kodemk' => 'PAIK6505', 'ruang_id' => 6, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //ml
            ['kodemk' => 'PAIK6505', 'ruang_id' => 19, 'kelas' => 'B', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '16:00:00', 'waktu_selesai' => '18:30:00', 'status' => 'Disetujui'], //ml
            ['kodemk' => 'PAIK6506', 'ruang_id' => 4, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '12:30:00', 'status' => 'Disetujui'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 22, 'kelas' => 'B', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00', 'status' => 'Disetujui'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 8, 'kelas' => 'C', 'hari' => 'Senin', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:30:00', 'waktu_selesai' => '10:00:00', 'status' => 'Disetujui'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 13, 'kelas' => 'D', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:00:00', 'waktu_selesai' => '17:30:00', 'status' => 'Disetujui'], //kji
            ['kodemk' => 'UUW00008', 'ruang_id' => 14, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00', 'status' => 'Disetujui'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 27, 'kelas' => 'B', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '11:40:00', 'status' => 'Disetujui'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 10, 'kelas' => 'C', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '14:00:00', 'waktu_selesai' => '15:40:00', 'status' => 'Disetujui'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 5, 'kelas' => 'D', 'hari' => 'Senin', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '09:00:00', 'waktu_selesai' => '10:40:00', 'status' => 'Disetujui'], //kwu
            // semester 7
            // belom bikin, malas


            // tahun ajaran 2023/2024 genap
            // semester 2
            ['kodemk' => 'PAIK6201', 'ruang_id' => 1, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '08:40:00', 'status' => 'Disetujui'], //mtk 2 2 sks
            ['kodemk' => 'PAIK6202', 'ruang_id' => 2, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //alpro 4 sks
            ['kodemk' => 'PAIK6203', 'ruang_id' => 3, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //oak
            ['kodemk' => 'PAIK6204', 'ruang_id' => 4, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //alin
            ['kodemk' => 'UUW00004', 'ruang_id' => 6, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //b indo
            ['kodemk' => 'UUW00006', 'ruang_id' => 7, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '14:40:00', 'status' => 'Disetujui'], //iot
            ['kodemk' => 'UUW00011', 'ruang_id' => 15, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00021', 'ruang_id' => 16, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00031', 'ruang_id' => 17, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00041', 'ruang_id' => 18, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00051', 'ruang_id' => 19, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00061', 'ruang_id' => 20, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00071', 'ruang_id' => 21, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            // semester 4
            ['kodemk' => 'PAIK6401', 'ruang_id' => 8, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //pbo 4 sks
            ['kodemk' => 'PAIK6402', 'ruang_id' => 9, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], // jarkom
            ['kodemk' => 'PAIK6403', 'ruang_id' => 10, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //mbd
            ['kodemk' => 'PAIK6404', 'ruang_id' => 11, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //gkv
            ['kodemk' => 'PAIK6405', 'ruang_id' => 12, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //rpl
            ['kodemk' => 'PAIK6406', 'ruang_id' => 13, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2023/2024', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //siscer
            // semester 6
            // belom bikin, malas
            // semester 8
            // belom bikin, malas







            // tahun ajaran 2024/2025 gasal
            // semester 1
            ['kodemk' => 'PAIK6101', 'ruang_id' => 1, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '08:40:00', 'status' => 'Disetujui'], //mtk 1 2 sks
            ['kodemk' => 'PAIK6102', 'ruang_id' => 2, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //daspro 4 sks
            ['kodemk' => 'PAIK6103', 'ruang_id' => 3, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //dasis
            ['kodemk' => 'PAIK6104', 'ruang_id' => 4, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //logif
            ['kodemk' => 'PAIK6105', 'ruang_id' => 5, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //strukdis
            ['kodemk' => 'UUW00003', 'ruang_id' => 6, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //pkn
            ['kodemk' => 'UUW00005', 'ruang_id' => 7, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '13:50:00', 'status' => 'Disetujui'], // olahraga 1 sks
            // semester 3
            ['kodemk' => 'PAIK6301', 'ruang_id' => 8, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //strukdat 4 sks
            ['kodemk' => 'PAIK6302', 'ruang_id' => 9, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], // so
            ['kodemk' => 'PAIK6303', 'ruang_id' => 10, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //basdat 4 sks
            ['kodemk' => 'PAIK6304', 'ruang_id' => 11, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //metnum
            ['kodemk' => 'PAIK6305', 'ruang_id' => 12, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //imk
            ['kodemk' => 'PAIK6306', 'ruang_id' => 1, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '08:40:00', 'status' => 'Disetujui'], //stat 2 sks
            // semester 5
            ['kodemk' => 'PAIK6501', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '16:20:00', 'status' => 'Disetujui'], //pbp
            ['kodemk' => 'PAIK6501', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //pbp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 18, 'kelas' => 'D', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00', 'status' => 'Disetujui'], //ktp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 18, 'kelas' => 'C', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00', 'status' => 'Disetujui'], //ktp
            ['kodemk' => 'PAIK6503', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00', 'status' => 'Disetujui'], //si
            ['kodemk' => 'PAIK6503', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //si
            ['kodemk' => 'PAIK6504', 'ruang_id' => 1, 'kelas' => 'C', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00', 'status' => 'Disetujui'], //ppl
            ['kodemk' => 'PAIK6504', 'ruang_id' => 18, 'kelas' => 'D', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '18:10:00', 'status' => 'Disetujui'], //ppl
            ['kodemk' => 'PAIK6505', 'ruang_id' => 1, 'kelas' => 'D', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //ml
            ['kodemk' => 'PAIK6505', 'ruang_id' => 18, 'kelas' => 'C', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //ml
            ['kodemk' => 'PAIK6501', 'ruang_id' => 15, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '11:20:00', 'status' => 'Disetujui'], //pbp
            ['kodemk' => 'PAIK6501', 'ruang_id' => 7, 'kelas' => 'B', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '14:00:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], //pbp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 20, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '09:00:00', 'waktu_selesai' => '11:30:00', 'status' => 'Disetujui'], //ktp
            ['kodemk' => 'PAIK6502', 'ruang_id' => 12, 'kelas' => 'B', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00', 'status' => 'Disetujui'], //ktp
            ['kodemk' => 'PAIK6503', 'ruang_id' => 24, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '12:30:00', 'status' => 'Disetujui'], //si
            ['kodemk' => 'PAIK6503', 'ruang_id' => 3, 'kelas' => 'B', 'hari' => 'Senin', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:00:00', 'waktu_selesai' => '17:30:00', 'status' => 'Disetujui'], //si
            ['kodemk' => 'PAIK6504', 'ruang_id' => 11, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '08:30:00', 'waktu_selesai' => '11:00:00', 'status' => 'Disetujui'], //ppl
            ['kodemk' => 'PAIK6504', 'ruang_id' => 25, 'kelas' => 'B', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00', 'status' => 'Disetujui'], //ppl
            ['kodemk' => 'PAIK6505', 'ruang_id' => 6, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //ml
            ['kodemk' => 'PAIK6505', 'ruang_id' => 19, 'kelas' => 'B', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '16:00:00', 'waktu_selesai' => '18:30:00', 'status' => 'Disetujui'], //ml
            ['kodemk' => 'PAIK6506', 'ruang_id' => 4, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '12:30:00', 'status' => 'Disetujui'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 22, 'kelas' => 'B', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '15:30:00', 'status' => 'Disetujui'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 8, 'kelas' => 'C', 'hari' => 'Senin', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:30:00', 'waktu_selesai' => '10:00:00', 'status' => 'Disetujui'], //kji
            ['kodemk' => 'PAIK6506', 'ruang_id' => 13, 'kelas' => 'D', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:00:00', 'waktu_selesai' => '17:30:00', 'status' => 'Disetujui'], //kji
            ['kodemk' => 'UUW00008', 'ruang_id' => 14, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '08:00:00', 'waktu_selesai' => '09:40:00', 'status' => 'Disetujui'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 27, 'kelas' => 'B', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '10:00:00', 'waktu_selesai' => '11:40:00', 'status' => 'Disetujui'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 10, 'kelas' => 'C', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '14:00:00', 'waktu_selesai' => '15:40:00', 'status' => 'Disetujui'], //kwu
            ['kodemk' => 'UUW00008', 'ruang_id' => 5, 'kelas' => 'D', 'hari' => 'Senin', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '09:00:00', 'waktu_selesai' => '10:40:00', 'status' => 'Disetujui'], //kwu
            // semester 7
            // belom bikin, malas


            // tahun ajaran 2024/2025 genap
            // semester 2
            ['kodemk' => 'PAIK6201', 'ruang_id' => 1, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '08:40:00', 'status' => 'Disetujui'], //mtk 2 2 sks
            ['kodemk' => 'PAIK6202', 'ruang_id' => 2, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //alpro 4 sks
            ['kodemk' => 'PAIK6203', 'ruang_id' => 3, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //oak
            ['kodemk' => 'PAIK6204', 'ruang_id' => 4, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //alin
            ['kodemk' => 'UUW00004', 'ruang_id' => 6, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //b indo
            ['kodemk' => 'UUW00006', 'ruang_id' => 7, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '13:00:00', 'waktu_selesai' => '14:40:00', 'status' => 'Disetujui'], //iot
            ['kodemk' => 'UUW00011', 'ruang_id' => 15, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00021', 'ruang_id' => 16, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00031', 'ruang_id' => 17, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00041', 'ruang_id' => 18, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00051', 'ruang_id' => 19, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00061', 'ruang_id' => 20, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            ['kodemk' => 'UUW00071', 'ruang_id' => 21, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '15:40:00', 'waktu_selesai' => '17:20:00', 'status' => 'Disetujui'], // agama
            // semester 4
            ['kodemk' => 'PAIK6401', 'ruang_id' => 8, 'kelas' => 'A', 'hari' => 'Selasa', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '10:20:00', 'status' => 'Disetujui'], //pbo 4 sks
            ['kodemk' => 'PAIK6402', 'ruang_id' => 9, 'kelas' => 'A', 'hari' => 'Kamis', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], // jarkom
            ['kodemk' => 'PAIK6403', 'ruang_id' => 10, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //mbd
            ['kodemk' => 'PAIK6404', 'ruang_id' => 11, 'kelas' => 'A', 'hari' => 'Rabu', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '09:40:00', 'waktu_selesai' => '12:10:00', 'status' => 'Disetujui'], //gkv
            ['kodemk' => 'PAIK6405', 'ruang_id' => 12, 'kelas' => 'A', 'hari' => 'Senin', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //rpl
            ['kodemk' => 'PAIK6406', 'ruang_id' => 13, 'kelas' => 'A', 'hari' => 'Jumat', 'tahun_ajaran' => '2024/2025', 'kuota_kelas' => 30, 'waktu_mulai' => '07:00:00', 'waktu_selesai' => '09:30:00', 'status' => 'Disetujui'], //siscer
            // semester 6
            // belom bikin, malas
            // semester 8
            // belom bikin, malas
        ];

        foreach($jadwalKuliah as $jadwal){
            JadwalKuliah::create($jadwal);
        }
    }
}
