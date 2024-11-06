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


        ];

        foreach ($pembimbingAkademiks as $pembimbing) {
            PembimbingAkademik::create($pembimbing);
        }
    }
}
