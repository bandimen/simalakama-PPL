<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Kaprodi;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PembimbingAkademik;
use Database\Seeders\IrsTableSeeder;
use Database\Seeders\KhsTableSeeder;
use Database\Seeders\DekanTableSeeder;
use Database\Seeders\ProdiTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\RuangTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\DosensTableSeeder;
use Database\Seeders\KaprodiTableSeeder;
use Database\Seeders\IrsDetailsTableSeeder;
use Database\Seeders\IrsPeriodsTableSeeder;
use Database\Seeders\KhsDetailsTableSeeder;
use Database\Seeders\MahasiswasTableSeeder;
use Database\Seeders\MataKuliahTableSeeder;
use Database\Seeders\JadwalKuliahTableSeeder;
use Database\Seeders\TenagaPendidikTableSeeder;
use Database\Seeders\PengampuMataKuliahTableSeeder;
use Database\Seeders\PembimbingAkademiksTableSeeder;

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
            ProdiTableSeeder::class,
            DosensTableSeeder::class,
            PembimbingAkademiksTableSeeder::class,
            TenagaPendidikTableSeeder::class,
            KaprodiTableSeeder::class,
            MahasiswasTableSeeder::class,
            MataKuliahTableSeeder::class,
            RuangTableSeeder::class,
            PengampuMataKuliahTableSeeder::class,
            JadwalKuliahTableSeeder::class,
            IrsPeriodsTableSeeder::class,
            DekanTableSeeder::class,
            IrsTableSeeder::class,
            IrsDetailsTableSeeder::class,
            KhsTableSeeder::class,
            KhsDetailsTableSeeder::class,
        ]);
    }
}
