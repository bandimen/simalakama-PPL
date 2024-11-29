<?php

namespace Database\Seeders;

use App\Models\Khs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KhsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $khs = [
            // khs farrel dgn id irs 1, smt 1 th ajaran 2023/2024 ganjil
            [
                'irs_id' => 1,
            ], 
            // khs farrel dgn id irs 2, smt 2 th ajaran 2023/2024 genap
            [
                'irs_id' => 2,
            ], 
            // khs farrel dgn id irs 3, smt 3 th ajaran 2024/2025 ganjil
            [
                'irs_id' => 3,
            ], 

        ];

        foreach($khs as $k){
            Khs::create($k);
        }
    }
}
