<?php

namespace Database\Seeders;

use App\Models\Irs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IrsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $irs = [
            // irs farrel
            [
                'nim' => '24060122140165',
                'semester' => 1,
                'jenis_semester' => 'Gasal',
                'tahun_ajaran' => '2023/2024',
                'total_sks' => 19,
                'status' => 'Disetujui'
            ], 
            [
                'nim' => '24060122140165',
                'semester' => 2,
                'jenis_semester' => 'Genap',
                'tahun_ajaran' => '2023/2024',
                'total_sks' => 18,
                'status' => 'Disetujui'
            ], 
            [
                'nim' => '24060122140165',
                'semester' => 3,
                'jenis_semester' => 'Gasal',
                'tahun_ajaran' => '2024/2025',
                'total_sks' => 19,
                'status' => 'Belum disetujui'
            ], 
            // // irs fendi 
            // [
            //     'nim' => '24060122130077',
            //     'semester' => 1,
            //     'jenis_semester' => 'Gasal',
            //     'tahun_ajaran' => '2024/2025',
            //     'total_sks' => 19,
            //     'status' => 'Belum disetujui'
            // ], 
        ];

        foreach($irs as $i){
            Irs::create($i);
        }
    }
}
