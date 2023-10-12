<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class CreateUsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
               'name'=>'Luthfiyah Sakinah',
               'email'=>'user@gmailabsen.com',
               'type'=>1,
               'departemen_id'=> 1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Super Admin',
               'email'=>'superadmin@gmail.com',
               'type'=>2,
               'departemen_id'=> 1,
               'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }

        // $faker = Faker::create('id_ID');
        
        // for ($i=0; $i < 50 ; $i++) { 
        //     User::create([
        //         'name'=>  $faker->name,
        //         'email'=>  $faker->email,
        //         'no_hp' => $faker->phoneNumber,
        //         'type'=> 1,
        //         'departemen_id'=>  $faker->numberBetween(1,3),
        //         'password'=> bcrypt('123456'),
        //     ]);
        // } 
    }
}