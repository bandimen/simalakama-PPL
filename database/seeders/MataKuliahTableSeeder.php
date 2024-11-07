<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataKuliahs = [
            ['kodemk' => 'PAIK6101', 'nama' => 'Matematika I', 'semester' => 1, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6102', 'nama' => 'Dasar Pemrograman', 'semester' => 1, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6103', 'nama' => 'Dasar Sistem', 'semester' => 1, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6104', 'nama' => 'Logika Informatika', 'semester' => 1, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6105', 'nama' => 'Struktur Diskrit', 'semester' => 1, 'sks' => 4, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00003', 'nama' => 'Pancasila dan Kewarganegaraan', 'semester' => 1, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00005', 'nama' => 'Olahraga', 'semester' => 1, 'sks' => 1, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00007', 'nama' => 'Bahasa Inggris', 'semester' => 1, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6201', 'nama' => 'Matematika II', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6202', 'nama' => 'Algoritma dan Pemrograman', 'semester' => 2, 'sks' => 4, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6203', 'nama' => 'Organisasi dan Arsitektur Komputer', 'semester' => 2, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6204', 'nama' => 'Aljabar Linier', 'semester' => 2, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00004', 'nama' => 'Bahasa Indonesia', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00006', 'nama' => 'Internet of Things (IoT)', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00011', 'nama' => 'Pendidikan Agama Islam', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00021', 'nama' => 'Pendidikan Agama Kristen', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00031', 'nama' => 'Pendidikan Agama Katolik', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00041', 'nama' => 'Pendidikan Agama Hindu', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00051', 'nama' => 'Pendidikan Agama Buddha', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00061', 'nama' => 'Pendidikan Agama Kong Hu Chu', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00071', 'nama' => 'Aliran Kepercayaan terhadap Tuhan Yang Maha Esa', 'semester' => 2, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6301', 'nama' => 'Struktur Data', 'semester' => 3, 'sks' => 4, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6302', 'nama' => 'Sistem Operasi', 'semester' => 3, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6303', 'nama' => 'Basis Data', 'semester' => 3, 'sks' => 4, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6304', 'nama' => 'Metode Numerik', 'semester' => 3, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6305', 'nama' => 'Interaksi Manusia dan Komputer', 'semester' => 3, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6306', 'nama' => 'Statistika', 'semester' => 3, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6401', 'nama' => 'Pemrograman Berorientasi Objek', 'semester' => 4, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6402', 'nama' => 'Jaringan Komputer', 'semester' => 4, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6403', 'nama' => 'Manajemen Basis Data', 'semester' => 4, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6404', 'nama' => 'Grafika dan Komputasi Visual', 'semester' => 4, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6405', 'nama' => 'Rekayasa Perangkat Lunak', 'semester' => 4, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6406', 'nama' => 'Sistem Cerdas', 'semester' => 4, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6501', 'nama' => 'Pengembangan Berbasis Platform', 'semester' => 5, 'sks' => 4, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6502', 'nama' => 'Komputasi Tersebar dan Paralel', 'semester' => 5, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6503', 'nama' => 'Sistem Informasi', 'semester' => 5, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6504', 'nama' => 'Proyek Perangkat Lunak', 'semester' => 5, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6505', 'nama' => 'Pembelajaran Mesin', 'semester' => 5, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6506', 'nama' => 'Keamanan dan Jaminan Informasi', 'semester' => 5, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00008', 'nama' => 'Kewirausahaan', 'semester' => 5, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6601', 'nama' => 'Analisis dan Strategi Algoritma', 'semester' => 6, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6602', 'nama' => 'Uji Perangkat Lunak', 'semester' => 6, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6603', 'nama' => 'Masyarakat dan Etika Profesi', 'semester' => 6, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6604', 'nama' => 'Praktik Kerja Lapangan', 'semester' => 0, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6605', 'nama' => 'Manajemen Proyek', 'semester' => 6, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6701', 'nama' => 'Metodologi Penelitian dan Penulisan Ilmiah', 'semester' => 0, 'sks' => 2, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6702', 'nama' => 'Teori Bahasa dan Otomata', 'semester' => 7, 'sks' => 3, 'sifat' => 'Wajib'],
            ['kodemk' => 'PAIK6703', 'nama' => 'Metode Perangkat Lunak', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6704', 'nama' => 'Kualitas Perangkat Lunak', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6705', 'nama' => 'Pemodelan dan Simulasi', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6706', 'nama' => 'Visi Komputer', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6707', 'nama' => 'Audit Sistem Informasi', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6708', 'nama' => 'Penambangan Data', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6709', 'nama' => 'Sistem Tertanam', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6710', 'nama' => 'Algoritma Evolusioner', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6711', 'nama' => 'Komputasi Lunak', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6712', 'nama' => 'Temu Balik Informasi', 'semester' => 7, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6801', 'nama' => 'Topik Khusus RPL & STI', 'semester' => 0, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6802', 'nama' => 'Topik Khusus SC & KG', 'semester' => 0, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6803', 'nama' => 'Evolusi Perangkat Lunak', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6804', 'nama' => 'Rekayasa Sistem', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6805', 'nama' => 'Komputasi Awan', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6806', 'nama' => 'Arsitektur Perangkat Lunak', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6807', 'nama' => 'Pemrograman Lanjut', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6808', 'nama' => 'Pengenalan Pola', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6809', 'nama' => 'Kriptografi', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6810', 'nama' => 'Bioinformatika', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6811', 'nama' => 'Keamanan Siber', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6812', 'nama' => 'Pemrosesan Citra Medis', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6813', 'nama' => 'Data Besar', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6814', 'nama' => 'Intelijen Bisnis', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6815', 'nama' => 'Pemodelan Informasi', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6816', 'nama' => 'Sistem Enterprise', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6817', 'nama' => 'Robotika', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6818', 'nama' => 'Pengolahan Bahasa Alami', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6819', 'nama' => 'Analisis Jaringan Sosial', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6820', 'nama' => 'Sains Data', 'semester' => 8, 'sks' => 3, 'sifat' => 'Pilihan'],
            ['kodemk' => 'PAIK6821', 'nama' => 'Tugas Akhir', 'semester' => 0, 'sks' => 6, 'sifat' => 'Wajib'],
            ['kodemk' => 'UUW00009', 'nama' => 'Kuliah Kerja Nyata (KKN)', 'semester' => 0, 'sks' => 3, 'sifat' => 'Wajib']        
        ];

        foreach($mataKuliahs as $mataKuliah){
            MataKuliah::create($mataKuliah);
        }
    }
}
