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
            ],
            [
                'nidn' => '0011087104', // NIDN Pak Aris S
            ]
        ];

        foreach ($pembimbingAkademiks as $pembimbing) {
            PembimbingAkademik::create($pembimbing);
        }
    }
}
