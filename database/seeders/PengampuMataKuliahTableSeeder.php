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
            // tahun ajran 2023/2024
            // semester 1
            ['nidn' => '0023116505', 'kodemk' => 'PAIK6101'], // mtk 1
            ['nidn' => '0030068502', 'kodemk' => 'PAIK6101'], // mtk 1
            ['nidn' => '0009038204', 'kodemk' => 'PAIK6102'], // daspro
            ['nidn' => '0003038907', 'kodemk' => 'PAIK6102'], // daspro
            ['nidn' => '0025118503', 'kodemk' => 'PAIK6103'], // dasis
            ['nidn' => '0020068108', 'kodemk' => 'PAIK6103'], // dasis
            ['nidn' => '0011087104', 'kodemk' => 'PAIK6104'], // logif
            ['nidn' => '0024057906', 'kodemk' => 'PAIK6104'], // logif
            ['nidn' => '0020077902', 'kodemk' => 'PAIK6105'], // strukdis
            ['nidn' => '0011087104', 'kodemk' => 'PAIK6105'], // strukdis
            ['nidn' => '0987654321', 'kodemk' => 'UUW00003'], // or
            ['nidn' => '0987654321', 'kodemk' => 'UUW00005'], // pkn

            // semester 2
            ['nidn' => '0030068502', 'kodemk' => 'PAIK6201'], // mtk 2
            ['nidn' => '0020127304', 'kodemk' => 'PAIK6201'], // mtk 2
            ['nidn' => '0001047404', 'kodemk' => 'PAIK6202'], // alpro
            ['nidn' => '0007116503', 'kodemk' => 'PAIK6202'], // alpro
            ['nidn' => '0025118503', 'kodemk' => 'PAIK6203'], // oak
            ['nidn' => '0020068108', 'kodemk' => 'PAIK6203'], // oak
            ['nidn' => '0020048104', 'kodemk' => 'PAIK6204'], // alin
            ['nidn' => '0005077005', 'kodemk' => 'PAIK6204'], // alin
            ['nidn' => '0627128001', 'kodemk' => 'UUW00004'], // b indo
            ['nidn' => '0627128001', 'kodemk' => 'UUW00006'], // iot
            ['nidn' => '0627128001', 'kodemk' => 'UUW00011'], // pai

            // semester 3
            ['nidn' => '0003039602', 'kodemk' => 'PAIK6301'], // strukdat
            ['nidn' => '0014098003', 'kodemk' => 'PAIK6301'], // strukdat
            ['nidn' => '0627128001', 'kodemk' => 'PAIK6302'], // so
            ['nidn' => '0029087303', 'kodemk' => 'PAIK6303'], // basdat
            ['nidn' => '0003028301', 'kodemk' => 'PAIK6303'], // basdat
            ['nidn' => '0005077005', 'kodemk' => 'PAIK6304'], // metnum
            ['nidn' => '0012027907', 'kodemk' => 'PAIK6304'], // metnum
            ['nidn' => '1029384756', 'kodemk' => 'PAIK6304'], // metnum
            ['nidn' => '0007116503', 'kodemk' => 'PAIK6305'], // imk
            ['nidn' => '0010017603', 'kodemk' => 'PAIK6305'], // imk
            ['nidn' => '0192837465', 'kodemk' => 'PAIK6306'], // stat

            // semester 4
            ['nidn' => '0003038907', 'kodemk' => 'PAIK6401'], // pbo
            ['nidn' => '0014098003', 'kodemk' => 'PAIK6401'], // pbo
            ['nidn' => '0024057906', 'kodemk' => 'PAIK6401'], // jarkom
            ['nidn' => '0627128001', 'kodemk' => 'PAIK6401'], // jarkom
            ['nidn' => '0011087104', 'kodemk' => 'PAIK6401'], // jarkom
            ['nidn' => '0622038802', 'kodemk' => 'PAIK6401'], // jarkom
            ['nidn' => '0029087303', 'kodemk' => 'PAIK6403'], // mbd
            ['nidn' => '0014098003', 'kodemk' => 'PAIK6403'], // mbd
            ['nidn' => '0011087104', 'kodemk' => 'PAIK6404'], // gkv
            ['nidn' => '0016057801', 'kodemk' => 'PAIK6404'], // gkv
            ['nidn' => '0003028301', 'kodemk' => 'PAIK6405'], // rpl
            ['nidn' => '0001047404', 'kodemk' => 'PAIK6405'], // rpl
            ['nidn' => '0016057801', 'kodemk' => 'PAIK6406'], // siscer
            ['nidn' => '0003039602', 'kodemk' => 'PAIK6406'], // siscer

            // semester 5
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
            ['nidn' => '0622038802', 'kodemk' => 'PAIK6506'], // kji
            ['nidn' => '0987654321', 'kodemk' => 'PAIK6506'], // kji
            ['nidn' => '0020077902', 'kodemk' => 'PAIK6506'], // kji
            ['nidn' => '0001047404', 'kodemk' => 'UUW00008'], // kwu
            ['nidn' => '0622038802', 'kodemk' => 'UUW00008'], // kwu
            ['nidn' => '0003028301', 'kodemk' => 'UUW00008'], // kwu

            //Matematika
            ['nidn' => '0020127304', 'kodemk'=> 'MAT402'],
            ['nidn' => '0021127805', 'kodemk'=> 'MAT401'],
            ['nidn' => '0013046907', 'kodemk'=> 'MAT503'],
            ['nidn' => '0015068501', 'kodemk'=> 'MAT301'],
            ['nidn' => '0022067403', 'kodemk'=> 'MAT501'],
            ['nidn' => '0019016208', 'kodemk'=> 'MAT602'],
            ['nidn' => '0023108109', 'kodemk'=> 'MAT303'],
            ['nidn' => '0018085602', 'kodemk'=> 'MAT603'],

            //Statistika
            ['nidn' => '0030079301', 'kodemk'=> 'PAS210P'],
            ['nidn' => '0025026503', 'kodemk'=> 'PAS308P'],
            ['nidn' => '0008107504', 'kodemk'=> 'PAS232P'],
            ['nidn' => '0721059102', 'kodemk'=> 'PAS210P'],
            ['nidn' => '0019107606', 'kodemk'=> 'PAS403'],
            ['nidn' => '0010098002', 'kodemk'=> 'PAS243P'],
            ['nidn' => '0017087803', 'kodemk'=> 'PAS409'],
            ['nidn' => '0006076305', 'kodemk'=> 'PAS217'],

            //Kimia
            ['nidn' => '0021048001', 'kodemk'=> 'KIM401'],
            ['nidn' => '0009029404', 'kodemk'=> 'KIM402'],
            ['nidn' => '0019027307', 'kodemk'=> 'KIM603'],
            ['nidn' => '0022089104', 'kodemk'=> 'KIM503'],
            ['nidn' => '0013056502', 'kodemk'=> 'KIM802'],
            ['nidn' => '0027038205', 'kodemk'=> 'KIM602'],
            ['nidn' => '0014077609', 'kodemk'=> 'KIM203'],
            ['nidn' => '0025127408', 'kodemk'=> 'KIM101'],

            //Fisika
            ['nidn' => '0085031002', 'kodemk'=> 'PAFS6311'],
            ['nidn' => '0008803201', 'kodemk'=> 'PAFS6324'],
            ['nidn' => '0090011001', 'kodemk'=> 'PAFS6361'],
            ['nidn' => '0002151998', 'kodemk'=> 'UUW00007'],
            ['nidn' => '0002031003', 'kodemk'=> 'PAFS6324'],
            ['nidn' => '0006405181', 'kodemk'=> 'UUW00006'],
            ['nidn' => '0070117202', 'kodemk'=> 'PAFS6346'],
            ['nidn' => '0001229199', 'kodemk'=> 'PAFS6352'],

            //Biologi
            ['nidn' => '0022619940', 'kodemk'=> 'PABL6403'], //Biostatistika
            ['nidn' => '0023016704', 'kodemk'=> 'LABL6406'], //Biodiversitas Hewan
            ['nidn' => '0020096107', 'kodemk'=> 'PABL6402'], //Ilmu Lingkungan
            ['nidn' => '0042319870', 'kodemk'=> 'PABL6401'], //Genetika
            ['nidn' => '0018066803', 'kodemk'=> 'PABL6306'], //Biodiversitas Tumbuhan
            ['nidn' => '0005066305', 'kodemk'=> 'LABL6304'], //Mikrobiologi
            ['nidn' => '0005056110', 'kodemk'=> 'PABL6603'], //Biologi Laut
            ['nidn' => '0026115902', 'kodemk'=> 'LABL6204'], //Biokimia
        ];

        foreach($pengampuMK as $pengampu){
            PengampuMataKuliah::create($pengampu);
        }
    }
}
