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
        
        for ($i=0; $i < 100 ; $i++) { 
            $jam = $faker->dateTimeBetween('06.00.00', '09.09.00');
            if ($jam <= '08.00.00') {
                $status = "Tepat Waktu";
            } else {
                $status = "Terlambat";
            }
            
            Absensi::create([
                'user_id' => $faker->numberBetween(1,52),
                'kehadiran' => $faker->randomElement(['Tidak Hadir','Hadir']),
                'tanggal' => $faker->dateTimeBetween('01.08.2023', '01.09.2023'),
                'status' => $status,
                'jam_masuk' => $jam,
                'jam_pulang' => $faker->dateTimeBetween('15.00.00', '18.09.00'),
            ]);
        } 
        
    }
}
