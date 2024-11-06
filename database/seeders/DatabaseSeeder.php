<?php

namespace Database\Seeders;

use App\Models\Kaprodi;
use App\Models\PembimbingAkademik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            DosensTableSeeder::class,
            PembimbingAkademiksTableSeeder::class,
            KaprodiTableSeeder::class,
            MahasiswasTableSeeder::class,
            MataKuliahTableSeeder::class,
            RuangTableSeeder::class,
            PengampuMataKuliahTableSeeder::class,
            JadwalKuliahTableSeeder::class,
            IrsPeriodsTableSeeder::class,
        ]);
    }
}
