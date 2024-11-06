<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MahasiswasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $mahasiswas = [
            [
                'nim' => '24060122130077',
                'nama' => 'Fendi Ardianto',
                'alamat' => 'Jl. Pendidikan No. 1',
                'angkatan' => 2024,
                'no_hp' => '081234567890',
                'status' => 'aktif',
                'foto' => 'fendi.jpg',
                'pembimbing_akademik_id' => 1, // ID pembimbing akademik yang sesuai
                'user_id' => 1 // ID user yang sesuai
            ],
            [
                'nim' => '24060122140165',
                'nama' => 'Farrel Ardana Jati',
                'alamat' => 'Jl. Ilmu No. 2',
                'angkatan' => 2023,
                'no_hp' => '081234567891',
                'status' => 'aktif',
                'foto' => 'farrel.jpg',
                'pembimbing_akademik_id' => 1, // ID pembimbing akademik yang sesuai
                'user_id' => 2 // ID user yang sesuai
            ],
            [
                'nim' => '24060122120018',
                'nama' => 'Muhammad Naufal Izzudin',
                'alamat' => 'Jl. Teknologi No. 3',
                'angkatan' => 2022,
                'no_hp' => '081234567892',
                'status' => 'aktif',
                'foto' => 'naufal.jpg',
                'pembimbing_akademik_id' => 2, // ID pembimbing akademik yang sesuai
                'user_id' => 3 // ID user yang sesuai
            ],
            [
                'nim' => '24060122120026',
                'nama' => 'Tiara Putri Wibowo',
                'alamat' => 'Jl. Desain No. 4',
                'angkatan' => 2021,
                'no_hp' => '081234567893',
                'status' => 'aktif',
                'foto' => 'tiara.jpg',
                'pembimbing_akademik_id' => 2, // ID pembimbing akademik yang sesuai
                'user_id' => 4 // ID user yang sesuai
            ]
        ];

        foreach ($mahasiswas as $mahasiswaData) {
            Mahasiswa::create($mahasiswaData);
        }
    }
}
