<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MesinFingerprint;

class CreateMesinFingerprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mesinfingerprint = [
            [
                'ip' => '192.168.1.201',
                'name' => 'Fingerprint Al Muhajirin',
                'comkey' => '1',
                'status' => 1,
            ],
        ];
    
        foreach ($mesinfingerprint as $key => $x) {
            MesinFingerprint::create($x);
        }
    }
}
