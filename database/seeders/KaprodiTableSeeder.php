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
                'user_id' => 6,
            ],
            [
                'nidn' => '0023816291', // Matematika
                'user_id' => 9,
            ],
            [
                'nidn' => '0022619940', // Biologi
                'user_id' => 10,
            ],
            [
                'nidn' => '0019027307', // Kimia
                'user_id' => 11,
            ],
            [
                'nidn' => '0002151998', // Fisika
                'user_id' => 12,
            ],
            [
                'nidn' => '0006076305', // Statistika
                'user_id' => 13,
            ],
        ];

        foreach ($kaprodis as $kaprodi) {
            Kaprodi::create($kaprodi);
        }
    }
}
