<?php

namespace Database\Seeders;

use App\Models\IrsPeriods;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IrsPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periods = [
            [
                'semester' => 'gasal',
                'tahun_ajaran' => '2024/2025',
                'periode_pengisian_start' => '2024-07-01 00:00:00',
                'periode_pengisian_end' => '2024-08-14 23:59:59',
                'periode_perubahan_start' => '2024-08-15 00:00:00',
                'periode_perubahan_end' => '2024-08-28 23:59:59',
                'periode_pembatalan_start' => '2024-08-29 00:00:00',
                'periode_pembatalan_end' => '2024-09-12 23:59:59',
                'periode_perkuliahan_start' => '2024-08-15 00:00:00',
                'periode_perkuliahan_end' => '2024-12-15 23:59:59',
            ],
        ];

        foreach($periods as $period){
            IrsPeriods::create($period);
        }
    }
}
