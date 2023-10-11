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
        
        //50 hari
        for ($i=0; $i < 50 ; $i++) { 
            for ($x=0; $x <52 ; $x++) { 
                $jam = $faker->dateTimeBetween('06.00.00', '09.09.00');
                $user=  $x+1;
                //$user=  $faker->numberBetween(1,52);
                
                $datenumber = 50-$i;
                $date = now()->addDays(-$datenumber)->format('Y-m-d');
                if ($jam <= '08.00.00') {
                    $status = "Tepat Waktu";
                } else {
                    $status = "Terlambat";
                }

                //weekend ngga

                if (date('N', strtotime($date)) <= 5) {
                    Absensi::create([
                        'user_id' => $user,
                        'kehadiran' => 'Hadir',
                        'tanggal' => now()->addDays(-$datenumber)->format('Y-m-d'),
                        'status' => $status,
                        'jam_masuk' => $jam,
                        'jam_pulang' => $faker->dateTimeBetween('15.00.00', '18.09.00'),
                    ]);
                } else{
                    Absensi::create([
                        'user_id' => $user,
                        'kehadiran' => 'Libur',
                        'tanggal' => now()->addDays(-$datenumber)->format('Y-m-d'),
                    ]);
                }
                // Absensi::create([
                //     'user_id' => $user,
                //     'kehadiran' => 'Hadir',
                //     'tanggal' => now()->addDays(-$datenumber)->format('Y-m-d'),
                //     'status' => $status,
                //     'jam_masuk' => $jam,
                //     'jam_pulang' => $faker->dateTimeBetween('15.00.00', '18.09.00'),
                // ]);
                // $cek = Absensi::where('user_id', $user)->where('tanggal',now()->addDays(-$date)->format('Y-m-d'))->count();
                // if ($cek == null) {
                //     Absensi::create([
                //         'user_id' => $user,
                //         'kehadiran' => 'Hadir',
                //         'tanggal' => now()->addDays(-$date)->format('Y-m-d'),
                //         'status' => $status,
                //         'jam_masuk' => $jam,
                //         'jam_pulang' => $faker->dateTimeBetween('15.00.00', '18.09.00'),
                //     ]);
                // }else{
                //     Absensi::create([
                //         'user_id' => $user,
                //         'kehadiran' => 'Tidak Hadir',
                //         'tanggal' => now()->addDays(-$date)->format('Y-m-d'),
                //     ]);
                // }
            }
        } 
        
    }
}
