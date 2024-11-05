<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangs = [
            ['nama' => 'E101', 'kapasitas' => '50'],
            ['nama' => 'E102', 'kapasitas' => '50'],
            ['nama' => 'E103', 'kapasitas' => '50'],
            ['nama' => 'E201', 'kapasitas' => '50'],
            ['nama' => 'E202', 'kapasitas' => '50'],
            ['nama' => 'E203', 'kapasitas' => '50'],
            ['nama' => 'E301', 'kapasitas' => '50'],
            ['nama' => 'E302', 'kapasitas' => '50'],
            ['nama' => 'E303', 'kapasitas' => '50'],
            ['nama' => 'A101', 'kapasitas' => '50'],
            ['nama' => 'A102', 'kapasitas' => '50'],
            ['nama' => 'A103', 'kapasitas' => '50'],
            ['nama' => 'A201', 'kapasitas' => '50'],
            ['nama' => 'A202', 'kapasitas' => '50'],
            ['nama' => 'A203', 'kapasitas' => '50'],
            ['nama' => 'A301', 'kapasitas' => '50'],
            ['nama' => 'A302', 'kapasitas' => '50'],
            ['nama' => 'A303', 'kapasitas' => '50'],
            ['nama' => 'G101', 'kapasitas' => '50'],
            ['nama' => 'G102', 'kapasitas' => '50'],
            ['nama' => 'G103', 'kapasitas' => '50'],
            ['nama' => 'G201', 'kapasitas' => '50'],
            ['nama' => 'G202', 'kapasitas' => '50'],
            ['nama' => 'G203', 'kapasitas' => '50'],
            ['nama' => 'G301', 'kapasitas' => '50'],
            ['nama' => 'G302', 'kapasitas' => '50'],
            ['nama' => 'G303', 'kapasitas' => '50'],

        ];

        foreach($ruangs as $ruangData){
            Ruang::create($ruangData);
        }
    }
}
