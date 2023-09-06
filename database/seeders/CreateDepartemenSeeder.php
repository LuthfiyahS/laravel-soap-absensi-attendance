<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departemen;

class CreateDepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departemens = [
            [
                'name'=>'Staf',
            ],
            [
                'name'=>'Guru',
            ],
            [
                'name'=>'Siswa',
            ],
        ];
    
        foreach ($departemens as $key => $departemen) {
            Departemen::create($departemen);
        }
    }
}
