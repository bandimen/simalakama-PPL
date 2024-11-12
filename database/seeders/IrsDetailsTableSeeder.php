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
            // id irs = 1
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6501',
                'jadwal_kuliah_id' => 1,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6502',
                'jadwal_kuliah_id' => 3,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6503',
                'jadwal_kuliah_id' => 5,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6504',
                'jadwal_kuliah_id' => 7,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6505',
                'jadwal_kuliah_id' => 9,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6102',
                'jadwal_kuliah_id' => 31,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6303',
                'jadwal_kuliah_id' => 35,
                'status' => 'Baru',
            ],
            [
                'irs_id' => 1,
                'kodemk' => 'PAIK6702',
                'jadwal_kuliah_id' =>39,
                'status' => 'Baru',
            ],
        ];

        foreach($irsDetails as $irsDetail){
            IrsDetail::create($irsDetail);
        }

    }
}
