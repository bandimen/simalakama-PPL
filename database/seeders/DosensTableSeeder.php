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
            ['nidn' => '0023116505', 'nama' => 'Prof. Dr. Dra. Sunarsih, M.Si.', 'alamat' => 'Jl. Dummy No. 1', 'foto' => 'dummy1.jpg', 'prodi_id' => 1],
            ['nidn' => '0009038204', 'nama' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 2', 'foto' => 'dummy2.jpg', 'prodi_id' => 1],
            ['nidn' => '0010017603', 'nama' => 'Dinar Mutiara Kusumo Nugraheni, S.T., M.InfoTech.(Comp)., Ph.D.', 'alamat' => 'Jl. Dummy No. 3', 'foto' => 'dummy3.jpg', 'prodi_id' => 1],
            ['nidn' => '0001047404', 'nama' => 'Dr. Aris Puji Widodo, S.Si., M.T.', 'alamat' => 'Jl. Dummy No. 4', 'foto' => 'dummy4.jpg', 'prodi_id' => 1],
            ['nidn' => '0011087104', 'nama' => 'Dr. Aris Sugiharto, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 5', 'foto' => 'dummy5.jpg', 'prodi_id' => 1],
            ['nidn' => '0020048104', 'nama' => 'Dr. Retno Kusumaningrum, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 6', 'foto' => 'dummy6.jpg', 'prodi_id' => 1],
            ['nidn' => '0024057906', 'nama' => 'Dr. Sutikno, S.T., M.Cs.', 'alamat' => 'Jl. Dummy No. 7', 'foto' => 'dummy7.jpg', 'prodi_id' => 1],
            ['nidn' => '0007116503', 'nama' => 'Drs. Eko Adi Sarwoko, M.Komp.', 'alamat' => 'Jl. Dummy No. 8', 'foto' => 'dummy8.jpg', 'prodi_id' => 1],
            ['nidn' => '0005077005', 'nama' => 'Priyo Sidik Sasongko, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 9', 'foto' => 'dummy9.jpg', 'prodi_id' => 1],
            ['nidn' => '0029087303', 'nama' => 'Beta Noranita, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 10', 'foto' => 'dummy10.jpg', 'prodi_id' => 1],
            ['nidn' => '0014098003', 'nama' => 'Edy Suharto, S.T., M.Kom.', 'alamat' => 'Jl. Dummy No. 11', 'foto' => 'dummy11.jpg', 'prodi_id' => 1],
            ['nidn' => '0627128001', 'nama' => 'Guruh Aryotejo, S.Kom., M.Sc.', 'alamat' => 'Jl. Dummy No. 12', 'foto' => 'dummy12.jpg', 'prodi_id' => 1],
            ['nidn' => '0016057801', 'nama' => 'Dr. Helmie Arif Wibawa, S.Si., M.Cs.', 'alamat' => 'Jl. Dummy No. 13', 'foto' => 'dummy13.jpg', 'prodi_id' => 1],
            ['nidn' => '0611048402', 'nama' => 'Fajar Agung Nugroho, S.Kom., M.Cs.', 'alamat' => 'Jl. Dummy No. 14', 'foto' => 'dummy14.jpg', 'prodi_id' => 1],
            ['nidn' => '0012027907', 'nama' => 'Dr. Indra Waspada, S.T., M.TI.', 'alamat' => 'Jl. Dummy No. 15', 'foto' => 'dummy15.jpg', 'prodi_id' => 1],
            ['nidn' => '0003038907', 'nama' => 'Khadijah, S.Kom., M.Cs.', 'alamat' => 'Jl. Dummy No. 16', 'foto' => 'dummy16.jpg', 'prodi_id' => 1],
            ['nidn' => '0020068108', 'nama' => 'Muhammad Malik Hakim, S.T., M.T.I.', 'alamat' => 'Jl. Dummy No. 17', 'foto' => 'dummy17.jpg', 'prodi_id' => 1],
            ['nidn' => '0622038802', 'nama' => 'Prajanto Wahyu Adi, M.Kom.', 'alamat' => 'Jl. Dummy No. 18', 'foto' => 'dummy18.jpg', 'prodi_id' => 1],
            ['nidn' => '0025118503', 'nama' => 'Rismiyati, B.Eng, M.Cs.', 'alamat' => 'Jl. Dummy No. 19', 'foto' => 'dummy19.jpg', 'prodi_id' => 1],
            ['nidn' => '0003028301', 'nama' => 'Satriyo Adhy, S.Si., M.T.', 'alamat' => 'Jl. Dummy No. 20', 'foto' => 'dummy20.jpg', 'prodi_id' => 1],
            ['nidn' => '0030068502', 'nama' => 'Solikhin, S.Si., M.Sc.', 'alamat' => 'Jl. Dummy No. 21', 'foto' => 'dummy21.jpg', 'prodi_id' => 1],
            ['nidn' => '0002057811', 'nama' => 'Sukmawati Nur Endah, S.Si., M.Kom.', 'alamat' => 'Jl. Dummy No. 22', 'foto' => 'dummy22.jpg', 'prodi_id' => 1],
            ['nidn' => '0123456789', 'nama' => 'Adhe Setya Pramayoga, M.T.', 'alamat' => 'Jl. Dummy No. 23', 'foto' => 'dummy23.jpg', 'prodi_id' => 1],
            ['nidn' => '0003039602', 'nama' => 'Sandy Kurniawan, S.Kom., M.Kom.', 'alamat' => 'Jl. Dummy No. 24', 'foto' => 'dummy24.jpg', 'prodi_id' => 1],
            ['nidn' => '0987654321', 'nama' => 'Yunila Dwi Putri Ariyanti, S.Kom., M.Kom.', 'alamat' => 'Jl. Dummy No. 25', 'foto' => 'dummy25.jpg', 'prodi_id' => 1],
            ['nidn' => '0192837465', 'nama' => 'Dr. Yeva Fadhilah Ashari, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 26', 'foto' => 'dummy26.jpg', 'prodi_id' => 1],
            ['nidn' => '1029384756', 'nama' => 'Etna Vianita, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 27', 'foto' => 'dummy27.jpg', 'prodi_id' => 1],
            ['nidn' => '0981237645', 'nama' => 'Dhena Kamalia Fu\'adi, S.Kom., M.Kom.', 'alamat' => 'Jl. Dummy No. 28', 'foto' => 'dummy28.jpg', 'prodi_id' => 1],
            ['nidn' => '1230984756', 'nama' => 'Henri Tantyoko, S.Kom., M.Kom.', 'alamat' => 'Jl. Dummy No. 29', 'foto' => 'dummy29.jpg', 'prodi_id' => 1],
            ['nidn' => '1100229876', 'nama' => 'Satriawan Rasyid Purnama, S.Kom., M.Cs.', 'alamat' => 'Jl. Dummy No. 30', 'foto' => 'dummy30.jpg', 'prodi_id' => 1],
            ['nidn' => '0017037201', 'nama' => 'Prof. Dr. Kusworo Adi, S.Si., M.T.', 'alamat' => 'Jl. Dummy No. 31', 'foto' => 'dummy31.jpg', 'prodi_id' => 3],
            ['nidn' => '0020077902', 'nama' => 'Nurdin Bahtiar, S.Si., M.T.', 'alamat' => 'Jl. Dummy No. 32', 'foto' => 'dummy32.jpg', 'prodi_id' => 1],

            //Matematika
            ['nidn' => '0020127304', 'nama' => 'Farikhin, S.Si., M.Si., Ph.D.', 'alamat' => 'Jl. Dummy No. 33', 'foto' => 'dummy33.jpg', 'prodi_id' => 2],
            ['nidn' => '0021127805', 'nama' => 'Retno Putri Dwi Rahmawati, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 34', 'foto' => 'dummy35.jpg', 'prodi_id' => 2],
            ['nidn' => '0013046907', 'nama' => 'Bagus Arya Saputra, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 35', 'foto' => 'dummy35.jpg', 'prodi_id' => 2],
            ['nidn' => '0015068501', 'nama' => 'Anindita Henindya Permatasari, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 36', 'foto' => 'dummy36.jpg', 'prodi_id' => 2],
            ['nidn' => '0022067403', 'nama' => 'Zani Anjani Rafsanjani, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 37', 'foto' => 'dummy37.jpg', 'prodi_id' => 2],
            ['nidn' => '0019016208', 'nama' => 'Handika Lintang Saputra, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 38', 'foto' => 'dummy38.jpg', 'prodi_id' => 2],
            ['nidn' => '0023108109', 'nama' => 'Nurcahya Yulian Ashar, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 39', 'foto' => 'dummy39.jpg', 'prodi_id' => 2],
            ['nidn' => '0018085602', 'nama' => 'Jovian Dian Pratama, S.Mat., M.Mat.', 'alamat' => 'Jl. Dummy No. 40', 'foto' => 'dummy40.jpg', 'prodi_id' => 2],
            ['nidn' => '0023816291', 'nama' => 'Susilo Hariyanto, S.Mat., M.Mat., Ph.D', 'alamat' => 'Jl. Dummy No. 40', 'foto' => 'dummy40.jpg', 'prodi_id' => 2],

            //Statistika
            ['nidn' => '0030079301', 'nama' => 'Arief Rachman Hakim, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 41', 'foto' => 'dummy41.jpg', 'prodi_id' => 3],
            ['nidn' => '0025026503', 'nama' => 'Dr. Rukun Santoso, M.Si.', 'alamat' => 'Jl. Dummy No. 42', 'foto' => 'dummy42.jpg', 'prodi_id' => 3],
            ['nidn' => '0008107504', 'nama' => 'Diah Safitri, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 43', 'foto' => 'dummy43.jpg', 'prodi_id' => 3],
            ['nidn' => '0721059102', 'nama' => 'Puspita Kartikasari, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 44', 'foto' => 'dummy44.jpg', 'prodi_id' => 3],
            ['nidn' => '0019107606', 'nama' => 'Sugito, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 45', 'foto' => 'dummy45.jpg', 'prodi_id' => 3],
            ['nidn' => '0010098002', 'nama' => 'Rita Rahmawati, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 46', 'foto' => 'dummy46.jpg', 'prodi_id' => 3],
            ['nidn' => '0017087803', 'nama' => 'Moch. Abdul Mukid, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 47', 'foto' => 'dummy47.jpg', 'prodi_id' => 3],
            ['nidn' => '0006076305', 'nama' => 'Dr. Tarno, M.Si.', 'alamat' => 'Jl. Dummy No. 48', 'foto' => 'dummy48.jpg', 'prodi_id' => 3],

            //Kimia
            ['nidn' => '0021048001', 'nama' => 'Prof. Dr. Meiny Suzery, M.S', 'alamat' => 'Jl. Dummy No. 49', 'foto' => 'dummy49.jpg', 'prodi_id' => 4],
            ['nidn' => '0009029404', 'nama' => 'Prof. Dr. Bambang Cahyono, M.S', 'alamat' => 'Jl. Dummy No. 50', 'foto' => 'dummy50.jpg', 'prodi_id' => 4],
            ['nidn' => '0019027307', 'nama' => 'Prof. Adi Darmawan, S.Si, M.Si, Ph.D', 'alamat' => 'Jl. Dummy No. 50', 'foto' => 'dummy50.jpg', 'prodi_id' => 4],
            ['nidn' => '0022089104', 'nama' => 'Ismiyarto, S.Si, M.Si, Ph.D', 'alamat' => 'Jl. Dummy No. 51', 'foto' => 'dummy51.jpg', 'prodi_id' => 4],
            ['nidn' => '0013056502', 'nama' => 'Dra. Sriyanti, M.Si', 'alamat' => 'Jl. Dummy No. 52', 'foto' => 'dummy52.jpg', 'prodi_id' => 4],
            ['nidn' => '0027038205', 'nama' => 'Purbowatiningrum Ria Sarjono, S.Si, M.Si', 'alamat' => 'Jl. Dummy No. 53', 'foto' => 'dummy53.jpg', 'prodi_id' => 4],
            ['nidn' => '0014077609', 'nama' => 'Pardoyo, S.Si, M.Si', 'alamat' => 'Jl. Dummy No. 54', 'foto' => 'dummy54.jpg', 'prodi_id' => 4],
            ['nidn' => '0025127408', 'nama' => 'Muhammad Badrul Huda, S.Si., M.Sc', 'alamat' => 'Jl. Dummy No. 55', 'foto' => 'dummy55.jpg', 'prodi_id' => 4],

            //Fisika
            ['nidn' => '0085031002', 'nama' => 'Prof. Dr. Drs. Wahyu Setia Budi, M.S., F.Med.', 'alamat' => 'Jl. Dummy No. 56', 'foto' => 'dummy56.jpg', 'prodi_id' => 5],
            ['nidn' => '0008803201', 'nama' => 'Dr. Dra. Sumariyah, M.Si.', 'alamat' => 'Jl. Dummy No. 57', 'foto' => 'dummy57.jpg', 'prodi_id' => 5],
            ['nidn' => '0090011001', 'nama' => 'Prof. Dr. Drs. Muhammad Nur, DEA', 'alamat' => 'Jl. Dummy No. 58', 'foto' => 'dummy58.jpg', 'prodi_id' => 5],
            ['nidn' => '0002151998', 'nama' => 'Prof. Dr. Heri Sutanto, S.Si., M.Si., F.Med.', 'alamat' => 'Jl. Dummy No. 59', 'foto' => 'dummy59.jpg', 'prodi_id' => 5],
            ['nidn' => '0002031003', 'nama' => 'Drs. Indras Marhaendrajaya, M.Si.', 'alamat' => 'Jl. Dummy No. 60', 'foto' => 'dummy60.jpg', 'prodi_id' => 5],
            ['nidn' => '0006405181', 'nama' => 'Dr. Drs. Catur Edi Widodo, M.T.', 'alamat' => 'Jl. Dummy No. 61', 'foto' => 'dummy61.jpg', 'prodi_id' => 5],
            ['nidn' => '0070117202', 'nama' => 'Dr. Suci Faniandari, S.Pd., M.Si.', 'alamat' => 'Jl. Dummy No. 62', 'foto' => 'dummy62.jpg', 'prodi_id' => 5],
            ['nidn' => '0001229199', 'nama' => 'Dr. Iis Nurhasanah, S.Si., M.Si.', 'alamat' => 'Jl. Dummy No. 63', 'foto' => 'dummy63.jpg', 'prodi_id' => 5],

            //Biologi
            ['nidn' => '0022619940', 'nama' => 'Prof. Drs. Sapto Purnomo Putro, M.Si, Ph.D', 'alamat' => 'Jl. Dummy No. 64', 'foto' => 'dummy64.jpg', 'prodi_id' => 6],
            ['nidn' => '0023016704', 'nama' => 'Dr.Dra. Agung Janika Sitasiwi, M.Si', 'alamat' => 'Jl. Dummy No. 65', 'foto' => 'dummy65.jpg', 'prodi_id' => 6],
            ['nidn' => '0020096107', 'nama' => 'Drs. Agung Suprihadi, M.Si.', 'alamat' => 'Jl. Dummy No. 66', 'foto' => 'dummy66.jpg', 'prodi_id' => 6],
            ['nidn' => '0042319870', 'nama' => 'Dr.rer.nat. Anto Budiharjo, S.Si., M.Biotech.', 'alamat' => 'Jl. Dummy No. 67', 'foto' => 'dummy67.jpg', 'prodi_id' => 6],
            ['nidn' => '0018066803', 'nama' => 'Dr. Dra. Arina Tri Lunggani, M.Si.', 'alamat' => 'Jl. Dummy No. 68', 'foto' => 'dummy69.jpg', 'prodi_id' => 6],
            ['nidn' => '0005066305', 'nama' => 'Drs. Budi Raharjo, M.Si.', 'alamat' => 'Jl. Dummy No. 69', 'foto' => 'dummy69.jpg', 'prodi_id' => 6],
            ['nidn' => '0005056110', 'nama' => 'Prof. Dr. Dra. Endah Dwi Hastuti, M.Si.', 'alamat' => 'Jl. Dummy No. 70', 'foto' => 'dummy70.jpg', 'prodi_id' => 6],
            ['nidn' => '0026115902', 'nama' => 'Prof. Dr. Endang Kusdiyantini, DEA', 'alamat' => 'Jl. Dummy No. 71', 'foto' => 'dummy71.jpg', 'prodi_id' => 6],
        ];

        foreach($dosenData as $dosen){
            Dosen::create($dosen);
        }
    }
}
