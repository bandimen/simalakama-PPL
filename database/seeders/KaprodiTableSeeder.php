<?php

namespace Database\Seeders;

use App\Models\Kaprodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaprodiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kaprodis = [
            [
                'nidn' => '0011087104', // NIDN Pak Aris S
            ]
        ];

        foreach ($kaprodis as $kaprodi) {
            Kaprodi::create($kaprodi);
        }
    }
}
