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

            

            // irs nopal 
            [
                'nim' => '24060122120018',
                'semester' => 1,
                'jenis_semester' => 'Gasal',
                'tahun_ajaran' => '2022/2023',
                'total_sks' => 19,
                'status' => 'Disetujui'
            ], 

            [
                'nim' => '24060122120018',
                'semester' => 2,
                'jenis_semester' => 'Genap',
                'tahun_ajaran' => '2022/2023',
                'total_sks' => 18,
                'status' => 'Disetujui'
            ], 

            [
                'nim' => '24060122120018',
                'semester' => 3,
                'jenis_semester' => 'Gasal',
                'tahun_ajaran' => '2023/2024',
                'total_sks' => 19,
                'status' => 'Disetujui'
            ], 

            [
                'nim' => '24060122120018',
                'semester' => 4,
                'jenis_semester' => 'Genap',
                'tahun_ajaran' => '2023/2024',
                'total_sks' => 18,
                'status' => 'Disetujui'
            ], 
        ];

        foreach($irs as $i){
            Irs::create($i);
        }
    }
}
