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
            // khs fendi 
            [
                'irs_id' => 1,
            ], 

            [
                'irs_id' => 2,
            ], 

            [
                'irs_id' => 3,
            ], 

            [
                'irs_id' => 4,
            ], 

            [
                'irs_id' => 5,
            ], 
        ];

        foreach($khs as $k){
            Khs::create($k);
        }
    }
}
