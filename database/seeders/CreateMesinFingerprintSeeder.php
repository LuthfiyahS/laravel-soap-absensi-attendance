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
            // [
            //     'ip' => '192.168.1.201',
            //     'name' => 'Fingerprint',
            //     'comkey' => '3',
            //     'status' => 1,
            // ],
            [
                'ip' => '103.186.31.208',
                'name' => 'Fingerprint 2',
                'comkey' => 'blank',
                'port' => '9033',
                'status' => 1,
            ],
            [
                'ip' => '103.186.31.203',
                'name' => 'Fingerprint 2',
                'comkey' => 0,
                'port' => '5069',
                'status' => 1,
            ],
        ];
    
        foreach ($mesinfingerprint as $key => $x) {
            MesinFingerprint::create($x);
        }
    }
}
