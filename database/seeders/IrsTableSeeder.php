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
            [
                'nim' => '24060122130077',
                'semester' => 1,
                'tahun_ajaran' => '2023/2024',
                'total_sks' => 16,
                'status' => 'belum disetujui'
            ],
        ];

        foreach($irs as $i){
            Irs::create($i);
        }
    }
}
