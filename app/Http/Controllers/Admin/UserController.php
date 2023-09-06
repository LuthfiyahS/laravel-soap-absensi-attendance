<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Departemen;
Use Alert;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = User::all();
        $departemen = Departemen::all();
        $role = RoleUser::all();
        return view('admin.pengguna.index',compact('pengguna','departemen','role'));
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
                'email'  => $request->email,
                'password'  => bcrypt($request->password),
                'departemen_id'  => $request->departemen_id,
                'type'  => $request->type,
            ];
            User::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan!');
            return redirect('/pengguna');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil ditambahkan!');
            return redirect('/pengguna');
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
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $file->store('public/img/ava');
                $foto = str_replace("public/", "", $fileName);
            }else{
                $foto = $request->path_file;
            }
            $data = [
                'name'  => $request->name,
                'email'  => $request->email,
                'no_hp'  => $request->no_hp,
                'foto'  => $foto,
                'departemen_id'  => $request->departemen_id,
                'type'  => $request->type,
            ];
            $get = User::find($id);
            if ($get->foto != null) {
                File::delete('storage/'.$get->foto);
            }
            User::where('id',$id)->update($data);
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/pengguna');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil diperbaharui');
            return redirect('/pengguna');
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
            $data = User::find($id);
            File::delete('storage/'.$data->foto);
            $data->delete();
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/pengguna');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil dihapus');
            return redirect('/pengguna');
        }
    }
}
