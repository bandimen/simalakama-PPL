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
