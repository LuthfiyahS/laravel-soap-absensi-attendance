<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
               'username'=>'201904024',
               'name'=>'Luthfiyah Sakinah',
               'email'=>'user@gmailabsen.com',
               'type'=>1,
               'departemen_id'=> 1,
               'password'=> bcrypt('123456'),
            ],
            [
               'username'=>'201804001',
               'name'=>'Super Admin',
               'email'=>'super-admin@gmailabsen.com',
               'type'=>2,
               'departemen_id'=> 1,
               'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}