<?php

namespace Database\Seeders;

use App\Models\PengampuMataKuliah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengampuMataKuliahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengampuMK = [
            ['nidn' => '0123456789', 'kodemk' => 'PAIK6501'], // pbp
            ['nidn' => '0003039602', 'kodemk' => 'PAIK6501'], // pbp
            ['nidn' => '1230984756', 'kodemk' => 'PAIK6501'], // pbp
            ['nidn' => '0009038204', 'kodemk' => 'PAIK6502'], // ktp
            ['nidn' => '0627128001', 'kodemk' => 'PAIK6502'], // ktp
            ['nidn' => '0123456789', 'kodemk' => 'PAIK6502'], // ktp
            ['nidn' => '0029087303', 'kodemk' => 'PAIK6503'], // si
            ['nidn' => '0012027907', 'kodemk' => 'PAIK6503'], // si
            ['nidn' => '0001047404', 'kodemk' => 'PAIK6504'], // ppl
            ['nidn' => '0010017603', 'kodemk' => 'PAIK6504'], // ppl
            ['nidn' => '0987654321', 'kodemk' => 'PAIK6504'], // ppl
            ['nidn' => '0020048104', 'kodemk' => 'PAIK6505'], // ml
            ['nidn' => '0025118503', 'kodemk' => 'PAIK6505'], // ml
            // ['nidn' => '', 'kodemk' => 'PAIK6506'], // kji
            // ['nidn' => '', 'kodemk' => 'UUW00008'], // kwu
        ];

        foreach($pengampuMK as $pengampu){
            PengampuMataKuliah::create($pengampu);
        }
    }
}
