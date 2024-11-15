<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $dosenData = [
            ['nidn' => '0023116505', 'nama' => 'Prof. Dr. Dra. Sunarsih, M.Si.', 'alamat' => 'Jl. Dummy No. 1', 'foto' => 'dummy1.jpg'],
            ['nidn' => '0009038204', 'nama' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 2', 'foto' => 'dummy2.jpg'],
            ['nidn' => '0010017603', 'nama' => 'Dinar Mutiara Kusumo Nugraheni, S.T., M.InfoTech.(Comp)., Ph.D.', 'alamat' => 'Jl. Dummy No. 3', 'foto' => 'dummy3.jpg'],
            ['nidn' => '0001047404', 'nama' => 'Dr. Aris Puji Widodo, S.Si., M.T.', 'alamat' => 'Jl. Dummy No. 4', 'foto' => 'dummy4.jpg'],
            ['nidn' => '0011087104', 'nama' => 'Dr. Aris Sugiharto, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 5', 'foto' => 'dummy5.jpg'],
            ['nidn' => '0020048104', 'nama' => 'Dr. Retno Kusumaningrum, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 6', 'foto' => 'dummy6.jpg'],
            ['nidn' => '0024057906', 'nama' => 'Dr. Sutikno, S.T., M.Cs.', 'alamat' => 'Jl. Dummy No. 7', 'foto' => 'dummy7.jpg'],
            ['nidn' => '0007116503', 'nama' => 'Drs. Eko Adi Sarwoko, M.Komp.', 'alamat' => 'Jl. Dummy No. 8', 'foto' => 'dummy8.jpg'],
            ['nidn' => '0005077005', 'nama' => 'Priyo Sidik Sasongko, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 9', 'foto' => 'dummy9.jpg'],
            ['nidn' => '0029087303', 'nama' => 'Beta Noranita, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 10', 'foto' => 'dummy10.jpg'],
            ['nidn' => '0014098003', 'nama' => 'Edy Suharto, S.T., M.Kom.', 'alamat' => 'Jl. Dummy No. 11', 'foto' => 'dummy11.jpg'],
            ['nidn' => '0627128001', 'nama' => 'Guruh Aryotejo, S.Kom., M.Sc.', 'alamat' => 'Jl. Dummy No. 12', 'foto' => 'dummy12.jpg'],
            ['nidn' => '0016057801', 'nama' => 'Dr. Helmie Arif Wibawa, S.Si., M.Cs.', 'alamat' => 'Jl. Dummy No. 13', 'foto' => 'dummy13.jpg'],
            ['nidn' => '0611048402', 'nama' => 'Fajar Agung Nugroho, S.Kom., M.Cs.', 'alamat' => 'Jl. Dummy No. 14', 'foto' => 'dummy14.jpg'],
            ['nidn' => '0012027907', 'nama' => 'Dr. Indra Waspada, S.T., M.TI.', 'alamat' => 'Jl. Dummy No. 15', 'foto' => 'dummy15.jpg'],
            ['nidn' => '0003038907', 'nama' => 'Khadijah, S.Kom., M.Cs.', 'alamat' => 'Jl. Dummy No. 16', 'foto' => 'dummy16.jpg'],
            ['nidn' => '0020068108', 'nama' => 'Muhammad Malik Hakim, S.T., M.T.I.', 'alamat' => 'Jl. Dummy No. 17', 'foto' => 'dummy17.jpg'],
            ['nidn' => '0622038802', 'nama' => 'Prajanto Wahyu Adi, M.Kom.', 'alamat' => 'Jl. Dummy No. 18', 'foto' => 'dummy18.jpg'],
            ['nidn' => '0025118503', 'nama' => 'Rismiyati, B.Eng, M.Cs.', 'alamat' => 'Jl. Dummy No. 19', 'foto' => 'dummy19.jpg'],
            ['nidn' => '0003028301', 'nama' => 'Satriyo Adhy, S.Si., M.T.', 'alamat' => 'Jl. Dummy No. 20', 'foto' => 'dummy20.jpg'],
            ['nidn' => '0030068502', 'nama' => 'Solikhin, S.Si., M.Sc.', 'alamat' => 'Jl. Dummy No. 21', 'foto' => 'dummy21.jpg'],
            ['nidn' => '0002057811', 'nama' => 'Sukmawati Nur Endah, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 22', 'foto' => 'dummy22.jpg'],
            ['nidn' => '0123456789', 'nama' => 'Adhe Setya Pramayoga, M.T.', 'alamat' => 'Jl. Dummy No. 23', 'foto' => 'dummy23.jpg'],
            ['nidn' => '0003039602', 'nama' => 'Sandy Kurniawan, S.Kom., M.Kom.', 'alamat' => 'Jl. Dummy No. 24', 'foto' => 'dummy24.jpg'],
            ['nidn' => '0987654321', 'nama' => 'Yunila Dwi Putri Ariyanti, S.Kom., M.Kom.', 'alamat' => 'Jl. Dummy No. 25', 'foto' => 'dummy25.jpg'],
            ['nidn' => '0192837465', 'nama' => 'Dr. Yeva Fadhilah Ashari, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 26', 'foto' => 'dummy26.jpg'],
            ['nidn' => '1029384756', 'nama' => 'Etna Vianita, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 27', 'foto' => 'dummy27.jpg'],
            ['nidn' => '0981237645', 'nama' => 'Dhena Kamalia Fu\'adi, S.Kom., M.Kom.', 'alamat' => 'Jl. Dummy No. 28', 'foto' => 'dummy28.jpg'],
            ['nidn' => '1230984756', 'nama' => 'Henri Tantyoko, S.Kom., M.Kom.', 'alamat' => 'Jl. Dummy No. 29', 'foto' => 'dummy29.jpg'],
            ['nidn' => '1100229876', 'nama' => 'Satriawan Rasyid Purnama, S.Kom., M.Cs.', 'alamat' => 'Jl. Dummy No. 30', 'foto' => 'dummy30.jpg'],
            ['nidn' => '0017037201', 'nama' => 'Prof. Dr. Kusworo Adi, S.Si., M.T.', 'alamat' => 'Jl. Dummy No. 31', 'foto' => 'dummy31.jpg']
        ];

        foreach($dosenData as $dosen){
            Dosen::create($dosen);
        }
    }
}
