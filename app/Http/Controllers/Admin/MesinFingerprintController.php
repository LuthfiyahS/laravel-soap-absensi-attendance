<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MesinFingerprint;
Use Alert;

class MesinFingerprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesinfingerprint = MesinFingerprint::all();
        return view('admin.mesin-fingerprint.index',compact('mesinfingerprint'));
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
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/mesin-fingerprint');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil dihapus');
            return redirect('/mesin-fingerprint');
        }
    }
}
