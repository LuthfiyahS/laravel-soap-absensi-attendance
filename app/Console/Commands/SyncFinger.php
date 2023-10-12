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
                $name       = $this->_ParseData($data, "<Name>", "</Name>");
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
                    if (!count($this->_checkExists1($name, $datetime))  > 0) {
                        //masuk sync_id
                        $sync = SyncFingerprint::orderBy('id', 'ASC')->first();
                        $users = User::where('name', $name)->first();
                        //cek sama jam kerja
                        //$schedule = Departemen::find($users->departemen_id);
                        $schedule = Departemen::find(1);
                        if ($time >= $schedule->jam_masuk_mulai && $time <= $schedule->jam_masuk) {
                            # code...
                            Absensi::create([
                                'name' => $name,
                                'kehadiran' => 'Hadir',
                                'status' => 'Tepat Waktu',
                                'tanggal' => $datetime,
                                'jam_masuk' => $datetime,
                            ]);
                        } elseif ($time >= $schedule->jam_masuk && $time <= $schedule->jam_pulang_mulai) {
                            Absensi::create([
                                'name' => $name,
                                'kehadiran' => 'Hadir',
                                'status' => 'Terlambat',
                                'tanggal' => $datetime,
                                'jam_masuk' => $datetime,
                            ]);
                        }elseif ($time >= $schedule->jam_pulang_mulai && $time <= $schedule->jam_pulang_selesai) {
                            # code...
                            //dd($schedule->jam_pulang_mulai);
                            $cek = Absensi::where('name', $name)->where('tanggal', $date)->first();
                            if ($cek) {
                                // dd($cek);
                                $upd = Absensi::where('id', $cek->id)->update([
                                    'jam_pulang' => $time,
                                ]);
                            } else {
                                //dd($cek);
                                Absensi::create([
                                    'name' => $name,
                                    'tanggal' => $date,
                                    'jam_masuk' => $time,
                                ]);
                            }
                        }

                        $ud = new LogFingerprint;
                        $ud->name = $name;
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
    public function _checkExists1($name, $datetime)
    {
        $userData = LogFingerprint::where('name', $name)->where('datetime', $datetime)->get();
        return $userData;
    }
}
