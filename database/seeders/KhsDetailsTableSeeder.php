<?php

namespace Database\Seeders;

use App\Models\KhsDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KhsDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $khsDetails = [
            // khs nopal
            [
                'khs_id' => 1,
                'irs_details_id' => 1,
                'nilai' => 'A',
            ], 

            [
                'khs_id' => 1,
                'irs_details_id' => 2,
                'nilai' => 'A',
            ], 

            [
                'khs_id' => 1,
                'irs_details_id' => 3,
                'nilai' => 'A',
            ], 

            [
                'khs_id' => 1,
                'irs_details_id' => 4,
                'nilai' => 'B',
            ], 

            [
                'khs_id' => 1,
                'irs_details_id' => 5,
                'nilai' => 'C',
            ], 

            [
                'khs_id' => 1,
                'irs_details_id' => 6,
                'nilai' => 'A',
            ], 

            [
                'khs_id' => 1,
                'irs_details_id' => 7,
                'nilai' => 'B',
            ], 

            [
                'khs_id' => 1,
                'irs_details_id' => 8,
                'nilai' => 'D',
            ], 
        ];

        foreach($khsDetails as $khsDetail){
            KhsDetails::create($khsDetail);
        }
    }
}
