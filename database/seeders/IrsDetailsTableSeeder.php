<?php

namespace Database\Seeders;

use App\Models\IrsDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IrsDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $irsDetails = [
            // id irs = 1 ( farrel smt 1 th 2023/2024 ganjil)
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6101',
                'jadwal_kuliah_id' => 1,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6102',
                'jadwal_kuliah_id' => 2,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6103',
                'jadwal_kuliah_id' => 3,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6104',
                'jadwal_kuliah_id' => 4,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6105',
                'jadwal_kuliah_id' => 5,
                'status' => 'Baru',
            ], 
            [
                'irs_id' => 1,
                'kodemk' => 'UUW00003',
                'jadwal_kuliah_id' =>6,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'UUW00005',
                'jadwal_kuliah_id' => 7,
                'status' => 'Baru',
            ],
            // id irs = 2 ( farrel smt 2 th 2023/2024 genap)
            [
                'irs_id' => 2,
                'kodemk' => 'PAIK6201',
                'jadwal_kuliah_id' => 42,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 2,
                'kodemk' => 'PAIK6202',
                'jadwal_kuliah_id' => 43,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 2,
                'kodemk' => 'PAIK6203',
                'jadwal_kuliah_id' => 44,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 2,
                'kodemk' => 'PAIK6204',
                'jadwal_kuliah_id' => 45,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 2,
                'kodemk' => 'UUW00004',
                'jadwal_kuliah_id' =>46,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 2,
                'kodemk' => 'UUW00006',
                'jadwal_kuliah_id' => 47,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 2,
                'kodemk' => 'UUW00011',
                'jadwal_kuliah_id' => 48,
                'status' => 'Baru',
            ],
            // id irs = 3 ( farrel smt 3 th 2024/2024 ganjil)
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6301',
                'jadwal_kuliah_id' => 68,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6302',
                'jadwal_kuliah_id' => 69,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6303',
                'jadwal_kuliah_id' => 70,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6304',
                'jadwal_kuliah_id' => 71,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6305',
                'jadwal_kuliah_id' => 72,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6306',
                'jadwal_kuliah_id' => 73,
                'status' => 'Baru',
            ],

        ];

        foreach($irsDetails as $irsDetail){
            IrsDetail::create($irsDetail);
        }

    }
}
