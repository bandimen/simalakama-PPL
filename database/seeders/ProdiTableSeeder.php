<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodis = [
            [
                'nama' => 'Informatika'
            ],
            [
                'nama' => 'Matematika'
            ],
            [
                'nama' => 'Statistika'
            ],
            [
                'nama' => 'Kimia'
            ],
            [
                'nama' => 'Fisika'
            ],
            [
                'nama' => 'Biologi'
            ],
            [
                'nama' => 'Bioteknologi'
            ],
        ];

        foreach($prodis as $prodi){
            Prodi::create($prodi);
        }
    }
}
