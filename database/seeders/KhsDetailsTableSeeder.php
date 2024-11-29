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
            // khs id = 1 ( farrel smt 1 th 2023/2024 ganjil)
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
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 1,
                'irs_details_id' => 5,
                'nilai' => 'A',
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
            // khs id = 2( farrel smt 2 th 2023/2024 genap)
            [
                'khs_id' => 2,
                'irs_details_id' => 8,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 2,
                'irs_details_id' => 9,
                'nilai' => 'C',
            ], 
            [
                'khs_id' => 2,
                'irs_details_id' => 10,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 2,
                'irs_details_id' => 11,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 2,
                'irs_details_id' => 12,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 2,
                'irs_details_id' => 13,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 2,
                'irs_details_id' => 14,
                'nilai' => 'A',
            ], 
            // // khs id = 3 ( farrel smt 3 th 2024/2025 ganjil)
            // [
            //     'khs_id' => 3,
            //     'irs_details_id' => 15,
            // ], 
            // [
            //     'khs_id' => 3,
            //     'irs_details_id' => 16,
            // ], 
            // [
            //     'khs_id' => 3,
            //     'irs_details_id' => 17,
            // ], 
            // [
            //     'khs_id' => 3,
            //     'irs_details_id' => 18,
            // ], 
            // [
            //     'khs_id' => 3,
            //     'irs_details_id' => 19,
            // ], 
            // [
            //     'khs_id' => 3,
            //     'irs_details_id' => 20,
            // ], 


        ];

        foreach($khsDetails as $khsDetail){
            KhsDetails::create($khsDetail);
        }
    }
}
