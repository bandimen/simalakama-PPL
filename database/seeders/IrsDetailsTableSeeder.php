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
          

            // id irs = 3 ( nopal smt 1 th 2022/2023 gasal)
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6101',
                'jadwal_kuliah_id' => 121,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6102',
                'jadwal_kuliah_id' => 122,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6103',
                'jadwal_kuliah_id' => 123,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6104',
                'jadwal_kuliah_id' => 124,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'PAIK6105',
                'jadwal_kuliah_id' => 125,
                'status' => 'Baru',
            ], 
            [
                'irs_id' => 3,
                'kodemk' => 'UUW00003',
                'jadwal_kuliah_id' => 126,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 3,
                'kodemk' => 'UUW00005',
                'jadwal_kuliah_id' => 127,
                'status' => 'Baru',
            ],
            // id irs = 4 ( nopal smt 2 th 2022/2023 genap)
            [
                'irs_id' => 4,
                'kodemk' => 'PAIK6201',
                'jadwal_kuliah_id' => 162,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 4,
                'kodemk' => 'PAIK6202',
                'jadwal_kuliah_id' => 163,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 4,
                'kodemk' => 'PAIK6203',
                'jadwal_kuliah_id' => 164,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 4,
                'kodemk' => 'PAIK6204',
                'jadwal_kuliah_id' => 165,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 4,
                'kodemk' => 'UUW00004',
                'jadwal_kuliah_id' => 166,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 4,
                'kodemk' => 'UUW00006',
                'jadwal_kuliah_id' => 167,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 4,
                'kodemk' => 'UUW00011',
                'jadwal_kuliah_id' => 168,
                'status' => 'Baru',
            ],
            // id irs = 5 ( nopal smt 3 th 2023/2024 gasal)
            [
                'irs_id' => 5,
                'kodemk' => 'PAIK6301',
                'jadwal_kuliah_id' => 8,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 5,
                'kodemk' => 'PAIK6302',
                'jadwal_kuliah_id' => 9,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 5,
                'kodemk' => 'PAIK6303',
                'jadwal_kuliah_id' => 10,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 5,
                'kodemk' => 'PAIK6304',
                'jadwal_kuliah_id' => 11,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 5,
                'kodemk' => 'PAIK6305',
                'jadwal_kuliah_id' => 12,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 5,
                'kodemk' => 'PAIK6306',
                'jadwal_kuliah_id' => 13,
                'status' => 'Baru',
            ],
             // id irs = 6 ( nopal smt 4 th 2023/2024 genap)
             [
                'irs_id' => 6,
                'kodemk' => 'PAIK6401',
                'jadwal_kuliah_id' => 55,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 6,
                'kodemk' => 'PAIK6402',
                'jadwal_kuliah_id' => 56,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 6,
                'kodemk' => 'PAIK6403',
                'jadwal_kuliah_id' => 57,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 6,
                'kodemk' => 'PAIK6404',
                'jadwal_kuliah_id' => 58,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 6,
                'kodemk' => 'PAIK6405',
                'jadwal_kuliah_id' => 59,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 6,
                'kodemk' => 'PAIK6406',
                'jadwal_kuliah_id' => 60,
                'status' => 'Baru',
            ],

        ];

        foreach($irsDetails as $irsDetail){
            IrsDetail::create($irsDetail);
        }

    }
}
