<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Absensi;
use Faker\Factory as Faker;

class CreateDummyAbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create('id_ID');
        
        for ($i=0; $i < 50 ; $i++) { 
            Absensi::create([
                'user_id' => $faker->numberBetween(1,52),
                'kehadiran' => $faker->randomElement(['Tidak Hadir','Hadir']),
                'tanggal' => $faker->date,
                'jam_masuk' => $faker->time,
                'jam_pulang' => $faker->time,
            ]);
        } 
        
    }
}
