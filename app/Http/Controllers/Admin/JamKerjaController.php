<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departemen;
Use Alert;

class JamKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departemen = Departemen::all();
        return view('admin.jam-kerja.index',compact('departemen'));
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
            Departemen::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan!');
            return redirect('/departemen');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil ditambahkan!');
            return redirect('/departemen');
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
                'jam_masuk'  => $request->jam_masuk,
                'jam_masuk_mulai'  => $request->jam_masuk_mulai,
                'jam_masuk_selesai'  => $request->jam_masuk_selesai,
                'jam_pulang'  => $request->jam_pulang,
                'jam_pulang_mulai'  => $request->jam_pulang_mulai,
                'jam_pulang_selesai'  => $request->jam_pulang_selesai,
            ];
            Departemen::where('id',$id)->update($data);
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/jam-kerja');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil diperbaharui');
            return redirect('/jam-kerja');
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
            $data = Departemen::find($id);
            $data->delete();
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/departemen');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil dihapus');
            return redirect('/departemen');
        }
    }
}
