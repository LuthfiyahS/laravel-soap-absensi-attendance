<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\User;
use DataTables;
Use Alert;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $absensi = Absensi::all();
        $user = User::all();
        $usergroup = Absensi::select('user_id')->groupBy('user_id')->get();
        if ($request->ajax()) {
            $data = Absensi::with('user')->latest()->get();
            return DataTables::of($data)
                ->make();
        }
        return view('admin.absensi.index',compact('absensi','user','usergroup'));
    }
    public function getAbsensi(Request $request)
    {
        if ($request->ajax()) {
            $data = Absensi::latest()->get();
            return DataTables::of($data)
                ->make();
        }
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
                'name'  => $request->name,
            ];
            Absensi::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan!');
            return redirect('/absensi');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil ditambahkan!');
            return redirect('/absensi');
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
        //
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
                'name'  => $request->name,
            ];
            Absensi::where('id',$id)->update($data);
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/absensi');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil diupdate');
            return redirect('/absensi');
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
            $data = Absensi::find($id);
            $data->delete();
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/absensi');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil dihapus');
            return redirect('/absensi');
        }
    }
}
