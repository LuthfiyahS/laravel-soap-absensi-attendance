<?php

namespace App\Console\Commands;

use App\Models\MesinFingerprint;
use App\Models\LogFingerprint;
use App\Models\SyncFingerprint;
use App\Models\Departemen;
use App\Models\Absensi;
use App\Models\User;
use DateTime;
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
        $fp = MesinFingerprint::where('status', 1)->orderBy('ip')->get();

        if (count($fp) == 0) {
            return Command::SUCCESS;
        } 

        foreach ($fp as $key => $value) {
            $IP = $value->ip;
            $Key = $value->comkey;
            // $Port = $value->port;

            if ($IP == "") {
                $IP = $value->ip;
            }
            if ($Key == "") {
                $Key = $value->comkey;
            }
            // if ($Port == "") {
            //   $Key = $value->port;
            // }

            $connect = @fsockopen($IP, '80', $errno, $errstr, 1);
            // $connect = @fsockopen($IP, $Port, $errno, $errstr, 1);
            if ($connect) {
                $soapRequest = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
                $newLine = "\r\n";
                fputs($connect, "POST /iWsService HTTP/1.0" . $newLine);
                fputs($connect, "Content-Type: text/xml" . $newLine);
                fputs($connect, "Content-Length: " . strlen($soapRequest) . $newLine . $newLine);
                fputs($connect, $soapRequest . $newLine);
                $buffer = "";
                while ($response = fgets($connect, 1024)) {
                    $buffer = $buffer . $response;
                }
            } else {
                return Command::SUCCESS;
            }

            $buffer = $this->_ParseData($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
            $buffer = explode("\r\n", $buffer);

            $create = [];
            for ($a = 1; $a < count($buffer); $a++) {
                $data      = $this->_ParseData($buffer[$a], "<Row>", "</Row>");
                $pin       = $this->_ParseData($data, "<PIN>", "</PIN>");
                $datetime  = $this->_ParseData($data, "<DateTime>", "</DateTime>");
                $status  = $this->_ParseData($data, "<Status>", "</Status>");

                $export[$a]['pin'] = $this->_ParseData($data, "<PIN>", "</PIN>");
                $export[$a]['waktu'] = $this->_ParseData($data, "<PIN>", "</PIN>");
                $export[$a]['status'] = $this->_ParseData($data, "<Status>", "</Status>");

                //memisahkan datetime
                $datetimes = new DateTime($datetime);

                $date = $datetimes->format('Y-m-d');
                $time = $datetimes->format('H:i:s');
                if ($data != "") {
                    if (!count($this->_checkExists1($pin, $datetime)) > 0 && count($this->_checkExists2($pin)) > 0) {
                        //masuk sync_id
                        $sync = SyncFingerprint::orderBy('id', 'ASC')->first();
                        $users = User::where('username', $pin)->first();
                        //cek sama jam kerja
                        $schedule = Departemen::find($users->departemen_id);
                        if ($time >= $schedule->jam_masuk_mulai && $time <= $schedule->jam_masuk_selesai) {
                            # code...
                            Absensi::create([
                                'user_id' => $users->id,
                                'kehadiran' => 'Hadir',
                                'tanggal' => $datetime,
                                'jam_masuk' => $datetime,
                            ]);
                        } elseif ($time >= $schedule->jam_pulang_mulai && $time <= $schedule->jam_pulang_selesai) {
                            # code...
                            //dd($schedule->jam_pulang_mulai);
                            $cek = Absensi::where('user_id', $users->id)->where('tanggal', $date)->first();
                            if ($cek) {
                                // dd($cek);
                                $upd = Absensi::where('id', $cek->id)->update([
                                    'jam_pulang' => $time,
                                ]);
                            } else {
                                //dd($cek);
                                Absensi::create([
                                    'user_id' => $users->id,
                                    'tanggal' => $date,
                                    'jam_masuk' => $time,
                                ]);
                            }
                        }

                        $ud = new LogFingerprint;
                        $ud->user_id = $users->id;
                        $ud->datetime = $datetime;
                        $ud->mesin_id = $value->id;
                        $ud->status = $status;
                        $ud->sync_id = $sync->id;
                        $ud->created_at = $datetime;
                        $ud->updated_at = now();
                        $ud->save();
                    }
                }
            }
        }
        return Command::SUCCESS;
    }

    public function _ParseData($data, $p1, $p2)
    {
      $data = " " . $data;
      $hasil = "";
      $awal = strpos($data, $p1);
      if ($awal != "") {
        $akhir = strpos(strstr($data, $p1), $p2);
        if ($akhir != "") {
          $hasil = substr($data, $awal + strlen($p1), $akhir - strlen($p1));
        } else {
          return "akhir kosong";
        }
      }
  
      return $hasil;
    }
    
    //cek antara log mesin sama db
    public function _checkExists1($pin, $datetime)
    {
        $users = User::where('username', $pin)->first();
        if ($users) {
            $userData = LogFingerprint::where('user_id', $users->id)->where('datetime', $datetime)->get();
            return $userData;
        } else {
            $userData = [];
            return $userData;
        }
    }

    //cek usernya cocok ga sama mesin
    public function _checkExists2($pin)
    {
        $users = User::where('username', $pin)->get();
        return $users;
    }
}
