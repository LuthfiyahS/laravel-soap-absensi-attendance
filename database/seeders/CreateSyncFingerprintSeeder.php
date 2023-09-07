<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SyncFingerprint;

class CreateSyncFingerprintSeeder extends Seeder
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
                'datetime' => now(),
                'status' => 'Sinkronisasi Otomatis',
            ],
        ];
    
        foreach ($mesinfingerprint as $key => $x) {
            SyncFingerprint::create($x);
        }
    }
}
