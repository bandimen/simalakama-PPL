<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $userRoles = [
        [
            'name' => 'Fendi Ardianto',
            'email' => 'fendiardianto@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Farrel Ardana Jati',
            'email' => 'farrelardanajati@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Muhammad Naufal Izzudin',
            'email' => 'mnaufalizzudin@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Tiara Putri Wibowo',
            'email' => 'tiaraputriwibowo@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Aris Puji Widodo',
            'email' => 'arispw@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['pembimbingakademik']
        ],
        [
            'name' => 'Aris Sugiharto',
            'email' => 'arissugiharto@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['pembimbingakademik', 'kaprodi']
        ],
        [
            'name' => 'Kusworo Adi',
            'email' => 'kusworoadi@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['dekan']
        ],
        [
            'name' => 'Izzudin Ardianto Jatiwibowo',
            'email' => 'izu@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['bagianakademik']
        ],
        [
            'name' => 'Susilo Hariyanto', // kaprodi Matematika
            'email' => 'susilo@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['kaprodi', 'pembimbingakademik']
        ],
        [
            'name' => 'Prof. Drs. Sapto Purnomo Putro, M.Si, Ph.D', // kaprodi Biologi
            'email' => 'sapto@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['kaprodi']
        ],
        [
            'name' => 'Prof. Adi Darmawan, S.Si, M.Si, Ph.D', // kaprodi Kimia
            'email' => 'adi@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['kaprodi']
        ],
        [
            'name' => 'Prof. Dr. Heri Sutanto, S.Si., M.Si., F.Med.', // kaprodi Fisika
            'email' => 'heri@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['kaprodi']
        ],
        [
            'name' => 'Dr. Tarno, M.Si.', // kaprodi Statistika
            'email' => 'tarno@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['kaprodi']
        ],
        [
            'name' => 'Riza Viaranti', // Matematika 24010117130044
            'email' => 'rizaviaranti@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Aiko Putri', // Biologi 24020118120010
            'email' => 'aikoputri@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Wardah Nabilah', // Kimia 24030116140094
            'email' => 'wardahnabilah@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Sabilla Ayu Maharastri', // Fisika 24040118130080
            'email' => 'sabillaayu@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Wahyu Adjie', // Statistika 24050120120150
            'email' => 'wahyuadjie@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['mahasiswa']
        ],
        [
            'name' => 'Rita Rahmawati, S.Si., M.Si.',
            'email' => 'ritarahma@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['pembimbingakademik']
        ],
        [
            'name' => 'Dr. Suci Faniandari, S.Pd., M.Si.',
            'email' => 'sucifani@simalakama.com',
            'password' => bcrypt('123456'),
            'roles' => ['pembimbingakademik']
        ],

    ];

    foreach ($userRoles as $userData) {
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password']
        ]);

        foreach ($userData['roles'] as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $user->roles()->attach($role->id);
            }
        }
    }

    }
}
