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
                'jam_masuk' => '08:00:00',
                'jam_masuk_mulai' => '06:00:00',
                'jam_masuk_selesai' => '09:00:00',
                'jam_pulang' => '17:00:00',
                'jam_pulang_mulai' => '13:00:00',
                'jam_pulang_selesai' => '18:00:00',
            ],
            [
                'name'=>'Guru',
                'jam_masuk' => '08:00:00',
                'jam_masuk_mulai' => '06:00:00',
                'jam_masuk_selesai' => '12:00:00',
                'jam_pulang' => '17:00:00',
                'jam_pulang_mulai' => '15:00:00',
                'jam_pulang_selesai' => '18:00:00',
            ],
            [
                'name'=>'Siswa',
                'jam_masuk' => '08:00:00',
                'jam_masuk_mulai' => '06:00:00',
                'jam_masuk_selesai' => '10:00:00',
                'jam_pulang' => '17:00:00',
                'jam_pulang_mulai' => '15:00:00',
                'jam_pulang_selesai' => '18:00:00',
            ],
        ];
    
        foreach ($departemens as $key => $departemen) {
            Departemen::create($departemen);
        }
    }
}
