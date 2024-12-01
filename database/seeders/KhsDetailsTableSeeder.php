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
            // khs id = 1 ( farrel smt 1 th 2023/2024 gasal)
            [
                'khs_id' => 1,
                'irs_details_id' => 1,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 1,
                'irs_details_id' => 2,
                'nilai' => 'C',
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
            // // khs id = 3 ( farrel smt 3 th 2024/2025 gasal)
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

            // khs id = 5 ( nopal smt 1 th 2022/2023 gasal)
            [
                'khs_id' => 5,
                'irs_details_id' => 21,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 5,
                'irs_details_id' => 22,
                'nilai' => 'E',
            ], 
            [
                'khs_id' => 5,
                'irs_details_id' => 23,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 5,
                'irs_details_id' => 24,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 5,
                'irs_details_id' => 25,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 5,
                'irs_details_id' => 26,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 5,
                'irs_details_id' => 27,
                'nilai' => 'B',
            ], 
             // khs id = 6( nopal smt 2 th 2022/2023 genap)
             [
                'khs_id' => 6,
                'irs_details_id' => 28,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 6,
                'irs_details_id' => 29,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 6,
                'irs_details_id' => 30,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 6,
                'irs_details_id' => 31,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 6,
                'irs_details_id' => 32,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 6,
                'irs_details_id' => 33,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 6,
                'irs_details_id' => 34,
                'nilai' => 'A',
            ], 
            // khs id = 7 ( nopal smt 3 th 2023/2024 gasal)
            [
                'khs_id' => 7,
                'irs_details_id' => 35,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 7,
                'irs_details_id' => 36,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 7,
                'irs_details_id' => 37,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 7,
                'irs_details_id' => 38,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 7,
                'irs_details_id' => 39,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 7,
                'irs_details_id' => 40,
                'nilai' => 'A',
            ], 

            // khs id = 8 ( nopal smt 4 th 2023/2024 genap)
            [
                'khs_id' => 8,
                'irs_details_id' => 41,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 8,
                'irs_details_id' => 42,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 8,
                'irs_details_id' => 43,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 8,
                'irs_details_id' => 44,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 8,
                'irs_details_id' => 45,
                'nilai' => 'A',
            ], 
            [
                'khs_id' => 8,
                'irs_details_id' => 46,
                'nilai' => 'A',
            ], 



        ];

        foreach($khsDetails as $khsDetail){
            KhsDetails::create($khsDetail);
        }
    }
}
