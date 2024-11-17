<?php

namespace Database\Seeders;

use App\Models\TenagaPendidik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenagaPendidikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tendiks = [
            [
                'nip' => '111222333',
                'nama' => 'Izzudin Ardianto Jatiwibowo',
                'bagian' => 'Akademik',
                'user_id' => 8,
            ]
        ];

        foreach($tendiks as $tendik){
            TenagaPendidik::create($tendik);
        }
    }
}
