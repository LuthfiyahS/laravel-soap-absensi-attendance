<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MesinFingerprint;
use App\Models\LogFingerprint;
use App\Models\SyncFingerprint;
use App\Models\User;
Use Alert;

class MesinFingerprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      ini_set('max_execution_time', 0);
    }

    public function _ParseData($data, $p1, $p2)
    {
      $data = " ".$data;
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

    public function _checkExists1($pin, $datetime)
    {
        $users = User::where('username',$pin)->first();
        if ($users) {
            $userData = LogFingerprint::where('user_id', $users->id)->where('datetime', $datetime)->get();
            return $userData;
        }else{
            $userData = [];
            return $userData;
        }
    }

    public function _checkExists2($pin)
    {
        $users = User::where('username',$pin)->get();
        return $users;
    }


    public function index()
    {
        $mesinfingerprint = MesinFingerprint::all();
        $log = LogFingerprint::count();
        $sync = SyncFingerprint::count();
        $syncdate = SyncFingerprint::orderBy('id','DESC')->first();
        return view('admin.mesin-fingerprint.index',compact('mesinfingerprint','log','sync','syncdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'ip'  => $request->ip,
                'name'  => $request->name,
                'comkey'  => $request->comkey,
                'status'  => $request->status,

            ];
            MesinFingerprint::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan!');
            return redirect('/mesin-fingerprint');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil ditambahkan!');
            return redirect('/mesin-fingerprint');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mesin = MesinFingerprint::find($id);
        $IP = $mesin->ip;
        // $port = $mesin->port;

        $connect = @fsockopen($IP, '80', $errno, $errstr, 1);
        // $connect = @fsockopen($IP, $port, $errno, $errstr, 1);
        if ($connect) {
            Alert::success('Success', 'Mesin Terkoneksi');
            //toast('Mesin '.$mesin->name.' Terkoneksi!','success');
            return redirect()->back();
        } else {
            Alert::error('Error', 'Error Mesin Tidak Terkoneksi');
            //toast('Error Mesin '.$mesin->name.' Tidak Terkoneksi!','error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = [
                'ip'  => $request->ip,
                'name'  => $request->name,
                'comkey'  => $request->comkey,
                'status'  => $request->status,
            ];
            MesinFingerprint::where('id',$id)->update($data);
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/mesin-fingerprint');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil diupdate');
            return redirect('/mesin-fingerprint');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = MesinFingerprint::find($id);
            $data->delete();
            Alert::success('Sukses', 'Data berhasil dihapus!');
            return redirect('/mesin-fingerprint');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil dihapus');
            return redirect('/mesin-fingerprint');
        }
    }

    public function destroylog($id)
    {
      $mesin = MesinFingerprint::find($id);
      $IP = $mesin->ip;
      $Key = $mesin->comkey;
      // $port = $mesin->port;

      $connect = @fsockopen($IP, '80', $errno, $errstr, 1);
      // $connect = @fsockopen($IP, $port, $errno, $errstr, 1);
      if ($connect) {
        $data = LogFingerprint::where('mesin_id',$id);
        $data->delete();
        $soap_request = "<ClearData>
        <ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
        <Arg><Value xsi:type=\"xsd:integer\">3</Value></Arg>
        </ClearData>";

        $newLine = "\r\n";
        fputs($connect, "POST /iWsService HTTP/1.0".$newLine);
        fputs($connect, "Content-Type: text/xml".$newLine);
        fputs($connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
        fputs($connect, $soap_request.$newLine);
        $buffer = "";
        while($Response = fgets($connect, 1024)) {
            $buffer = $buffer.$Response;
        }
        Alert::success('Sukses', 'Log Mesin '.$mesin->name.' Terhapus!');
        return redirect('/mesin-fingerprint')->with('success','Log Mesin '.$mesin->name.' Terhapus!');
      } else {
        Alert::error('Gagal', 'Log Mesin '.$mesin->name.' Tidak Terhapus!');
        return redirect('/mesin-fingerprint')->with('error','Log Mesin '.$mesin->name.' Tidak Terhapus!');
      }
    }

    public function sinkronisasi()
    {
      $fp = MesinFingerprint::where('status', 1)->orderBy('ip')->get();

      if (count($fp) == 0) {
        return "tidak ada mesin absensi!";
      }else{
        //masuk sync_id
        SyncFingerprint::create([
          'datetime'=>now(),
        ]);
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
        if($connect) {
          $soapRequest = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
          $newLine = "\r\n";
          fputs($connect, "POST /iWsService HTTP/1.0".$newLine);
          fputs($connect, "Content-Type: text/xml".$newLine);
          fputs($connect, "Content-Length: ".strlen($soapRequest).$newLine.$newLine);
          fputs($connect, $soapRequest.$newLine);
          $buffer = "";
          while ($response = fgets($connect, 1024)) {
            $buffer = $buffer.$response;
          }

          
        } else {
          return "Koneksi Gagal";
        }

        $buffer = $this->_ParseData($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        $buffer = explode("\r\n", $buffer);
        
        $create = [];
        for ($a=1; $a < count($buffer); $a++) {
          // echo $buffer[a] disini, hasilnya: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode><\/Row>"
          $data      = $this->_ParseData($buffer[$a], "<Row>", "</Row>");
          // echo $buffer[a] disini, hasilnya: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode><\/Row>"
          // echo $data disini, hasilnya: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode>"
          $pin       = $this->_ParseData($data, "<PIN>", "</PIN>");
          // echo $buffer[a] disini, hasilnya: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode><\/Row>"
          // echo $data disini, hasilnya: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode>"
          // echo $pin disini, hasilnya: "11078"
          $datetime  = $this->_ParseData($data, "<DateTime>", "</DateTime>");
          $status  = $this->_ParseData($data, "<Status>", "</Status>");

          // echo $buffer[a] disini, hasilnya: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode><\/Row>"
          // echo $data disini, hasilnya: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode>"
          // echo $pin disini, hasilnya: "11078"
          // echo $datetime disini, hasilnya: "2017-02-07 06:12:07"
          //
          //
          // pake json encode
          // ini $buffer: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode><\/Row>"
          // ini $data: "11078<\/PIN>2017-02-07 06:12:07<\/DateTime>0<\/Verified>0<\/Status>0<\/WorkCode>"
          // ini $pin: "11078"
          // ini $datetime: "2017-02-07 06:12:07"
          //
          // gapake json encode
          // ini $buffer: 110782017-02-07 06:12:07000
          // ini $data: 110782017-02-07 06:12:07000
          // ini $pin: 11078
          // ini $datetime: 2017-02-07 06:12:07

          $export[$a]['pin'] = $this->_ParseData($data, "<PIN>", "</PIN>");
          $export[$a]['waktu'] = $this->_ParseData($data, "<PIN>", "</PIN>");
          $export[$a]['status'] = $this->_ParseData($data,"<Status>","</Status>");
          if ($data != "") {
            if (!count($this->_checkExists1($pin, $datetime)) > 0 && count($this->_checkExists2($pin)) > 0 ) {
              //masuk sync_id
              $sync = SyncFingerprint::orderBy('id', 'DESC')->first();
              $users = User::where('username',$pin)->first();
              $create[] = [
                'user_id' => $pin,
                'datetime' => $datetime,
                'mesin_id' => $value->id,
                'status' => $status,
                'created_at' => $datetime,
                'updated_at' => now()
              ];
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
        echo count($create) . '<br>';
        //print_r($export);
        print_r($create);

        echo "bates per mesin<br><br>";
        // UD::insert($create);
      }
      return redirect()->back();
    }
}
