<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PembimbingAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembimbingAkademiksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pembimbingAkademiks = [
            [
                'nidn' => '0001047404', // NIDN Pak Aris PW
                'user_id' => 5,
            ],
            [
                'nidn' => '0011087104', // NIDN Pak Aris S
                'user_id' => 6,
            ],
            [
                'nidn' => '0023816291', // NIDN Pak Susilo MTK
                'user_id' => 9,
            ],
            [
                'nidn' => '0010098002', // NIDN Bu Rita Rahmawati Stat
                'user_id' => 19,
            ],
            [
                'nidn' => '0019027307', // NIDN Pak Adi Darmawan Kimia
                'user_id' => 11,
            ],
            [
                'nidn' => '0070117202', // NIDN Bu Suci Fani Fisika
                'user_id' => 20,
            ],
            [
                'nidn' => '0022619940', // NIDN Pak Sapto Purnomo Bio
                'user_id' => 10,
            ],


        ];

        foreach ($pembimbingAkademiks as $pembimbing) {
            PembimbingAkademik::create($pembimbing);
        }
    }
}
