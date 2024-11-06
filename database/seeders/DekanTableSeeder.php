<?php

namespace Database\Seeders;

use App\Models\Dekan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DekanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dekans = [
            [
                'nidn' => '0017037201', // NIDN Pak Kusworo Adi
            ]
        ];

        foreach ($dekans as $dekan) {
            Dekan::create($dekan);
        }
    }
}
