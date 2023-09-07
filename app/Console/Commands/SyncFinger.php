<?php

namespace App\Console\Commands;

use App\Models\FingerprintMachine as FP;
use App\Models\LogFingerprint as LF;
use App\Models\Mahasiswa;
use Illuminate\Console\Command;

class SyncFinger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:finger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
