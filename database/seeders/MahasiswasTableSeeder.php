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
                'no_hp' => '62895640585900',
                'status' => 'Aktif',
                'foto' => 'fendi.jpg',
                'prodi_id' => 1,
                'pembimbing_akademik_id' => 1, // ID pembimbing akademik yang sesuai
                'user_id' => 1 // ID user yang sesuai
            ],
            [
                'nim' => '24060122140165',
                'nama' => 'Farrel Ardana Jati',
                'alamat' => 'Jl. Ilmu No. 2',
                'angkatan' => 2023,
                'no_hp' => '6285227715658',
                'status' => 'Aktif',
                'foto' => 'farrel.jpg',
                'prodi_id' => 1,
                'pembimbing_akademik_id' => 1, // ID pembimbing akademik yang sesuai
                'user_id' => 2 // ID user yang sesuai
            ],
            [
                'nim' => '24060122120018',
                'nama' => 'Muhammad Naufal Izzudin',
                'alamat' => 'Jl. Teknologi No. 3',
                'angkatan' => 2022,
                'no_hp' => '6287737978567',
                'status' => 'Aktif',
                'foto' => 'naufal.jpg',
                'prodi_id' => 1,
                'pembimbing_akademik_id' => 2, // ID pembimbing akademik yang sesuai
                'user_id' => 3 // ID user yang sesuai
            ],
            [
                'nim' => '24060122120026',
                'nama' => 'Tiara Putri Wibowo',
                'alamat' => 'Jl. Desain No. 4',
                'angkatan' => 2021,
                'no_hp' => '62882005710799',
                'status' => 'Aktif',
                'foto' => 'tiara.jpg',
                'prodi_id' => 1,
                'pembimbing_akademik_id' => 2, // ID pembimbing akademik yang sesuai
                'user_id' => 4 // ID user yang sesuai
            ],
            [
                'nim' => '24010120130044',
                'nama' => 'Riza Viaranti',
                'alamat' => 'Jl. Logaritma No. 2',
                'angkatan' => 2020,
                'no_hp' => '62857109283351',
                'status' => 'Aktif',
                'foto' => 'riza.jpg',
                'prodi_id' => 2,
                'pembimbing_akademik_id' => 3, // ID pembimbing akademik yang sesuai
                'user_id' => 14 // ID user yang sesuai
            ],
            [
                'nim' => '24020122120010',
                'nama' => 'Aiko Putri',
                'alamat' => 'Jl. Biologi No. 9',
                'angkatan' => 2022,
                'no_hp' => '62882003246777',
                'status' => 'Aktif',
                'foto' => 'aiko.jpg',
                'prodi_id' => 6,
                'pembimbing_akademik_id' => 7, // ID pembimbing akademik yang sesuai
                'user_id' => 15 // ID user yang sesuai
            ],
            [
                'nim' => '24030121140094',
                'nama' => 'Wardah Nabilah',
                'alamat' => 'Jl. Kimia No. 14',
                'angkatan' => 2021,
                'no_hp' => '62882005564166',
                'status' => 'Aktif',
                'foto' => 'wardah.jpg',
                'prodi_id' => 4,
                'pembimbing_akademik_id' => 5, // ID pembimbing akademik yang sesuai
                'user_id' => 16 // ID user yang sesuai
            ],
            [
                'nim' => '24040121130080',
                'nama' => 'Sabilla Ayu Maharastri',
                'alamat' => 'Jl. Desain No. 15',
                'angkatan' => 2021,
                'no_hp' => '62857407992563',
                'status' => 'Aktif',
                'foto' => 'sabilla.jpg',
                'prodi_id' => 5,
                'pembimbing_akademik_id' => 6, // ID pembimbing akademik yang sesuai
                'user_id' => 17 // ID user yang sesuai
            ],
            [
                'nim' => '24050120120150',
                'nama' => 'Wahyu Adjie',
                'alamat' => 'Jl. Kenangan No. 4',
                'angkatan' => 2021,
                'no_hp' => '62856521099555',
                'status' => 'Aktif',
                'foto' => 'wahyu.jpg',
                'prodi_id' => 3,
                'pembimbing_akademik_id' => 4, // ID pembimbing akademik yang sesuai
                'user_id' => 18 // ID user yang sesuai
            ],

        ];

        foreach ($mahasiswas as $mahasiswaData) {
            Mahasiswa::create($mahasiswaData);
        }
    }
}
