<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleUser;

class CreateRoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleusers = [
            [
               'name'=>'User',
            ],
            [
               'name'=>'Super Admin',
            ],
        ];
    
        foreach ($roleusers as $key => $roleuser) {
            RoleUser::create($roleuser);
        }
    }
}
